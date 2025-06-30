<?php

namespace App\Controllers\Tenant;

use App\Controllers\BaseController;
use App\Models\UserModel;

class ProfileController extends BaseController
{
    public function index()
    {
        $userId = session()->get('user_id');
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        return view('tenant/profile/index', ['user' => $user]);
    }

    public function update()
    {
        $userId = session()->get('user_id');
        $rules = [
            'name' => 'required',
            'email' => 'required|valid_email',
        ];

        // Optional password update
        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $userModel = new UserModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $userModel->update($userId, $data);

        return redirect()->to('/tenant/profile')->with('success', 'Profile updated.');
    }
}