<!DOCTYPE html>
<html lang="id">
<head>
    <title><?= $title ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-sm w-100" style="max-width: 400px;">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <h6 class="card-title">System Administrator</h6>
                </div>
                
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger mb-3"><?= $error ?></div>
                <?php endif; ?>
                
                <?= form_open('/syslog') ?>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Nama Pengguna" required>
                    </div>
                    
                    <div class="mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Kata Pengguna" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 py-2">Masuk</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>