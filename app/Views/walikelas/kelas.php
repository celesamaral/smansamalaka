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

            <?php if (session()->getFlashdata('message')) : ?>
                <div class="alert alert-secondary">
                    <p><?= session()->getFlashdata('message') ?></p>
                </div>
            <?php endif; ?>
            <?php if (!empty($data_kelas)) : ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tabel Daftar Kelas</h5>
                        <!-- End Tooltips Examples -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Kelas</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_kelas as $kelas) : ?>
                                    <tr>
                                        <td><?= $kelas->kelas_tingkat ?> <?= $kelas->jurusan_nama ?> <?= $kelas->kelas_abjad ?></td>
                                        <td>
                                            <a href="<?= base_url('guru/walikelas/' . $kelas->kelas_id) ?>" class="badge bg-secondary">Daftar Siswa</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif ?>

        </div>

    </div>
</section>
<?= $this->endSection(); ?>