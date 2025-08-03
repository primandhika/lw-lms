<?= $this->include('includes/header') ?>

<div class="container-fluid py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/users">Manajemen Pengguna</a></li>
            <li class="breadcrumb-item active">Edit Pengguna</li>
        </ol>
    </nav>

    <?php if (isset($success)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><?= esc($success) ?></strong>
            <?php if (isset($show_back_button)): ?>
                <div class="mt-2">
                    <a href="/dashboard/users" class="btn btn-outline-success btn-sm">Kembali ke Daftar Pengguna &raquo;</a>
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
                    <h5 class="card-title mb-0">Edit Pengguna: <?= esc($user['username']) ?></h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="/dashboard/users/edit/<?= $user['id'] ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" 
                                           value="<?= esc($user['username']) ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?= esc($user['email']) ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    <div class="form-text">Kosongkan jika tidak ingin mengubah password</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="role_id" class="form-label">Peran</label>
                                    <select class="form-select" id="role_id" name="role_id" required>
                                        <option value="">Pilih Peran</option>
                                        <?php foreach ($roles as $role): ?>
                                            <option value="<?= $role['id'] ?>" 
                                                    <?= ($user['role_id'] == $role['id']) ? 'selected' : '' ?>>
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
                                   value="<?= esc($user['full_name']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="nomor_kontak" class="form-label">Nomor Kontak <small class="text-muted">(Opsional)</small></label>
                            <input type="text" class="form-control" id="nomor_kontak" name="nomor_kontak" 
                                   value="<?= esc($user['nomor_kontak'] ?? '') ?>" 
                                   placeholder="Contoh: +62812345678">
                        </div>

                        <div class="mb-3">
                            <label for="bio" class="form-label">Bio <small class="text-muted">(Opsional)</small></label>
                            <textarea class="form-control" id="bio" name="bio" rows="3" 
                                      placeholder="Ceritakan tentang diri Anda..."><?= esc($user['bio'] ?? '') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                       <?= $user['is_active'] ? 'checked' : '' ?>>
                                <label class="form-check-label" for="is_active">
                                    Pengguna Aktif
                                </label>
                                <div class="form-text">Pengguna tidak aktif tidak dapat login ke sistem</div>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn" style="background-color: #38b6ff; border-color: #38b6ff; color: white;">Perbarui Pengguna</button>
                            <a href="/dashboard/users" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('includes/footer') ?>