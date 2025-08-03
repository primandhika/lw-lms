<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>LW-LMS - Learning Management System</title>
    <meta name="description" content="Lightweight Learning Management System">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-logo {
            animation: slideInDown 0.8s ease-out;
        }
        
        .animate-title {
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }
        
        .animate-subtitle {
            animation: fadeInUp 0.8s ease-out 0.4s both;
        }
        
        .animate-description {
            animation: fadeInUp 0.8s ease-out 0.6s both;
        }
        
        .animate-button {
            animation: fadeInUp 0.8s ease-out 0.8s both;
        }
        
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<main class="flex-shrink-0">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 80vh;">
            <div class="col-md-8 col-lg-6 text-center">
                <div class="mb-4 animate-logo">
                    <img src="/assets/img/logo-cyan.png" alt="LW-LMS Logo" class="img-fluid mb-3" style="max-height: 120px;">
                </div>
                <h1 class="display-4 fw-bold mb-3 animate-title" style="color: #38b6ff;">LW-LMS</h1>
                <p class="lead text-muted mb-4 animate-subtitle">Lightweight Learning Management System</p>
                <p class="mb-4 text-muted animate-description" style="font-weight: 300;">Belajar harus sederhana, ilmu mesti gampang dicerna. Cakep.</p>
                
                <div class="d-grid gap-2 d-md-block animate-button">
                    <a href="/login" class="btn btn-lg" style="background-color: #38b6ff; border-color: #38b6ff; color: white; padding: 12px 40px;">
                        Masuk Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="footer mt-auto py-3" style="background-color: #38b6ff;">
    <div class="container text-center">
        <span class="text-white">RBP Media &copy; 2016-<?= date('Y') ?></span>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>