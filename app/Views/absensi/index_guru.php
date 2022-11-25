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
    <div class="row">
        <div class="col-lg-12">
            <?php if (session()->has('message')) : ?>
                <div class="alert alert-secondary">
                    <p><?= session('message') ?></p>
                </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Absensi Harian</h5>
                    <!-- End Tooltips Examples -->
                    <div class="d-flex justify-content-end mb-4">
                        <!-- Button trigger modal -->
                    </div>

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($absensi as $absen) : ?>
                                <tr>
                                    <td><?= $absen->absensi_tgl ?></td>
                                    <td>
                                        <a href="<?= base_url('guru/absensi/' . $absen->absensi_id) ?>" class="badge bg-info">Absen</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</section>
<?= $this->endSection(); ?>