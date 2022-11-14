<?= $this->extend('layout_admin'); ?>
<?= $this->section('title'); ?>
<?= $title ?>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<div class="pagetitle">
    <h1><?= $title ?></h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Components</li>
            <li class="breadcrumb-item active">Tooltips</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <?php if (session()->has('message')) : ?>
                <div class="alert alert-secondary">
                    <p><?= session('message') ?></p>
                </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Jurusan</h5>

                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <thead>
                                <th>Jurusan</th>
                            </thead>
                            <tbody>
                                <?php foreach ($data_jurusan as $jurusan) : ?>
                                    <tr>
                                        <td>
                                            <a href="<?= base_url('admin/pembagian_kelas/' . $jurusan->jurusan_id) ?>" class="link-primary"><?= $jurusan->jurusan_nama ?></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>
<?= $this->endSection(); ?>