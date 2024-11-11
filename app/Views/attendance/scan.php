<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-light">
        <div class="container-fluid">
            <a class="navbar-brand fs-3 ps-4 text-dark text-center" href="#" style="color: #002244;">Student
                Attendance</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto pt-3 pe-4">
                    <li class="nav-item">
                        <button class="btn"><a href="<?= site_url('/students') ?>" class="btn text-light text-center"
                                style="background-color: #002244;">Students</a></button>
                    </li>
                    <li class="nav-item">
                        <button class="btn">
                            <a href="<?= site_url('/attendance/records') ?>" class="btn text-light text-center"
                                style="background-color: #002244;">Attendance</a>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="btn">
                            <a href="<?= site_url('/attendance/create') ?>" class="btn text-light text-center"
                                style="background-color: #002244;">Create today's attendance</a>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="btn">
                            <a href="<?= site_url('/logout') ?>" class="btn text-light text-center"
                                style="background-color: #002244;">Logout</a>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <h1 class="text-center mt-4">Scan QR Code to Mark Attendance</h1>

    <!-- Alert container -->
    <div id="alert-container" class="container mt-3"></div>

    <div class="d-flex justify-content-center align-items-center mt-5">
        <div id="qr-reader" style="width: 700px; height: 600px;"></div>
    </div>

    <!-- Ensure you're using the correct version of the library -->
    <script src="https://unpkg.com/html5-qrcode"></script>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // Extract CRN from the decoded QR data
            const crn = decodedText.split(":")[1];

            // Send the decoded CRN to the backend to mark attendance
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>