<?= $this->extend('layout_admin'); ?>
<?= $this->section('title'); ?>
<?= $title ?>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<div class="pagetitle">
    <h1><?= $title ?></h1>
</div><!-- End Page Title -->
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('admin/mutasi_kelas') ?>">
                << Kembali</a>
        </li>
    </ol>
</nav>
<section class="section">
    <?php if (session()->has('message')) : ?>
        <div class="alert alert-secondary">
            <p><?= session('message') ?></p>
        </div>
    <?php endif; ?>
    <?= form_open('admin/mutasi_kelas/sementara') ?>
    <div class="row">
        <div class="col-lg-5 col-md-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Siswa Kelas <?= $kelas_sekarang->kelas_tingkat ?> <?= $kelas_sekarang->jurusan_nama ?> <?= $kelas_sekarang->kelas_abjad ?></h5>
                    <!-- End Tooltips Examples -->
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <td></td>
                                <td>Nama Siswa</td>
                            </tr>

                        </thead>
                        <tbody>
                            <?php foreach ($siswa_sekarang as $siswa) : ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="siswa[]" id="siswa_id" class="form-check-input" value="<?= $siswa->siswa_id ?>">
                                    </td>
                                    <td><?= $siswa->siswa_nama ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="col-lg-3 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-4">
                        <h5 class="card-title">Pilih Kelas</h5>
                        <select class="form-select <?= (isset(session('errors')['kelas'])) ? 'is-invalid' : '' ?>" id="kelas" name="kelas">
                            <option value="">Pilih Kelas</option>
                            <?php foreach ($kelas_atas as $kelas) : ?>
                                <option value="<?= $kelas->kelas_id ?>"><?= $kelas->kelas_tingkat ?> <?= $kelas->jurusan_nama ?> <?= $kelas->kelas_abjad ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['kelas'])) : ?>
                                <?= session('errors')['kelas'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    <div class="row">
        <div class="col-lg-5 col-md-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        Kelas Sementara Siswa
                    </h5>
                    <table class="table" id="myTable">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Kelas Sementara</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($siswa_mutasi as $siswa) : ?>
                                <tr>
                                    <td><?= $siswa->siswa_nama ?></td>
                                    <td><?= $siswa->kelas_tingkat ?> <?= $siswa->jurusan_nama ?> <?= $kelas->kelas_abjad ?></td>
                                    <td>
                                        <?= form_open('admin/mutasi_kelas/cancel') ?>
                                        <input type="hidden" name="siswa_id" value="<?= $siswa->siswa_id ?>">
                                        <button type="submit" class="border badge bg-danger">Batalkan</button>
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