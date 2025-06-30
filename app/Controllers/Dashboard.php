<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        if (!session('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $role = session('role');

        // Role-based redirect
        switch ($role) {
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
}
