<?= $this->extend('layout_guru'); ?>
<?= $this->section('title'); ?>
<?= $title ?>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<div class="pagetitle">
    <h1><?= $title ?></h1>
    <!-- <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Components</li>
            <li class="breadcrumb-item active">Tooltips</li>
        </ol>
    </nav> -->
</div><!-- End Page Title -->

<section class="section">
    <?php if (session()->has('message')) : ?>
        <div class="alert alert-secondary">
            <p><?= session('message') ?></p>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-4">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Foto Profil</h5>
                    <!-- End Tooltips Examples -->
                    <img src="<?= base_url('assets/img/profile/' . $guru->user_profile) ?>" alt="" class="img-thumbnail">
                    <?= form_open_multipart('guru/update_profile') ?>
                    <input type="hidden" name="user_id" value="<?= $guru->user_id ?>">
                    <div class="form-group mb-4">
                        <label for="userfile">Pilih Foto</label>
                        <input type="file" class="form-control form-control-sm <?= (isset(session('errors')['userfile'])) ? 'is-invalid' : '' ?>" id="userfile" name="userfile" value="<?= old('userfile') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['userfile'])) : ?>
                                <?= session('errors')['userfile'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <button type="submit" class="btn btn-primary btn-block">Ganti Foto Profil</button>
                    </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Diri</h5>
                    <table class="table">
                        <tr>
                            <th>Nama</th>
                            <td><?= $guru->guru_nama ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td><?= $guru->guru_jk ?></td>
                        </tr>
                        <tr>
                            <th>TTL</th>
                            <td>
                                <?= $guru->guru_tempat_lahir ?>, <?= $guru->guru_tgl_lahir ?>
                            </td>
                        </tr>
                        <tr>
                            <th>No. HP</th>
                            <td><?= $guru->guru_hp ?></td>
                        </tr>
                    </table>
                    <h5 class="card-title">Password</h5>
                    <?= form_open('guru/ganti_password') ?>
                    <input type="hidden" name="user_id" value="<?= $guru->user_id ?>">
                    <div class="form-group mb-4">
                        <label for="password_lama">Password Lama</label>
                        <input type="password" class="form-control <?= (isset(session('errors')['password_lama'])) ? 'is-invalid' : '' ?>" id="password_lama" name="password_lama" value="<?= old('password_lama') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['password_lama'])) : ?>
                                <?= session('errors')['password_lama'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="password">Password Baru</label>
                        <input type="password" class="form-control <?= (isset(session('errors')['password'])) ? 'is-invalid' : '' ?>" id="password" name="password" value="<?= old('password') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['password'])) : ?>
                                <?= session('errors')['password'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="confirmation_password">Konfirmasi Password</label>
                        <input type="password" class="form-control <?= (isset(session('errors')['confirmation_password'])) ? 'is-invalid' : '' ?>" id="confirmation_password" name="confirmation_password" value="<?= old('confirmation_password') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['confirmation_password'])) : ?>
                                <?= session('errors')['confirmation_password'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-sm">Ganti Password</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection(); ?>