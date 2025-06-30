<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Guest implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session('isLoggedIn')) return redirect()->to('dashboard');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
