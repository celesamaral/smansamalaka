<?= $this->extend('layout_siswa'); ?>
<?= $this->section('title'); ?>
<?= $title ?>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<div class="pagetitle">
    <h1><?= $title ?></h1>
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
                    <h5 class="card-title">Rekapan Absensi</h5>
                    <!-- End Tooltips Examples -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Tahun Ajaran/Semester</th>
                                <th>Hadir</th>
                                <th>Sakit</th>
                                <th>Ijin</th>
                                <th>Tanpa Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_absensi as $absensi) : ?>
                                <tr>
                                    <td><?= $absensi->tahunajaran_tahun ?> Semester <?= $absensi->tahunajaran_semester ?></td>
                                    <td><?= $absensi->H ?></td>
                                    <td><?= $absensi->I ?></td>
                                    <td><?= $absensi->S ?></td>
                                    <td><?= $absensi->A ?></td>
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