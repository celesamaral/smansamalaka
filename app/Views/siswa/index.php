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
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#form">
                        <i class="bi bi-plus"></i>
                        Tambah Siswa
                    </button>
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
                                        <?= form_open('admin/siswa/hapus') ?>
                                        <a href="<?= base_url('admin/siswa/' . $siswa->siswa_id) ?>" class="badge bg-dark mr-2">detail</a>
                                        <a href="<?= base_url('admin/siswa/' . $siswa->siswa_id . '/edit') ?>" class="badge bg-secondary mr-2">edit</a>
                                        <input type="hidden" name="siswa_id" value="<?= $siswa->siswa_id ?>" class="d-none">
                                        <button type="submit" class="badge bg-danger border">hapus</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Form Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('admin/siswa/store') ?>

            <div class="modal-body">
                <div class="form-group mb-4">
                    <label for="siswa_nisn">NISN</label>
                    <input type="text" class="form-control <?= (isset(session('errors')['siswa_nisn'])) ? 'is-invalid' : '' ?>" id="siswa_nisn" name="siswa_nisn" value="<?= old('siswa_nisn') ?>">
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['siswa_nisn'])) : ?>
                            <?= session('errors')['siswa_nisn'] ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="siswa_nama">Nama Siswa</label>
                    <input type="text" class="form-control <?= (isset(session('errors')['siswa_nama'])) ? 'is-invalid' : '' ?>" id="siswa_nama" name="siswa_nama" value="<?= old('siswa_nama') ?>">
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['siswa_nama'])) : ?>
                            <?= session('errors')['siswa_nama'] ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="siswa_jk">Jenis Kelamin</label>
                    <select name="siswa_jk" id="" class="form-select">
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['siswa_jk'])) : ?>
                            <?= session('errors')['siswa_jk'] ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="siswa_tempat_lahir">Tempat Lahir</label>
                    <input type="text" class="form-control <?= (isset(session('errors')['siswa_tempat_lahir'])) ? 'is-invalid' : '' ?>" id="siswa_tempat_lahir" name="siswa_tempat_lahir" value="<?= old('siswa_tempat_lahir') ?>">
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['siswa_tempat_lahir'])) : ?>
                            <?= session('errors')['siswa_tempat_lahir'] ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="siswa_tgl_lahir">Tanggal Lahir</label>
                    <input type="date" class="form-control <?= (isset(session('errors')['siswa_tgl_lahir'])) ? 'is-invalid' : '' ?>" id="siswa_tgl_lahir" name="siswa_tgl_lahir" value="<?= old('siswa_tgl_lahir') ?>">
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['siswa_tgl_lahir'])) : ?>
                            <?= session('errors')['siswa_tgl_lahir'] ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="siswa_hp">Nomor HP(WA)</label>
                    <input type="text" class="form-control <?= (isset(session('errors')['siswa_hp'])) ? 'is-invalid' : '' ?>" id="siswa_hp" name="siswa_hp" value="<?= old('siswa_hp') ?>">
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['siswa_hp'])) : ?>
                            <?= session('errors')['siswa_hp'] ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="siswa_goldarah">Golongan darah</label>
                    <input type="text" class="form-control <?= (isset(session('errors')['siswa_goldarah'])) ? 'is-invalid' : '' ?>" id="siswa_goldarah" name="siswa_goldarah" value="<?= old('siswa_goldarah') ?>">
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['siswa_goldarah'])) : ?>
                            <?= session('errors')['siswa_goldarah'] ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="siswa_alamat">Alamat</label>
                    <input type="text" class="form-control <?= (isset(session('errors')['siswa_alamat'])) ? 'is-invalid' : '' ?>" id="siswa_alamat" name="siswa_alamat" value="<?= old('siswa_alamat') ?>">
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['siswa_alamat'])) : ?>
                            <?= session('errors')['siswa_alamat'] ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="siswa_email">Email</label>
                    <input type="email" class="form-control <?= (isset(session('errors')['siswa_email'])) ? 'is-invalid' : '' ?>" id="siswa_email" name="siswa_email" value="<?= old('siswa_email') ?>">
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['siswa_email'])) : ?>
                            <?= session('errors')['siswa_email'] ?>
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