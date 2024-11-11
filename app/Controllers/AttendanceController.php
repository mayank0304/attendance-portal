<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\AttendanceModel;
use CodeIgniter\CLI\Console;

class AttendanceController extends BaseController
{
    public function scanQrCode()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/')->with('error', 'You need to log in first.');
        } 
        return view('attendance/scan');
    }

     // Method to mark all students as absent for the day
     public function markAllAbsent()
     {
         // Only admin can mark all as absent
         if (!session()->has('user_id')) {
            return redirect()->to('/')->with('error', 'You need to log in first.');
        }
         $studentModel = new StudentModel();
         $attendanceModel = new AttendanceModel();
         
         // Get the current date
         $todayDate = date('Y-m-d');
     
         // Fetch all students
         $students = $studentModel->findAll();
     
         // Create an absent record for each student for today if not already created
         foreach ($students as $student) {
             // Check if the attendance record for the given crn and date exists
             $existingRecord = $attendanceModel->where('crn', $student['crn'])
                                               ->where('attendance_date', $todayDate)
                                               ->first();
     
             // If the record doesn't exist, insert a new one
             if (!$existingRecord) {
                 try {
                     $attendanceModel->save([
                         'crn' => $student['crn'],
                         'status' => 0, // Default as absent
                     ]);
                 } catch (\Exception $e) {
                     // Log error for debugging
                     log_message('error', "Failed to mark student CRN {$student['crn']} as absent: " . $e->getMessage());
                 }
             }
         }
     
         return redirect()->to('/attendance/scan')->with('success', 'All students marked as absent for today.');
     }
     

      // Method to scan QR and mark attendance as present for today
    public function markAttendance()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/')->with('error', 'You need to log in first.');
        }
        
        $input = $this->request->getJSON();
        if (isset($input->crn)) {
            // Cast crn to integer
            $crn = (int) $input->crn;

            // Get today's date
            $todayDate = date('Y-m-d');
            
            // Fetch the attendance record for the given CRN and date
            $attendanceModel = new AttendanceModel();
            $attendanceRecord = $attendanceModel->where('crn', $crn)
                                                ->where('attendance_date', $todayDate)
                                                ->first();


            if ($attendanceRecord) {
                switch ($attendanceRecord['status']) {
                    case 1:
                        // If already marked as present
                        return $this->response->setJSON(['status' => 'success', 'message' => 'Attendance already marked as present.']);
                    
                    case 0:
                        // If marked as absent, update attendance to present (status 1)
                        $attendanceModel->update($attendanceRecord['id'], [
                            'status' => 1
                        ]);
                        return $this->response->setJSON(['status' => 'success', 'message' => 'Attendance marked successfully.']);
                }
            } else {
                // No record for today (should not happen if markAllAbsent is run daily)
                return $this->response->setJSON(['status' => 'error', 'message' => 'Attendance record not found for today.']);
            }
                                                
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Student not found']);
    }

    public function attendanceRecords()
    {
        // Load the AttendanceModel
        $attendanceModel = new AttendanceModel();
        
        // Fetch records from the 'attendance_record' table
        // You can order by attendance_date
        $attendanceRecords = $attendanceModel->findAll();

        // Pass the records to the view
        return view('attendance/records', ['attendanceRecords' => $attendanceRecords]);
    }
 

    // public function markAttendance()
    // {
    //     if (!session()->has('user_id')) {
    //         return redirect()->to('/')->with('error', 'You need to log in first.');
    //     } 
    //     $input = $this->request->getJSON();
    //     if (isset($input->crn)) {
    //         // Cast crn to integer
    //         $crn = (int) $input->crn;

    //         // Now fetch the attendance record for the given CRN
    //         $attendanceModel = new AttendanceModel();
    //         $attendanceRecord = $attendanceModel->where('crn', $crn)
    //                                             ->where('attendance_date', date('Y-m-d'))
    //                                             ->first();

    //         if ($attendanceRecord) {
    //             return $this->response->setJson(['status' => 'success', 'message' => 'Attendance already marked.']);
    //         } else {
    //             // Mark attendance (status 1 for present)
    //             $attendanceModel->save([
    //                 'crn' => $crn,
    //                 'status' => 1 
    //             ]);
    //             return $this->response->setJson(['status' => 'success', 'message' => 'Attendance marked successfully.']);
    //         }
    //     }

    //     return $this->response->setJSON(['status' => 'error', 'message' => 'Student not found']);
    // }
}
