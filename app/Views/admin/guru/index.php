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
                    <h5 class="card-title">Daftar Guru SMAN 1 Malaka</h5>
                    <div class="d-flex justify-content-end">
                        <a href="<?= base_url('admin/guru/tambah') ?>" class="btn btn-primary mr-2 ml-2 m-2"><i class="bi bi-plus"></i>Tambah</a>
                        <a href="<?= base_url('admin/guru/cetak') ?>" class="btn btn-warning ml-2 mr-2 m-2"><i class="bi bi-printer"></i> Cetak</a>
                    </div>
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>NIP</th>
                                <th>Nama Lengkap</th>
                                <th>JK</th>
                                <th>Tempat Lahir</th>
                                <th>Tgl Lahir</th>
                                <th>HP</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_guru as $guru) : ?>
                                <tr>
                                    <td><?= $guru->guru_nip ?></td>
                                    <td><?= $guru->guru_nama ?></td>
                                    <td><?= $guru->guru_jk ?></td>
                                    <td><?= $guru->guru_tempat_lahir ?></td>
                                    <td><?= $guru->guru_tgl_lahir ?></td>
                                    <td><?= $guru->guru_hp ?></td>
                                    <td>
                                        <?= form_open('admin/guru/hapus') ?>
                                        <a href="<?= base_url('admin/guru/edit/' . $guru->guru_id) ?>" class="badge bg-secondary">edit</a>
                                        <input type="hidden" name="guru_id" value="<?= $guru->guru_id ?>">
                                        <button type="submit" onclick="return confirm('Apakah anda yakin?')" class="badge bg-danger border">hapus</button>
                                        </form>
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