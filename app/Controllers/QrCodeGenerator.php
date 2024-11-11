<?php

namespace App\Controllers;

use App\Models\StudentModel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class QrCodeGenerator extends BaseController
{
    public function generateQrCodes()
    {
        // Load the StudentModel
        $studentModel = new StudentModel();
        $students = $studentModel->findAll();

        foreach ($students as $student) {
            // Generate unique QR data for each student (customize as needed)
            $qrData = "crn:{$student['crn']}";

            // Create a new QR code object
            $qrCode = new QrCode($qrData);
            // $qrCode->setSize(200);

            // Generate the QR code using PngWriter
            $writer = new PngWriter();
            $result = $writer->write($qrCode);

            // Convert QR code to base64
            $qrCodeData = base64_encode($result->getString());

            // Update student record with QR code data
            $studentModel->update($student['id'], ['qr_code' => $qrCodeData]);

            echo "QR code generated and saved for student ID: {$student['id']}<br>";
        }

        echo "QR codes generated successfully.";

        return redirect()->to("/students");
    }

     // Add a new method to allow downloading the QR code PNG
     public function downloadQrCode($studentId)
     {
         // Load the StudentModel
         $studentModel = new StudentModel();
         $student = $studentModel->find($studentId);
 
         if ($student && isset($student['crn'])) {
             // Generate the QR code data
             $qrData = "crn:{$student['crn']}";
             $qrCode = new QrCode($qrData);
 
             // Use PngWriter to generate the PNG
             $writer = new PngWriter();
             $result = $writer->write($qrCode);
 
             // Set the correct headers to download the image
             return $this->response->setHeader('Content-Type', 'image/png')
                                    ->setHeader('Content-Disposition', 'attachment; filename="qr_code.png"')
                                    ->setBody($result->getString());
         }
 
         // Handle the case when the student is not found
         return redirect()->to("/students")->with('error', 'Student not found!');
     }
}
