<?= $this->include('includes/header') ?>

<div class="container-fluid py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/classes">Manajemen Kelas</a></li>
            <li class="breadcrumb-item active">Edit Kelas</li>
        </ol>
    </nav>

    <?php if (isset($success)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><?= esc($success) ?></strong>
            <?php if (isset($show_back_button)): ?>
                <div class="mt-2">
                    <a href="/dashboard/classes" class="btn btn-outline-success btn-sm">Kembali ke Daftar Kelas &raquo;</a>
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
                    <h5 class="card-title mb-0">Edit Kelas</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="/dashboard/classes/edit/<?= $class['id'] ?>">
                        <div class="mb-3">
                            <label for="class_name" class="form-label">Nama Kelas</label>
                            <input type="text" class="form-control" id="class_name" name="class_name" 
                                   value="<?= esc($class['class_name']) ?>" 
                                   placeholder="Contoh: Matematika Kelas XII IPA 1" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi <small class="text-muted">(Opsional)</small></label>
                            <textarea class="form-control" id="description" name="description" rows="3" 
                                      placeholder="Deskripsi singkat tentang kelas ini..."><?= esc($class['description'] ?? '') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="year" class="form-label">Tahun <small class="text-muted">(Opsional)</small></label>
                            <input type="number" class="form-control" id="year" name="year" 
                                   value="<?= esc($class['year'] ?? '') ?>" 
                                   min="2020" max="<?= date('Y') + 5 ?>" 
                                   placeholder="<?= date('Y') ?>">
                        </div>

                        <div class="mb-3">
                            <label for="class_code" class="form-label">Kode Kelas</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="class_code" 
                                       value="<?= esc($class['class_code']) ?>" readonly>
                                <button class="btn btn-outline-secondary" type="button" 
                                        onclick="copyToClipboard('class_code')">
                                    Copy
                                </button>
                            </div>
                            <div class="form-text">
                                Link undangan: <strong><?= base_url($class['class_code']) ?></strong>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                       <?= $class['is_active'] ? 'checked' : '' ?>>
                                <label class="form-check-label" for="is_active">
                                    Kelas Aktif
                                </label>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn" style="background-color: #38b6ff; border-color: #38b6ff; color: white;">Update Kelas</button>
                            <a href="/dashboard/classes" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(elementId) {
    const element = document.getElementById(elementId);
    element.select();
    element.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(element.value);
    
    const button = element.parentElement.querySelector('button');
    const originalText = button.textContent;
    button.textContent = 'Copied!';
    button.classList.remove('btn-outline-secondary');
    button.classList.add('btn-success');
    
    setTimeout(() => {
        button.textContent = originalText;
        button.classList.remove('btn-success');
        button.classList.add('btn-outline-secondary');
    }, 2000);
}
</script>

<?= $this->include('includes/footer') ?>