<?= $this->extend('layout_siswa'); ?>
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
        <div class="col-md-6">
            <?php if (session()->has('message')) : ?>
                <div class="alert alert-secondary">
                    <p><?= session('message') ?></p>
                </div>
            <?php endif; ?>
            <?php foreach ($data_hari as $hari) : ?>
                <?php if (!empty($hari->jadwal)) : ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $hari->hari_nama ?></h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Mata Pelajaran</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($hari->jadwal as $jadwal) : ?>
                                        <tr>
                                            <td><?= ($jadwal->jadwal_jenis == 'Pelajaran') ? $jadwal->mapel_nama : '<b>' . $jadwal->jadwal_jenis . '</b>' ?></td>
                                            <td><?= $jadwal->jadwal_mulai ?> - <?= $jadwal->jadwal_selesai ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif ?>
            <?php endforeach; ?>
        </div>

    </div>
</section>
<?= $this->endSection(); ?>