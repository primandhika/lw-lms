<?= $this->include('includes/header_simple') ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            
            <div class="card border-success">
                <div class="card-header bg-success text-white text-center">
                    <h4 class="mb-0">
                        <i class="bi bi-check-circle"></i> Berhasil Bergabung!
                    </h4>
                </div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="bi bi-person-check" style="font-size: 4rem; color: #198754;"></i>
                    </div>
                    
                    <div class="alert alert-success">
                        <p class="mb-2">
                            <strong>Hai, <?= esc($user['full_name']) ?> (<?= esc($user['username']) ?>)</strong>
                        </p>
                        <p class="mb-2">
                            Kamu sudah bergabung di kelas <strong><?= esc($class['class_name']) ?></strong>.
                        </p>
                        <p class="mb-2">
                            Statusmu adalah <span class="badge bg-warning text-dark">Pending</span>.
                        </p>
                        <p class="mb-0">
                            Silakan cek kembali atau hubungi pengajar kelasmu untuk menyetujui proses keikutsertaanmu.
                        </p>
                    </div>
                    
                    <!-- Class Info -->
                    <div class="mb-4">
                        <h6 class="text-muted">Detail Kelas</h6>
                        <div class="mb-2">
                            <span class="badge bg-secondary me-2">
                                <i class="bi bi-hash"></i> <?= esc($class['class_code']) ?>
                            </span>
                            <?php if (!empty($class['year'])): ?>
                            <span class="badge bg-dark">
                                <i class="bi bi-calendar"></i> <?= esc($class['year']) ?>
                            </span>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($class['description'])): ?>
                            <p class="text-muted small"><?= esc($class['description']) ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="/" class="btn btn-primary">
                            <i class="bi bi-house"></i> Kembali ke Beranda
                        </a>
                        <a href="/login" class="btn btn-outline-secondary">
                            <i class="bi bi-box-arrow-in-right"></i> Login untuk Akses Kelas
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-3">
                <small class="text-muted">
                    Jika ada masalah, silakan hubungi administrator atau pengajar kelas.
                </small>
            </div>
        </div>
    </div>
</div>

<?= $this->include('includes/footer') ?>