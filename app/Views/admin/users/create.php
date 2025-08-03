<?= $this->include('includes/header') ?>

<div class="container-fluid py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/users">Manajemen Pengguna</a></li>
            <li class="breadcrumb-item active">Tambah Pengguna</li>
        </ol>
    </nav>

    <?php if (isset($success)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><?= esc($success) ?></strong>
            <?php if (isset($show_back_button)): ?>
                <div class="mt-2">
                    <a href="/dashboard/users" class="btn btn-outline-success btn-sm">Kembali ke Daftar Pengguna &raquo;</a>
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
                    <h5 class="card-title mb-0">Tambah Pengguna Baru</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="/dashboard/users/create">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" 
                                           value="<?= isset($old['username']) ? esc($old['username']) : '' ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?= isset($old['email']) ? esc($old['email']) : '' ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="role_id" class="form-label">Peran</label>
                                    <select class="form-select" id="role_id" name="role_id" required>
                                        <option value="">Pilih Peran</option>
                                        <?php foreach ($roles as $role): ?>
                                            <option value="<?= $role['id'] ?>" 
                                                    <?= (isset($old['role_id']) && $old['role_id'] == $role['id']) ? 'selected' : '' ?>>
                                                <?= $role['name'] === 'teacher' ? 'Pengajar' : ($role['name'] === 'student' ? 'Peserta' : ucfirst($role['name'])) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="full_name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" 
                                   value="<?= isset($old['full_name']) ? esc($old['full_name']) : '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="nomor_kontak" class="form-label">Nomor Kontak <small class="text-muted">(Opsional)</small></label>
                            <input type="text" class="form-control" id="nomor_kontak" name="nomor_kontak" 
                                   value="<?= isset($old['nomor_kontak']) ? esc($old['nomor_kontak']) : '' ?>" 
                                   placeholder="Contoh: +62812345678">
                        </div>

                        <div class="mb-3">
                            <label for="bio" class="form-label">Bio <small class="text-muted">(Opsional)</small></label>
                            <textarea class="form-control" id="bio" name="bio" rows="3" 
                                      placeholder="Ceritakan tentang diri Anda..."><?= isset($old['bio']) ? esc($old['bio']) : '' ?></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn" style="background-color: #38b6ff; border-color: #38b6ff; color: white;">Tambah Pengguna</button>
                            <a href="/dashboard/users" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('includes/footer') ?>