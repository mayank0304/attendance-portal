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
}
