<?= $this->extend('layout_guru'); ?>
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
                    <h5 class="card-title">Rekapan Absensi Mata Pelajaran <?= $mapel->mapel_nama ?> Kelas <?= $kelas->kelas_tingkat ?> <?= $kelas->jurusan_nama ?> <?= $kelas->kelas_abjad ?></h5>
                    <!-- End Tooltips Examples -->
                    <a href="<?= base_url('guru/absensimapel/' . $mapel->mapel_id . '/' . $kelas->kelas_id . '/cetak') ?>" class="btn btn-warning btn-sm ml-2 mr-2 m-1"><i class="bi bi-printer"></i>
                        Cetak
                    </a>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Hadir</th>
                                <th>Sakit</th>
                                <th>Ijin</th>
                                <th>Tanpa Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_siswa as $siswa) : ?>
                                <tr>
                                    <td><?= $siswa->siswa_nama ?></td>
                                    <td><?= $siswa->absensi->H ?></td>
                                    <td><?= $siswa->absensi->I ?></td>
                                    <td><?= $siswa->absensi->S ?></td>
                                    <td><?= $siswa->absensi->A ?></td>
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