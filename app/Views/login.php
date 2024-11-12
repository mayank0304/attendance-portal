<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 col-md-10 col-lg-9" style="border: 2px solid #002244;">
                <div class="row shadow-lg p-2">
                    <div class="col-12 col-lg-5 col-md-12 d-flex align-items-center justify-content-center"
                        style="background-color: #002244;">
                        <h2 class="text-center text-light m-md-3">Attendance</h2>
                    </div>
                    <div class="col-12 col-lg-7 col-md-12 p-4 bg-light">
                        <!-- Error message display -->
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger text-center">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <h1 class="mb-3 text-center" style="color: #002244;">Sign In</h1>
                        <form action="<?= base_url('/loginUser') ?>" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="username" name="username" class="form-control" id="username"
                                    placeholder="Enter your username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Enter your password" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn text-light"
                                    style="background-color: #002244;">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>