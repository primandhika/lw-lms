<?= $this->include('includes/header') ?>

<div class="container-fluid py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Manajemen Pengguna</li>
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
        <h4 class="mb-0">Manajemen Pengguna</h4>
        <a href="/dashboard/users/create" class="btn" style="background-color: #38b6ff; border-color: #38b6ff; color: white;">Tambah Pengguna</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Surel</th>
                    <th>Nama Lengkap</th>
                    <th>Peran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            Tidak ada pengguna ditemukan.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= esc($user['username']) ?></td>
                            <td><?= esc($user['email']) ?></td>
                            <td><?= esc($user['full_name']) ?></td>
                            <td>
                                <?php 
                                $badgeClass = $user['role_name'] === 'administrator' ? 'bg-danger' : 
                                             ($user['role_name'] === 'teacher' ? 'bg-primary' : 'bg-success');
                                $roleName = $user['role_name'] === 'teacher' ? 'Pengajar' : 
                                           ($user['role_name'] === 'student' ? 'Peserta' : 'Administrator');
                                ?>
                                <span class="badge <?= $badgeClass ?>"><?= $roleName ?></span>
                            </td>
                            <td>
                                <span class="badge <?= $user['is_active'] ? 'bg-success' : 'bg-secondary' ?>">
                                    <?= $user['is_active'] ? 'Aktif' : 'Tidak Aktif' ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($user['role_name'] !== 'administrator'): ?>
                                    <a href="/dashboard/users/edit/<?= $user['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="/dashboard/users/delete/<?= $user['id'] ?>" 
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Hapus</a>
                                <?php else: ?>
                                    <span class="text-muted fst-italic">Dilindungi</span>
                                <?php endif; ?>
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