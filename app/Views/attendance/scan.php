<!-- app/Views/attendance/scan.php -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>QR Code Scanner</title>
    </head>
    <body>
        <h1>Scan QR Code to Mark Attendance</h1>
        <div id="qr-reader" style="width: 800px; height: 700px;"></div>

        <!-- Ensure you're using the correct version of the library -->
        <script src="https://unpkg.com/html5-qrcode"></script>

        <script>
            function onScanSuccess(decodedText, decodedResult) {
                // Send decoded data (crn) to the backend to mark attendance
                console.log(decodedText);  // Output the decoded data to the console for debugging
                const crn = decodedText.split(":")[1];


                fetch('/attendance/mark', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ crn: crn })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert(data.message);
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
            }

            // Start the QR code scanner
            const html5QrCode = new Html5Qrcode("qr-reader");
            html5QrCode.start(
                { facingMode: "environment" },  // Ensure it's using the rear camera
                {
                    fps: 10,  // Frames per second for scanning
                    qrbox: 400  // Size of the QR box to highlight the QR code
                },
                onScanSuccess
            ).catch(err => {
                console.error("Error starting QR code scanner:", err);
                alert("Unable to access camera: " + err);
            });
        </script>
    </body>
</html>
