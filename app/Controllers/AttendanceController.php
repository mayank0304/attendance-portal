<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\AttendanceModel;

class AttendanceController extends BaseController
{
    public function scanQrCode()
    {
        return view('attendance/scan');
    }

    public function markAttendance()
    {
        $input = $this->request->getJSON();
        if (isset($input->crn)) {
            // Cast crn to integer
            $crn = (int) $input->crn;

            // Now fetch the attendance record for the given CRN
            $attendanceModel = new AttendanceModel();
            $attendanceRecord = $attendanceModel->where('crn', $crn)
                                                ->where('attendance_date', date('Y-m-d'))
                                                ->first();

            if ($attendanceRecord) {
                return $this->response->setJson(['status' => 'success', 'message' => 'Attendance already marked.']);
            } else {
                // Mark attendance (status 1 for present)
                $attendanceModel->save([
                    'crn' => $crn,
                    'status' => 1 
                ]);
                return $this->response->setJson(['status' => 'success', 'message' => 'Attendance marked successfully.']);
            }
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Student not found']);
    }
}
