<?= $this->include('includes/header') ?>

<div class="container-fluid py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/classes">Manajemen Kelas</a></li>
            <li class="breadcrumb-item active">Tambah Kelas</li>
        </ol>
    </nav>

    <?php if (isset($success)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><?= esc($success) ?></strong>
            <?php if (isset($show_back_button)): ?>
                <div class="mt-2">
                    <a href="/dashboard/classes" class="btn btn-outline-success btn-sm">Kembali ke Daftar Kelas &raquo;</a>
                    <button type="button" class="btn btn-success btn-sm" onclick="location.reload()">Tambah Lagi</button>
                </div>
            <?php endif; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($errors) && !empty($errors)): ?>
        <div class="alert alert-danger">
            <strong>Silakan perbaiki kesalahan berikut:</strong>
            <ul class="mb-0 mt-2">
                <?php foreach ($errors as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Tambah Kelas Baru</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="/dashboard/classes/create">
                        <div class="mb-3">
                            <label for="class_name" class="form-label">Nama Kelas</label>
                            <input type="text" class="form-control" id="class_name" name="class_name" 
                                   value="<?= isset($old['class_name']) ? esc($old['class_name']) : '' ?>" 
                                   placeholder="Contoh: Matematika Kelas XII IPA 1" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi <small class="text-muted">(Opsional)</small></label>
                            <textarea class="form-control" id="description" name="description" rows="3" 
                                      placeholder="Deskripsi singkat tentang kelas ini..."><?= isset($old['description']) ? esc($old['description']) : '' ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="year" class="form-label">Tahun <small class="text-muted">(Opsional)</small></label>
                            <input type="number" class="form-control" id="year" name="year" 
                                   value="<?= isset($old['year']) ? esc($old['year']) : date('Y') ?>" 
                                   min="2020" max="<?= date('Y') + 5 ?>" 
                                   placeholder="<?= date('Y') ?>">
                        </div>

                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i>
                            <strong>Info:</strong> Kode kelas akan dibuat secara otomatis setelah kelas disimpan. Kode ini dapat digunakan sebagai link undangan untuk peserta.
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn" style="background-color: #38b6ff; border-color: #38b6ff; color: white;">Tambah Kelas</button>
                            <a href="/dashboard/classes" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('includes/footer') ?>