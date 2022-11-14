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
                    <h5 class="card-title">Daftar Siswa</h5>
                    <!-- End Tooltips Examples -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>NISN</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>JK</th>
                                <th>Kelas</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_siswa as $siswa) : ?>
                                <tr>
                                    <td><?= $siswa->siswa_nisn ?></td>
                                    <td><?= $siswa->siswa_nis ?></td>
                                    <td><?= $siswa->siswa_nama ?></td>
                                    <td><?= $siswa->siswa_jk ?></td>
                                    <td><?= $siswa->kelas_tingkat ?> <?= $siswa->jurusan_nama ?> <?= $siswa->kelas_abjad ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/siswa/' . $siswa->siswa_id) ?>" class="badge bg-dark mr-2">detail</a>
                                        <a href="<?= base_url('admin/siswa/' . $siswa->siswa_id . '/edit') ?>" class="badge bg-secondary mr-2">edit</a>
                                        <input type="hidden" name="siswa_id" value="<?= $siswa->siswa_id ?>" class="d-none">
                                        <!-- <button type="submit" class="badge bg-danger border">hapus</button> -->
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