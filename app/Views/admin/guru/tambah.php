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

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Tambah Guru</h5>
                    <!-- End Tooltips Examples -->
                    <?= form_open('admin/guru/' . $action) ?>
                    <input type="hidden" value="<?= $guru->guru_id ?>" name="guru_id">
                    <div class="form-group mb-4">
                        <label for="guru_nip">NIP</label>
                        <input type="text" name="guru_nip" id="" class="form-control <?= (isset(session('errors')['guru_nip'])) ? 'is-invalid' : '' ?>" value="<?= old('guru_nip', $guru->guru_nip) ?>">

                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['guru_nip'])) : ?>
                                <?= session('errors')['guru_nip'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="guru_nama">Nama Lengkap</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['guru_nama'])) ? 'is-invalid' : '' ?>" id="guru_nama" name="guru_nama" value="<?= old('guru_nama', $guru->guru_nama) ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['guru_nama'])) : ?>
                                <?= session('errors')['guru_nama'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="guru_jk">Jenis Kelamin</label>
                        <select name="guru_jk" id="" class="form-select">
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['guru_jk'])) : ?>
                                <?= session('errors')['guru_jk'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="guru_tempat_lahir">Tempat Lahir</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['guru_tempat_lahir'])) ? 'is-invalid' : '' ?>" id="guru_tempat_lahir" name="guru_tempat_lahir" value="<?= old('guru_tempat_lahir', $guru->guru_tempat_lahir) ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['guru_tempat_lahir'])) : ?>
                                <?= session('errors')['guru_tempat_lahir'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="guru_tgl_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control <?= (isset(session('errors')['guru_tgl_lahir'])) ? 'is-invalid' : '' ?>" id="guru_tgl_lahir" name="guru_tgl_lahir" value="<?= old('guru_tgl_lahir', $guru->guru_tgl_lahir) ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['guru_tgl_lahir'])) : ?>
                                <?= session('errors')['guru_tgl_lahir'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="guru_hp">HP</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['guru_hp'])) ? 'is-invalid' : '' ?>" id="guru_hp" name="guru_hp" value="<?= old('guru_hp', $guru->guru_hp) ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['guru_hp'])) : ?>
                                <?= session('errors')['guru_hp'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <input type="submit" value="Simpan" class="btn btn-secondary">
                    </form>
                </div>
            </div>

        </div>

    </div>
</section>
<?= $this->endSection(); ?>