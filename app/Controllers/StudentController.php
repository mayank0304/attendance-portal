<?php

namespace App\Controllers;

use App\Models\StudentModel;

class StudentController extends BaseController
{
    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/')->with('error', 'You need to log in first.');
        } 
        
        $studentModel = new StudentModel();
        $data['students'] = $studentModel->findAll();

        return view('students/index', $data);
    }
}
