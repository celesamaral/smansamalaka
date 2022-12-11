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
                    <h5 class="card-title">Absensi Harian</h5>
                    <!-- End Tooltips Examples -->
                    <div class="d-flex justify-content-end mb-4">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#form">
                            <i class="bi bi-plus"></i>
                            Buat Absensi
                        </button>
                    </div>

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($absensi as $absen) : ?>
                                <tr>
                                    <td><?= $absen->absensi_tgl ?></td>
                                    <td>
                                        <?= form_open('admin/absensi/hapus') ?>
                                        <a href="<?= base_url('admin/absensi/' . $absen->absensi_id) ?>" class="badge bg-info">Lihat Absensi</a>
                                        <input type="hidden" name="absensi_id" value="<?= $absen->absensi_id ?>">
                                        <button class="badge bg-danger border" onclick="return confirm('Apakah anda yakin menghapus data ini')">Hapus</button>
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
<div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Absensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('admin/absensi/store') ?>
            <div class="modal-body">
                <div class="form-group mb-4">
                    <label for="absensi_tgl">Tanggal</label>
                    <input type="date" class="form-control <?= (isset(session('errors')['absensi_tgl'])) ? 'is-invalid' : '' ?>" id="absensi_tgl" name="absensi_tgl" value="<?= old('absensi_tgl') ?>">
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['absensi_tgl'])) : ?>
                            <?= session('errors')['absensi_tgl'] ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>