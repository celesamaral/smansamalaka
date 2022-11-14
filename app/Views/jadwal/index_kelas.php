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
                    <h5 class="card-title">Daftar Kelas</h5>
                    <div class="d-flex justify-content-end mb-4">
                        <?= form_open('admin/jadwal/bersihkan') ?>
                        <button onclick="return confirm('Apakah anda yakin?')" class="btn btn-sm btn-danger">
                            <i class="bi bi-trash"></i> Bersihkan Jadwal
                        </button>
                    </div>
                    <!-- End Tooltips Examples -->
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>Kelas</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_kelas as $kelas) : ?>
                                <tr>
                                    <td><?= $kelas->kelas_tingkat ?> <?= $kelas->jurusan_nama ?> <?= $kelas->kelas_abjad ?></td>
                                    <td>
                                        <a class="badge bg-secondary mr-2" href="<?= base_url('admin/jadwal/' . $kelas->kelas_id) ?>">
                                            lihat jadwal
                                        </a>
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