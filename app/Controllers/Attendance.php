<?php

namespace App\Controllers;

class Attendance extends BaseController {
    public function attend() {

        if (!session()->has('user_id')) {
            return redirect()->to('/')->with('error', 'You need to log in first.');
        } 

        return view('attend');
    }
}