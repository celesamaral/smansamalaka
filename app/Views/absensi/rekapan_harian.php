<?= $this->extend('layout_admin'); ?>
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
                    <h5 class="card-title">Absensi Tanggal : <?= $absensi->absensi_tgl ?></h5>
                    <!-- End Tooltips Examples -->
                    <h5 class="card-title">Kelas <?= $kelas->kelas_tingkat ?> <?= $kelas->jurusan_nama ?> <?= $kelas->kelas_abjad ?></h5>
                    <div class="d-flex justify-content-end mb-4">
                        <a href="<?= base_url('admin/absensi/' . $absensi->absensi_id . '/' . $kelas->kelas_id . '/cetak') ?>" class="btn btn-sm btn-warning"><i class="bi bi-printer"></i> Cetak</a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th style="width: 20%;">Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_absensi as $absen) : ?>
                                <tr>
                                    <td><?= $absen->siswa_nama ?></td>
                                    <td><?= $absen->detailabsensi_kehadiran ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</section>
<?= $this->endSection(); ?>