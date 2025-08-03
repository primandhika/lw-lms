<?= $this->include('includes/header_simple') ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            
            <!-- Alert Info Header -->
            <div class="alert alert-info text-center mb-4">
                <h5 class="mb-2"><i class="bi bi-info-circle"></i> Anda akan bergabung ke kelas</h5>
                <h4 class="mb-3"><?= esc($class['class_name']) ?></h4>
                
                <?php if (!empty($class['description'])): ?>
                    <p class="mb-3 text-muted"><?= esc($class['description']) ?></p>
                <?php endif; ?>
                
                <!-- Compact badges -->
                <div class="mb-0">
                    <span class="badge bg-secondary me-2">
                        <i class="bi bi-hash"></i> <?= esc($class['class_code']) ?>
                    </span>
                    <?php if (!empty($class['year'])): ?>
                    <span class="badge bg-dark">
                        <i class="bi bi-calendar"></i> <?= esc($class['year']) ?>
                    </span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Success Registration -->
            <?php if (isset($success) && $success): ?>
                <div class="alert alert-success">
                    <h5><i class="bi bi-check-circle"></i> Pendaftaran Berhasil!</h5>
                    <p class="mb-2">Selamat datang, <strong><?= esc($newUser['full_name']) ?></strong>!</p>
                    <div class="border rounded p-3 bg-light">
                        <h6>Detail Akun Anda:</h6>
                        <p class="mb-1"><strong>Username:</strong> <?= esc($newUser['username']) ?></p>
                        <p class="mb-1"><strong>Password:</strong> <code><?= esc($newUser['password']) ?></code></p>
                        <small class="text-muted">Password dapat diubah setelah login nanti.</small>
                    </div>
                    <div class="alert alert-warning mt-3">
                        <strong><i class="bi bi-exclamation-triangle"></i> Penting!</strong><br>
                        Harap catat username dan password Anda sebelum melanjutkan.
                    </div>
                    <div class="text-center mt-3">
                        <a href="/<?= esc($class['class_code']) ?>/joined" class="btn btn-success btn-lg">
                            <i class="bi bi-arrow-right"></i> Lanjut ke Kelas
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Error Messages -->
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

            <div class="card">
                <div class="card-body">

                    <!-- User Already Logged In -->
                    <?php if ($isLoggedIn && !isset($success)): ?>
                        <div class="text-center">
                            <h5>Halo, <?= esc($user['full_name']) ?>!</h5>
                            <p class="text-muted mb-4">Anda sudah login dan dapat bergabung ke kelas ini.</p>
                            
                            <?php if (isset($joined) && $joined): ?>
                                <div class="alert alert-success">
                                    <i class="bi bi-check-circle"></i> Anda berhasil bergabung ke kelas ini!
                                </div>
                            <?php else: ?>
                                <form method="POST">
                                    <input type="hidden" name="action" value="join_class">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-plus-circle"></i> Bergabung ke Kelas
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>

                    <!-- Registration Form for New Users -->
                    <?php elseif (!$isLoggedIn): ?>
                        <div class="row">
                            <div class="col-md-8 mx-auto">
                                <h5 class="text-center mb-4">Daftar untuk Bergabung</h5>
                                
                                <form method="POST">
                                    <div class="mb-3">
                                        <label for="institution_id" class="form-label">Institusi/Kampus/Sekolah</label>
                                        <select class="form-select" id="institution_id" name="institution_id" required>
                                            <option value="">Pilih Institusi</option>
                                            <?php foreach ($institutions as $institution): ?>
                                                <option value="<?= $institution['id'] ?>" 
                                                        <?= (isset($old['institution_id']) && $old['institution_id'] == $institution['id']) ? 'selected' : '' ?>>
                                                    <?= esc($institution['name']) ?> (<?= ucfirst($institution['type']) ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="username" class="form-label">NIM/NRP/NPM/NIS/No. Identitas</label>
                                        <input type="text" class="form-control" id="username" name="username" 
                                               value="<?= isset($old['username']) ? esc($old['username']) : '' ?>" 
                                               placeholder="Contoh: 2024001001" required>
                                        <small class="text-muted">Akan menjadi username untuk login</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="full_name" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="full_name" name="full_name" 
                                               value="<?= isset($old['full_name']) ? esc($old['full_name']) : '' ?>" 
                                               placeholder="Nama lengkap sesuai identitas" required>
                                        <small class="text-muted">Pastikan ejaan sesuai, nama tidak bisa diubah setelah register</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" 
                                               value="<?= isset($old['email']) ? esc($old['email']) : '' ?>" 
                                               placeholder="email@example.com" required>
                                        <small class="text-muted">Untuk menerima informasi akun dan password login</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="bio" class="form-label">Bio</label>
                                        <textarea class="form-control" id="bio" name="bio" rows="3" 
                                                  placeholder="Tulis hal-hal tentang Anda yang perlu pengajar dan rekan kelas ketahui"><?= isset($old['bio']) ? esc($old['bio']) : '' ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="nomor_kontak" class="form-label">No. Kontak <small class="text-muted">(Opsional)</small></label>
                                        <input type="text" class="form-control" id="nomor_kontak" name="nomor_kontak" 
                                               value="<?= isset($old['nomor_kontak']) ? esc($old['nomor_kontak']) : '' ?>" 
                                               placeholder="Contoh: +6281234567890">
                                        <small class="text-muted">Jika ingin diisi, disarankan yang terhubung WhatsApp</small>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="bi bi-person-plus"></i> Daftar dan Bergabung
                                        </button>
                                    </div>
                                    
                                    <div class="text-center mt-3">
                                        <small class="text-muted">
                                            Sudah punya akun? <a href="/login" class="text-decoration-none">Login di sini!</a>
                                        </small>
                                    </div>
                                </form>
                            </div>
                        </div>

                    <!-- Success State - Show Join Options -->
                    <?php else: ?>
                        <div class="text-center">
                            <form method="POST">
                                <input type="hidden" name="action" value="join_class">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="bi bi-plus-circle"></i> Bergabung ke Kelas Sekarang
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>

                    <!-- Back to Home -->
                    <div class="text-center mt-4">
                        <a href="/" class="btn btn-link">
                            <i class="bi bi-arrow-left"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error Duplikasi -->
<?php if (isset($duplicate_error)): ?>
<div class="modal fade" id="duplicateModal" tabindex="-1" aria-labelledby="duplicateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="duplicateModalLabel">
                    <i class="bi bi-exclamation-triangle"></i> Pendaftaran Gagal
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-3">
                    <i class="bi bi-person-x" style="font-size: 3rem; color: #dc3545;"></i>
                </div>
                <p class="mb-3">
                    <strong>NIM <?= esc($duplicate_error['nim']) ?></strong> di 
                    <strong><?= esc($duplicate_error['institution']) ?></strong> sudah terdaftar.
                </p>
                <p class="text-muted">Silakan login ke sistem dengan akun yang sudah ada.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="/login" class="btn btn-primary">
                    <i class="bi bi-box-arrow-in-right"></i> Login Sekarang
                </a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
// Auto show modal on load
document.addEventListener('DOMContentLoaded', function() {
    const duplicateModal = new bootstrap.Modal(document.getElementById('duplicateModal'));
    duplicateModal.show();
});
</script>
<?php endif; ?>


<?= $this->include('includes/footer') ?>