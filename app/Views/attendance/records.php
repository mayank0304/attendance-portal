<!-- app/Views/attendance/records.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-light">
        <div class="container-fluid">
            <a class="navbar-brand fs-3 ps-4 text-dark text-center" href="#" style="color: #002244; ">Student Attendance</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto pt-3 pe-4">
                <li class="nav-item">
                        <button class="btn"><a href="<?= site_url('/attendance/scan') ?>"
                                class="btn text-light text-center" style="background-color: #002244;">Scan</a></button>
                    </li>
                    <li class="nav-item">
                    <button class="btn"><a href="<?= site_url('/students') ?>"
                                            class="btn text-light text-center"
                                            style="background-color: #002244;">Students</a></button>
                </li>
                <li class="nav-item">
                        <button class="btn">
                            <a href="<?= site_url('/logout') ?>" class="btn text-light text-center"
                                style="background-color: #002244;">Logout</a>
                        </button>
                    </li>
                    <!-- Add other nav items here -->
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center">Attendance Records</h2>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th scope="col">CRN</th>
                    <th scope="col">Attendance Date</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($attendanceRecords as $record): ?>
                    <tr class="<?= $record['status'] == 1 ? 'table-success' : 'table-danger' ?>">
                        <td><?= esc($record['crn']) ?></td>
                        <td><?= esc($record['attendance_date']) ?></td>
                        <td><?= $record['status'] == 1 ? 'Present' : 'Absent' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
