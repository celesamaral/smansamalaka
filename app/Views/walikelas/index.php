<?= $this->extend('layout_' . session('user')->user_type); ?>
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
                    <h5 class="card-title">Daftar Kelas</h5>
                    <div class="d-flex justify-content-end mb-4">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#form">
                            <i class="bi bi-plus"></i>
                            Tambah Wali Kelas
                        </button>

                        <!-- Modal -->

                    </div>
                    <!-- End Tooltips Examples -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Kelas</th>
                                <th>Wali Kelas</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($walikelas as $wali) : ?>
                                <tr>
                                    <td><?= $wali->kelas_tingkat ?> <?= $wali->jurusan_nama ?> <?= $wali->kelas_abjad ?></td>
                                    <td><?= $wali->guru_nama ?></td>
                                    <td>
                                        <?= form_open('admin/walikelas/delete') ?>
                                        <input type="hidden" name="walikelas_id" value="<?= $wali->walikelas_id ?>">
                                        <button type="submit" class="border badge bg-danger" onclick="return confirm('Anda Yakin?')">Hapus</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Form Wali Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('admin/walikelas/store') ?>
            <div class="modal-body">

                <label for="kelas_id">kelas</label>
                <select type="text" class="form-select <?= (isset(session('errors')['kelas_id'])) ? 'is-invalid' : '' ?>" id="kelas_id" name="kelas_id">
                    <option value="">--Pilih kelas--</option>
                    <?php foreach ($data_kelas as $kelas) : ?>
                        <option value="<?= $kelas->kelas_id ?>" <?= ($kelas->kelas_id == old('kelas_id')) ? 'selected' : '' ?>><?= $kelas->kelas_tingkat ?> <?= $kelas->jurusan_nama ?> <?= $kelas->kelas_abjad ?></option>
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback">
                    <?php if (isset(session('errors')['kelas_id'])) : ?>
                        <?= session('errors')['kelas_id'] ?>
                    <?php endif; ?>
                </div>

                <div class="form-group mb-4">
                    <label for="guru_id">Guru</label>
                    <select type="text" class="form-select <?= (isset(session('errors')['guru_id'])) ? 'is-invalid' : '' ?>" id="guru_id" name="guru_id">
                        <option value="">--Pilih Guru--</option>
                        <?php foreach ($data_guru as $guru) : ?>
                            <option value="<?= $guru->guru_id ?>" <?= ($guru->guru_id == old('guru_id')) ? 'selected' : '' ?>><?= $guru->guru_nama ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['guru_id'])) : ?>
                            <?= session('errors')['guru_id'] ?>
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