<?php

namespace App\Controllers\Landlord;

use App\Controllers\BaseController;
use App\Models\UserModel;

class ProfileController extends BaseController
{
    public function edit()
    {
        $userId = session()->get('user_id');
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        return view('landlord/profile/edit', ['user' => $user]);
    }

    public function update()
    {
        $userId = session()->get('user_id');

        $rules = [
            'name'     => 'required|min_length[3]',
            'email'    => "required|valid_email|is_unique[users.email,id,{$userId}]",
            'password' => 'permit_empty|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $userModel = new UserModel();

        $updateData = [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $updateData['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $userModel->update($userId, $updateData);

        return redirect()->to(current_url())->with('success', 'Profile updated successfully.');
    }
}
