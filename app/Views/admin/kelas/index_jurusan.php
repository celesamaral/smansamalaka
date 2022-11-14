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
                    <h5 class="card-title">Daftar Kelas Jurusan <?= $jurusan->jurusan_nama ?></h5>
                    <div class="d-flex justify-content-end mb-4">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#form">
                            <i class="bi bi-plus"></i>
                            Tambah Kelas
                        </button>

                        <!-- Modal -->

                    </div>
                    <!-- End Tooltips Examples -->
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>Jurusan</th>
                                <th>Nama Kelas</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_kelas as $kelas) : ?>
                                <tr>
                                    <td><?= $kelas->jurusan_nama ?></td>
                                    <td><?= $kelas->kelas_tingkat . ' ' . $kelas->kelas_abjad ?></td>
                                    <td>
                                        <?= form_open('admin/kelas/hapus') ?>
                                        <span type="button" class="badge bg-secondary mr-2" data-bs-toggle="modal" data-bs-target="#form<?= $kelas->kelas_id ?>">
                                            edit
                                        </span>
                                        <button type="submit" class="badge bg-danger border">hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="form<?= $kelas->kelas_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Kelas</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <?= form_open('admin/kelas/update') ?>
                                            <div class="modal-body">
                                                <div class="form-group mb-4">
                                                    <input type="hidden" name="kelas_id" value="<?= $kelas->kelas_id ?>" class="d-none">
                                                    <label for="kelas_tingkat">Tingkat</label>
                                                    <input type="text" class="form-control <?= (isset(session('errors')['kelas_tingkat'])) ? 'is-invalid' : '' ?>" id="kelas_tingkat" name="kelas_tingkat" value="<?= old('kelas_tingkat', $kelas->kelas_tingkat) ?>">

                                                    <div class="invalid-feedback">
                                                        <?php if (isset(session('errors')['kelas_tingkat'])) : ?>
                                                            <?= session('errors')['kelas_tingkat'] ?>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label for="kelas_abjad">Angka</label>
                                                        <input type="text" class="form-control <?= (isset(session('errors')['kelas_abjad'])) ? 'is-invalid' : '' ?>" id="kelas_abjad" name="kelas_abjad" value="<?= old('kelas_abjad', $kelas->kelas_abjad) ?>">
                                                        <div class="invalid-feedback">
                                                            <?php if (isset(session('errors')['kelas_abjad'])) : ?>
                                                                <?= session('errors')['kelas_abjad'] ?>
                                                            <?php endif; ?>
                                                        </div>
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
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('admin/kelas/store') ?>
            <div class="modal-body">
                <div class="form-group mb-4">
                    <input type="hidden" name="jurusan_id" value="<?= $jurusan->jurusan_id ?>" class="d-none">
                    <label for="kelas_tingkat">Tingkat</label>
                    <input type="text" class="form-control <?= (isset(session('errors')['kelas_tingkat'])) ? 'is-invalid' : '' ?>" id="kelas_tingkat" name="kelas_tingkat" value="<?= old('kelas_tingkat') ?>">

                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['kelas_tingkat'])) : ?>
                            <?= session('errors')['kelas_tingkat'] ?>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mb-4">
                        <label for="kelas_abjad">Angka</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['kelas_abjad'])) ? 'is-invalid' : '' ?>" id="kelas_abjad" name="kelas_abjad" value="<?= old('kelas_abjad') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['kelas_abjad'])) : ?>
                                <?= session('errors')['kelas_abjad'] ?>
                            <?php endif; ?>
                        </div>
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