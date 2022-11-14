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
                    <h5 class="card-title">Daftar Tahun Ajaran</h5>

                    <div class="d-flex justify-content-end mb-4">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#form">
                            <i class="bi bi-plus"></i>
                            Tambah Tahun Ajaran
                        </button>
                    </div>

                    <!-- End Tooltips Examples -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Tahun Ajaran</th>
                                <th>Semester</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_ta as $ta) : ?>
                                <tr>
                                    <td><?= $ta->tahunajaran_tahun ?></td>
                                    <td><?= $ta->tahunajaran_semester ?></td>
                                    <td><?= $ta->tahunajaran_status ?></td>
                                    <td>
                                        <?= form_open('admin/tahunajaran/ubah_status') ?>
                                        <?php if ($ta->tahunajaran_status == 'nonaktif') : ?>
                                            <button class="badge bg-secondary border" type="button" data-bs-toggle="modal" data-bs-target="#form<?= $ta->tahunajaran_id ?>">edit</button>
                                        <?php endif; ?>
                                        <input type="hidden" name="tahunajaran_id" value="<?= $ta->tahunajaran_id ?>" class="d-none">
                                        <?php if ($ta->tahunajaran_status == 'nonaktif') : ?>
                                            <button type="submit" class="badge bg-success border" value="aktifkan" name="status">aktifkan</button>
                                        <?php elseif ($ta->tahunajaran_status == 'aktif') : ?>
                                            <button type="submit" class="badge bg-warning mr-2 border" value="nonaktifkan" name="status">nonaktifkan</button>
                                            <button type="submit" class="badge bg-danger border" value="selesai" name="status">selesai</button>
                                        <?php endif; ?>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="form<?= $ta->tahunajaran_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Form Tahun Ajaran</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <?= form_open('admin/tahunajaran/update') ?>
                                            <div class="modal-body">
                                                <input type="hidden" name="tahunajaran_id" value="<?= $ta->tahunajaran_id ?>" class="d-none">
                                                <div class="form-group mb-4">
                                                    <label for="tahunajaran_tahun">Tahun Ajaran</label>
                                                    <input type="text" class="form-control <?= (isset(session('errors')['tahunajaran_tahun'])) ? 'is-invalid' : '' ?>" id="tahunajaran_tahun" name="tahunajaran_tahun" value="<?= old('tahunajaran_tahun', $ta->tahunajaran_tahun) ?>">
                                                    <div class="invalid-feedback">
                                                        <?php if (isset(session('errors')['tahunajaran_tahun'])) : ?>
                                                            <?= session('errors')['tahunajaran_tahun'] ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-4">
                                                    <label for="tahunajaran_semester">Semester (1/2)</label>
                                                    <input type="text" class="form-control <?= (isset(session('errors')['tahunajaran_semester'])) ? 'is-invalid' : '' ?>" id="tahunajaran_semester" name="tahunajaran_semester" value="<?= old('tahunajaran_semester', $ta->tahunajaran_semester) ?>">
                                                    <div class="invalid-feedback">
                                                        <?php if (isset(session('errors')['tahunajaran_semester'])) : ?>
                                                            <?= session('errors')['tahunajaran_semester'] ?>
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
                <h5 class="modal-title" id="exampleModalLabel">Form Tahun Ajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('admin/tahunajaran/store') ?>
            <div class="modal-body">
                <div class="form-group mb-4">
                    <label for="tahunajaran_tahun">Tahun Ajaran</label>
                    <input type="text" class="form-control <?= (isset(session('errors')['tahunajaran_tahun'])) ? 'is-invalid' : '' ?>" id="tahunajaran_tahun" name="tahunajaran_tahun" value="<?= old('tahunajaran_tahun') ?>">
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['tahunajaran_tahun'])) : ?>
                            <?= session('errors')['tahunajaran_tahun'] ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="tahunajaran_semester">Semester (1/2)</label>
                    <input type="text" class="form-control <?= (isset(session('errors')['tahunajaran_semester'])) ? 'is-invalid' : '' ?>" id="tahunajaran_semester" name="tahunajaran_semester" value="<?= old('tahunajaran_semester') ?>">
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['tahunajaran_semester'])) : ?>
                            <?= session('errors')['tahunajaran_semester'] ?>
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