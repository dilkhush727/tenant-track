<?php namespace App\Controllers;

class TestPost extends \CodeIgniter\Controller
{
    public function form()
    {
        helper('form');
        echo view('test_form');
    }

    public function submit()
    {
        $data = $this->request->getPost();
        echo '<h2>Request Method: ' . $_SERVER['REQUEST_METHOD'] . '</h2>';
        echo '<pre>$_POST = '; print_r($data); echo '</pre>';
    }
}
