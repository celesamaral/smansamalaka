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
                    <h5 class="card-title">Tabel Daftar Siswa</h5>
                    <!-- End Tooltips Examples -->
                    <!-- <button type="button" class="btn btn-primary btn-sm m-2" data-bs-toggle="modal" data-bs-target="#print">
                        <i class="bi bi-printer"></i>
                        Cetak Banyak
                    </button> -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No. Induk</th>
                                <th>Nama Siswa</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_siswa as $siswa) : ?>
                                <tr>
                                    <td><?= $siswa->siswa_nis ?></td>
                                    <td><?= $siswa->siswa_nama ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/nilaisiswa/' . $siswa->siswa_id) ?>" class="badge bg-dark">Lihat Nilai</a>
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
<!-- <div class="modal fade" id="print" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Cetak</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('guru/kd/store') ?>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div> -->
<?= $this->endSection(); ?>