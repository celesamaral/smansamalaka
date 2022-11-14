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
                    <h5 class="card-title">Mata Pelajaran : <?= $mapel->mapel_nama ?> <?= $mapel->mapel_kelas ?>(<?= $mapel->mapel_kelompok ?>)</h5>
                    <!-- End Tooltips Examples -->
                    <div class="d-flex justify-content-end mb-4">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#form">
                            <i class="bi bi-plus"></i>
                            Tambah Kompetensi Dasar
                        </button>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kompetensi Dasaar</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ?>
                            <?php foreach ($data_kd as $kd) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $kd->kd_nama ?></td>
                                    <td>
                                        <?= form_open('admin/kd/store') ?>
                                        <button type="button" class="badge bg-secondary border" data-bs-toggle="modal" data-bs-target="#form<?= $kd->kd_id ?>">
                                            <i class="bi bi-plus"></i>
                                            edit
                                        </button>
                                        <input type="hidden" name="kd_id" value="<?= $kd->kd_id ?>" class="d-none">
                                        <button type="submit" class="badge bg-danger border">hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Form Kompetensi Dasar</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <?= form_open('admin/kd/update') ?>
                                            <div class="modal-body">
                                                <input type="hidden" name="mapel_id" value="<?= $mapel->mapel_id ?>" class="d-non">
                                                <div class="form-group mb-4">
                                                    <label for="kd_nama">Nama Kompetensi Dasar</label>
                                                    <input type="text" class="form-control <?= (isset(session('errors')['kd_nama'])) ? 'is-invalid' : '' ?>" id="kd_nama" name="kd_nama" value="<?= old('kd_nama', $kd->kd_nama) ?>">
                                                    <div class="invalid-feedback">
                                                        <?php if (isset(session('errors')['kd_nama'])) : ?>
                                                            <?= session('errors')['kd_nama'] ?>
                                                        <?php endif; ?>
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
                <h5 class="modal-title" id="exampleModalLabel">Form Kompetensi Dasar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('admin/kd/store') ?>
            <div class="modal-body">
                <input type="hidden" name="mapel_id" value="<?= $mapel->mapel_id ?>" class="d-non">
                <div class="form-group mb-4">
                    <label for="kd_nama">Nama Kompetensi Dasar</label>
                    <input type="text" class="form-control <?= (isset(session('errors')['kd_nama'])) ? 'is-invalid' : '' ?>" id="kd_nama" name="kd_nama" value="<?= old('kd_nama') ?>">
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['kd_nama'])) : ?>
                            <?= session('errors')['kd_nama'] ?>
                        <?php endif; ?>
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