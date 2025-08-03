<?= $this->include('includes/header') ?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-4">Dasbor</h1>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Total Pengguna</h5>
                    <h2 style="color: #38b6ff;"><?= $total_users ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Total Kelas</h5>
                    <h2 class="text-success"><?= $total_classes ?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h4 class="mb-3">Menu Kelola</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Pengguna</h5>
                    <p class="card-text">Kelola Pengajar dan Peserta</p>
                    <a href="/dashboard/users" class="btn" style="background-color: #38b6ff; border-color: #38b6ff; color: white;">Kelola</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Kelas</h5>
                    <p class="card-text">Kelola daftar kelas</p>
                    <a href="/dashboard/classes" class="btn btn-success">Kelola</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Kriteria Nilai</h5>
                    <p class="card-text">Kategorikan nilai dari huruf ke angka</p>
                    <a href="/dashboard/criteria" class="btn btn-warning">Kelola</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-3">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Pembobotan</h5>
                    <p class="card-text">Konfigurasi bobot penilaian</p>
                    <a href="/dashboard/weightings" class="btn btn-info">Kelola</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('includes/footer') ?>