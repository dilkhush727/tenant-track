<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $users = (new UserModel())->findAll();
        return view('admin/users', ['users' => $users]);
    }

    public function elevate($userId)
    {
        return $this->changeRole($userId, 'admin');
    }

    public function demote($userId)
    {
        return $this->changeRole($userId, 'landlord');
    }

    private function changeRole($userId, $role)
    {
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $userModel->update($userId, ['role' => $role]);
        return redirect()->back()->with('success', "{$user['email']} is now a {$role}.");
    }

    public function toggleStatus($userId)
    {
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $newStatus = ($user['status'] === 'active') ? 'disabled' : 'active';
        $userModel->update($userId, ['status' => $newStatus]);

        return redirect()->back()->with('success', "{$user['email']} status changed to {$newStatus}.");
    }
}
