<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new AdminModel();
    }

    public function login()
    {
        return view('login');
    }


    public function registerUser() {
        $username = "admin";
        $password= "admin@132";

        $this->userModel->register($username, $password);
        return redirect()->to('/')->with('success', 'Registration successful');
    }

    public function loginUser()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Attempt to login
        $user = $this->userModel->login($username, $password);

        if ($user) {
            session()->set('user_id', $user['id']);
            return redirect()->to('/students');
        } else {
            // Handle login failure
            return redirect()->to('/')->with('error', 'Invalid email or password');
        }
    }

    public function logout()
    {
        session()->remove('user_id');
        return redirect()->to('/')->with('success', 'Logged out successfully');
    }
}