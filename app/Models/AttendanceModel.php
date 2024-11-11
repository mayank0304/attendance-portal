<?php

namespace App\Models;

use CodeIgniter\Model;

class AttendanceModel extends Model
{
    protected $table = 'attendance_records';
    protected $primaryKey = 'id';

    protected $allowedFields = ['crn', 'attendance_date', 'status', 'created_at', 'updated_at'];

    // Enable automatic timestamps for created_at and updated_at
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
