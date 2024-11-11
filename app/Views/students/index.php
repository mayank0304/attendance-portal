<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Students with QR Codes</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-light">
        <div class="container-fluid">
            <a class="navbar-brand fs-3 ps-4 text-dark text-center" href="#" style="color: #002244; ">Student
                Attendance</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto pt-3 pe-4">
                    <li class="nav-item">
                        <button class="btn"><a href="<?= site_url('/attendance/scan') ?>"
                                class="btn text-light text-center" style="background-color: #002244;">Scan</a></button>
                    </li>
                    <li class="nav-item">
                        <button class="btn"><a href="<?= site_url('/generate-qr-codes') ?>"
                                class="btn text-light text-center" style="background-color: #002244;">Generate Qr Codes</a></button>
                    </li>
                    <li class="nav-item">
                        <button class="btn">
                            <a href="<?= site_url('/attendance/records') ?>" class="btn text-light text-center"
                                style="background-color: #002244;">Attendance</a>
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

    <div class="p-4">
        <h1>Students Details</h1>
        <table class="table table-hover tabler-bordered table-striped table-light" style="border:2px solid #002244;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>CRN</th>
                    <th>URn</th>
                    <th>Email</th>
                    <th>QR Code</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= $student['id'] ?></td>
                        <td><?= $student['name'] ?></td>
                        <td><?= $student['crn'] ?></td>
                        <td><?= $student['urn'] ?></td>
                        <td><?= $student['email'] ?></td>
                        <td>
                            <?php if ($student['qr_code']): ?>
                                <div>
                                    <!-- Display the QR code image -->
                                    <!-- <img src="data:image/png;base64, <?= $student['qr_code'] ?>" alt="QR Code">- -->

                                    <!-- Add a download link for the QR code PNG -->
                                    <a href="<?= site_url('qr-code-generator/downloadQrCode/' . $student['id']) ?>"
                                        download="qr_code.png">
                                        Download QR Code
                                    </a>
                                </div>
                            <?php else: ?>
                                No QR Code
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>