<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Admin LMS' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #38b6ff;">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="/dashboard">
                <img src="/assets/img/logo-white.png" alt="Logo" height="30" class="me-2">
                Admin LMS
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/users">Pengguna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/classes">Kelas</a>
                    </li>
                </ul>
                <div class="navbar-nav">
                    <span class="navbar-text me-3">
                        Selamat datang, <?= session()->get('admin_username') ?>
                    </span>
                    <a class="nav-link" href="/dashboard/logout">Keluar</a>
                </div>
            </div>
        </div>
    </nav>