<?= $this->include('includes/header') ?>

<div class="container-fluid py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Manajemen Kelas</li>
        </ol>
    </nav>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <a href="/dashboard" class="btn btn-outline-success btn-sm ms-2">Kembali ke Dashboard &raquo;</a>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Manajemen Kelas</h4>
        <a href="/dashboard/classes/create" class="btn" style="background-color: #38b6ff; border-color: #38b6ff; color: white;">Tambah Kelas</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Kelas</th>
                    <th>Kode Kelas</th>
                    <th>Deskripsi</th>
                    <th>Tahun</th>
                    <th>Status</th>
                    <th>Link Undangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($classes)): ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            Tidak ada kelas ditemukan.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($classes as $class): ?>
                        <tr>
                            <td><?= $class['id'] ?></td>
                            <td><?= esc($class['class_name']) ?></td>
                            <td>
                                <code><?= esc($class['class_code']) ?></code>
                            </td>
                            <td><?= esc($class['description'] ?? '-') ?></td>
                            <td><?= esc($class['year'] ?? '-') ?></td>
                            <td>
                                <span class="badge <?= $class['is_active'] ? 'bg-success' : 'bg-secondary' ?>">
                                    <?= $class['is_active'] ? 'Aktif' : 'Tidak Aktif' ?>
                                </span>
                            </td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" 
                                           value="<?= base_url($class['class_code']) ?>" 
                                           id="link_<?= $class['id'] ?>" readonly>
                                    <button class="btn btn-outline-secondary" type="button" 
                                            onclick="copyToClipboard('link_<?= $class['id'] ?>')">
                                        Copy
                                    </button>
                                </div>
                            </td>
                            <td>
                                <a href="/dashboard/classes/edit/<?= $class['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="/dashboard/classes/delete/<?= $class['id'] ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus kelas ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (isset($pager)): ?>
        <div class="d-flex justify-content-center">
            <?= $pager->links() ?>
        </div>
    <?php endif; ?>
</div>

<script>
function copyToClipboard(elementId) {
    const element = document.getElementById(elementId);
    element.select();
    element.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(element.value);
    
    const button = element.nextElementSibling;
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