<?= $this->extend('layout_guru'); ?>
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
                                <th>Kompetensi Dasar</th>
                                <th>Jenis</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ?>
                            <?php foreach ($data_kd as $kd) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $kd->kd_nama ?></td>
                                    <td><?= strtoupper($kd->kd_jenis) ?></td>
                                    <td>
                                        <?= form_open('guru/kd/hapus') ?>
                                        <button type="button" class="badge bg-secondary border" data-bs-toggle="modal" data-bs-target="#form<?= $kd->kd_id ?>">
                                            edit
                                        </button>
                                        <input type="hidden" name="kd_id" value="<?= $kd->kd_id ?>" class="d-none">
                                        <button type="submit" class="badge bg-danger border">hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="form<?= $kd->kd_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Form Kompetensi Dasar</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <?= form_open('guru/kd/update') ?>
                                            <div class="modal-body">
                                                <input type="hidden" name="kd_id" value="<?= $kd->kd_id ?>" class="d-non">
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
            <?= form_open('guru/kd/store') ?>
            <div class="modal-body">
                <input type="hidden" name="mapel_id" value="<?= $mapel->mapel_id ?>" class="d-none">
                <div class="form-group mb-4">
                    <label for="kd_nama">Nama Kompetensi Dasar</label>
                    <input type="text" class="form-control <?= (isset(session('errors')['kd_nama'])) ? 'is-invalid' : '' ?>" id="kd_nama" name="kd_nama" value="<?= old('kd_nama') ?>">
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['kd_nama'])) : ?>
                            <?= session('errors')['kd_nama'] ?>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mb-4">
                        <label for="kd_jenis">Jenis</label>
                        <select type="text" class="form-select <?= (isset(session('errors')['kd_jenis'])) ? 'is-invalid' : '' ?>" id="kd_jenis" name="kd_jenis">
                            <option value="">Pilih Jenis Kompetensi Dasar</option>
                            <option value="kd" <?= set_select('kd_jenis', 'kd', (old('kd_jenis') == 'kd')) ?>>Kompetensi Dasar</option>
                            <option value="uts" <?= set_select('kd_jenis', 'uts', (old('kd_jenis') == 'uts')) ?>>UTS</option>
                            <option value="uas" <?= set_select('kd_jenis', 'uas', (old('kd_jenis') == 'uas')) ?>>UAS</option>
                        </select>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['kd_jenis'])) : ?>
                                <?= session('errors')['kd_jenis'] ?>
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
</div>
<?= $this->endSection(); ?>