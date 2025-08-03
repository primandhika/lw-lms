<?= $this->include('includes/header') ?>

<div class="container-fluid py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Manajemen Institusi</li>
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
        <h4 class="mb-0">Manajemen Institusi</h4>
        <a href="/dashboard/institutions/create" class="btn" style="background-color: #38b6ff; border-color: #38b6ff; color: white;">Tambah Institusi</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Institusi</th>
                    <th>Alamat</th>
                    <th>Kode Institusi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($institutions)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Tidak ada institusi ditemukan.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($institutions as $institution): ?>
                        <tr>
                            <td><?= $institution['id'] ?></td>
                            <td><?= esc($institution['name']) ?></td>
                            <td><?= esc($institution['address'] ?? '-') ?></td>
                            <td>
                                <?php if (!empty($institution['code'])): ?>
                                    <code><?= esc($institution['code']) ?></code>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="badge <?= $institution['is_active'] ? 'bg-success' : 'bg-secondary' ?>">
                                    <?= $institution['is_active'] ? 'Aktif' : 'Tidak Aktif' ?>
                                </span>
                            </td>
                            <td>
                                <a href="/dashboard/institutions/edit/<?= $institution['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="/dashboard/institutions/delete/<?= $institution['id'] ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus institusi ini?')">Hapus</a>
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

<?= $this->include('includes/footer') ?>