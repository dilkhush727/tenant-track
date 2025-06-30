<?php namespace App\Controllers;

use App\Models\UserModel;

class Auth extends \CodeIgniter\Controller
{
    // Registration function
    public function register()
    {
        helper(['form']);

        if (strtoupper($this->request->getMethod()) === 'POST') {
            $post = $this->request->getPost();

            // ✅ reCAPTCHA
            if (!$this->validateCaptcha($post['g-recaptcha-response'] ?? '')) {
                return redirect()->back()
                    ->withInput()
                    ->with('captcha_error', 'Please verify that you are not a robot.');
            }

            // ✅ Validation
            $rules = [
                'name'     => 'required|min_length[3]',
                'email'    => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]',
                'role'     => 'required|in_list[tenant,landlord]'
            ];

            if (! $this->validate($rules)) {
                return view('auth/register', ['validation' => $this->validator]);
            }

            // ✅ Generate verification token
            $token = bin2hex(random_bytes(32));

            $userModel = new UserModel();
            $saved = $userModel->save([
                'name'               => $post['name'],
                'email'              => $post['email'],
                'password'           => $post['password'],
                'role'               => $post['role'],
                'status'             => 'active',
                'email_verified'     => 0,
                'verification_token' => $token
            ]);

            if (!$saved) {
                return view('auth/register', ['validation' => $this->validator]);
            }

            // ✅ Send verification email
            $emailService = \Config\Services::email();
            $emailService->setTo($post['email']);
            $emailService->setSubject('Verify your email for TenantTrack');

            $verifyLink = base_url("verify-email/{$token}");

            $emailService->setMessage(view('emails/verify_email', [
                'name' => $post['name'],
                'link' => $verifyLink
            ]));

            if (!$emailService->send()) {
                log_message('error', 'Email failed: ' . $emailService->printDebugger(['headers']));
            }

            return redirect()->to('/login')->with('success', 'Account created! Please check your email to verify your account.');
        }

        return view('auth/register');
    }

    // Login function
    public function login()
    {
        helper('form');

        // Check if the request method is POST
        if (strtoupper($this->request->getMethod()) === 'POST') {
            $post = $this->request->getPost();

            if (!$this->validateCaptcha($post['g-recaptcha-response'] ?? '')) {
                return redirect()->back()
                    ->withInput()
                    ->with('captcha_error', 'Please verify that you are not a robot.');
            }

            // Validation rules for the login form
            $rules = [
                'email'    => 'required|valid_email',
                'password' => 'required'
            ];

            // Validate input data
            if (!$this->validate($rules)) {
                return view('auth/login', [
                    'validation' => $this->validator  // Pass validation errors to the view
                ]);
            }

            // Remove CSRF token from POST data for security
            unset($post['csrf_test_name']);  // Remove CSRF token

            // Check user credentials in the database
            $userModel = new UserModel();
            $user = $userModel->where('email', $post['email'])
                            ->where('status', 'active')  // Ensure the user is active
                            ->first();

            // Check if user exists and password is correct
            if (!$user || !password_verify($post['password'], $user['password'])) {
                // Set flash error message for invalid credentials
                return redirect()->to('/login')->with('error', 'Invalid login credentials.');
            }

            // Set session data for the user
            session()->set([
                'user_id'   => $user['id'],
                'name'      => $user['name'],
                'email'     => $user['email'],
                'role'      => $user['role'],
                'isLoggedIn'=> true
            ]);

            // Redirect based on user role
            switch ($user['role']) {
                case 'tenant':
                    return redirect()->to('/tenant');
                case 'landlord':
                    return redirect()->to('/landlord');
                case 'admin':
                    return redirect()->to('/admin');
                default:
                    return redirect()->to('/login');
            }
        }

        // If it's a GET request, just load the login view
        return view('auth/login');
    }

    private function validateCaptcha($response)
    {
        $secret = '6LeB73ErAAAAAAmIhaa_Kl6io4dRDhS9aph0ZoMQ';
        $verifyURL = "https://www.google.com/recaptcha/api/siteverify";

        $client = \Config\Services::curlrequest();
        $response = $client->post($verifyURL, [
            'form_params' => [
                'secret' => $secret,
                'response' => $response
            ]
        ]);
        $result = json_decode($response->getBody(), true);
        return isset($result['success']) && $result['success'] === true;
    }

    public function verifyEmail($token)
    {
        $userModel = new UserModel();
        $user = $userModel->where('verification_token', $token)->first();

        if (!$user) {
            return redirect()->to('/login')->with('error', 'Invalid or expired verification link.');
        }

        $user['email_verified'] = 1;
        $user['verification_token'] = null;

        $userModel->save($user);

        return redirect()->to('/login')->with('success', 'Email verified successfully! You can now log in.');
    }

    // Logout function
    public function logout()
    {
        // Destroy the session when logging out
        session()->destroy();

        // Redirect to the login page after logout
        return redirect()->to('/login');
    }
}
