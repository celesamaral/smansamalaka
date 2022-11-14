<?= $this->extend('layout_admin'); ?>
<?= $this->section('title'); ?>
<?= $title ?>
<?= $this->endSection() ?>
<?= $this->section('content'); ?>
<div class="pagetitle">
    <h1><?= $title ?></h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Tambah Admin</h5>
                    <?php if (session()->has('errors')) : ?>
                        <?php foreach (session('errors') as $e) : ?>
                            <p class="text-danger"><?= $e ?></p>
                        <?php endforeach; ?>
                    <?php endif ?>
                    <?= form_open('admin/store') ?>
                    <div class="form-group mb-4">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" value="<?= old('username') ?>" class="form-control" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="" class="form-control" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="" class="form-control" required>
                    </div>
                    <input type="submit" value="Simpan" class="btn btn-secondary">
                    </form>

                </div>
            </div>

        </div>

    </div>
</section>
<?= $this->endSection(); ?>