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
                    <h5 class="card-title">Tabel Daftar Jurusan</h5>
                    <!-- End Tooltips Examples -->
                    <div class="d-flex justify-content-end mb-4">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#form">
                            <i class="bi bi-plus"></i>
                            Tambah Jurusan
                        </button>

                        <!-- Modal -->

                    </div>
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>Jurusan</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_jurusan as $jurusan) : ?>
                                <tr>
                                    <td><?= $jurusan->jurusan_nama ?></td>
                                    <td>
                                        <?= form_open('admin/jurusan/hapus') ?>
                                        <a href="<?= base_url('admin/jurusan/' . $jurusan->jurusan_id . '/kelas') ?>" class="badge bg-dark">lihat kelas</a>
                                        <span type="button" class="badge bg-secondary mr-2" data-bs-toggle="modal" data-bs-target="#form<?= $jurusan->jurusan_id ?>">
                                            edit
                                        </span>

                                        <input type="hidden" name="jurusan_id" value="<?= $jurusan->jurusan_id ?>" class="d-none">
                                        <button type="submit" class="badge bg-danger border">hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="form<?= $jurusan->jurusan_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Form Edit Jurusan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <?= form_open('admin/jurusan/update') ?>
                                            <div class="modal-body">
                                                <div class="form-group mb-4">
                                                    <input type="hidden" name="jurusan_id" value="<?= $jurusan->jurusan_id ?>" class="d-none">
                                                    <label for="jurusan_nama">Nama Jurusan</label>
                                                    <input type="text" class="form-control <?= (isset(session('errors')['jurusan_nama'])) ? 'is-invalid' : '' ?>" id="jurusan_nama" name="jurusan_nama" value="<?= old('jurusan_nama', $jurusan->jurusan_nama) ?>">
                                                    <div class="invalid-feedback">
                                                        <?php if (isset(session('errors')['jurusan_nama'])) : ?>
                                                            <?= session('errors')['jurusan_nama'] ?>
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
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Jurusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('admin/jurusan/store') ?>
            <div class="modal-body">
                <div class="form-group mb-4">
                    <label for="jurusan_nama">Nama Jurusan</label>
                    <input type="text" class="form-control <?= (isset(session('errors')['jurusan_nama'])) ? 'is-invalid' : '' ?>" id="jurusan_nama" name="jurusan_nama" value="<?= old('jurusan_nama') ?>">
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['jurusan_nama'])) : ?>
                            <?= session('errors')['jurusan_nama'] ?>
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