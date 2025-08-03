<?= $this->include('includes/header') ?>

<div class="container-fluid py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/institutions">Manajemen Institusi</a></li>
            <li class="breadcrumb-item active">Edit Institusi</li>
        </ol>
    </nav>

    <?php if (isset($success)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><?= esc($success) ?></strong>
            <?php if (isset($show_back_button)): ?>
                <div class="mt-2">
                    <a href="/dashboard/institutions" class="btn btn-outline-success btn-sm">Kembali ke Daftar Institusi &raquo;</a>
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
                    <h5 class="card-title mb-0">Edit Institusi</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="/dashboard/institutions/edit/<?= $institution['id'] ?>">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Institusi</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="<?= esc($institution['name']) ?>" 
                                   placeholder="Contoh: Universitas Indonesia" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea class="form-control" id="address" name="address" rows="3" 
                                      placeholder="Alamat lengkap institusi..."><?= esc($institution['address'] ?? '') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="code" class="form-label">Kode Institusi <small class="text-muted">(Opsional)</small></label>
                            <input type="text" class="form-control" id="code" name="code" 
                                   value="<?= esc($institution['code'] ?? '') ?>" 
                                   placeholder="Contoh: UI, ITB, UGM">
                            <small class="text-muted">Kode singkat untuk institusi, jika ada</small>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                       <?= $institution['is_active'] ? 'checked' : '' ?>>
                                <label class="form-check-label" for="is_active">
                                    Institusi Aktif
                                </label>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn" style="background-color: #38b6ff; border-color: #38b6ff; color: white;">Update Institusi</button>
                            <a href="/dashboard/institutions" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('includes/footer') ?>