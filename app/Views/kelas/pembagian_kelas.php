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
                    <h5 class="card-title">Daftar Siswa Baru</h5>
                    <!-- End Tooltips Examples -->
                    <?= form_open('admin/pembagian_kelas/store') ?>

                    <div class="form-group mb-4">
                        <label for="kelas_id">Kelas</label>
                        <select class="form-select <?= (isset(session('errors')['kelas_id'])) ? 'is-invalid' : '' ?>" id="kelas_id" name="kelas_id">
                            <option value="">Pilih Kelas</option>
                            <?php foreach ($data_kelas as $kelas) :  ?>
                                <option value="<?= $kelas->kelas_id ?>"><?= $kelas->kelas_tingkat ?> <?= $kelas->kelas_abjad ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['kelas_id'])) : ?>
                                <?= session('errors')['kelas_id'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <table class="table table-stripped" id="myTable">
                        <thead>
                            <tr>
                                <th>Pilih</th>
                                <th>Nama Siswa</th>
                                <th>Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($siswa_baru as $siswa) : ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="siswa_id[]" id="siswa_id" class="form-check-input" value="<?= $siswa->siswa_id ?>">
                                    </td>
                                    <td><?= $siswa->siswa_nama ?></td>
                                    <td><?= $siswa->siswa_jk ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>

        </div>

    </div>
</section>
<?= $this->endSection(); ?>