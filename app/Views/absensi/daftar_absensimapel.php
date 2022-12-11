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
                    <h5 class="card-title">Daftar Absensi Mata Pelajaran <?= $mapel->mapel_nama ?> Kelas <?= $kelas->kelas_tingkat ?> <?= $kelas->jurusan_nama ?> <?= $kelas->kelas_abjad ?></h5>
                    <!-- End Tooltips Examples -->
                    <div class="d-flex justify-content-end mb-4">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm m-1" data-bs-toggle="modal" data-bs-target="#form">
                            <i class="bi bi-plus"></i>
                            Buat Absensi
                        </button>
                        <a href="<?= base_url('guru/absensimapel/' . $mapel->mapel_id . '/' . $kelas->kelas_id . '/rekap') ?>" class="btn btn-warning btn-sm ml-2 mr-2 m-1">Rekapan</a>
                    </div>
                    <!-- End Tooltips Examples -->
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Tanggal Absensi</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_absensi as $absen) : ?>
                                    <tr>
                                        <td><?= $absen->absensimapel_tgl ?></td>
                                        <td>
                                            <a href="<?= base_url('guru/absensimapel/detail/' . $absen->absensimapel_id) ?>" class="badge bg-info">Absen</a>
                                            <a href="<?= base_url('guru/absensimapel/cetak/' . $absen->absensimapel_id) ?>" class="badge bg-warning">Cetak</a>
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
<div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Absensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('guru/absensimapel/store') ?>

            <input type="hidden" name="kelas_id" value="<?= $kelas->kelas_id ?>">
            <input type="hidden" name="mapel_id" value="<?= $mapel->mapel_id ?>">
            <input type="hidden" name="tahunajaran_id" value="<?= tahunajaran()->tahunajaran_id ?>">

            <div class="modal-body">
                <label for="">Tanggal Absensi</label>
                <input type="date" name="absensimapel_tgl" id="" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Buat Absensi</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<?= $this->endSection(); ?>