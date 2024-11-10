<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model {
    protected $table = 'admin';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password'];

    public function register($username, $password)
    {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Prepare data for insertion
        $data = [
            'username' => $username,
            'password' => $hashedPassword,
            // 'created_at' will be automatically filled
        ];

        // Insert the user into the database
        return $this->insert($data);
    }

    public function login($username, $password)
    {
        $user = $this->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            return $user; // Return user array if login is successful
        }

        return false; // Return false if login fails
    }
}