<?= $this->extend('layout_admin'); ?>
<?= $this->section('title'); ?>
<?= $title ?>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<div class="pagetitle">
    <h1><?= $title ?></h1>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <?php if (session()->has('message')) : ?>
                <div class="alert alert-secondary">
                    <p><?= session('message') ?></p>
                </div>
            <?php endif; ?>
            <div class="row">
                <?php foreach ($data_kelas as $kelas) : ?>
                    <div class="col-lg-3 col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <h5 class="card-title"><?= $kelas->kelas_tingkat ?> <?= $kelas->jurusan_nama ?> <?= $kelas->kelas_abjad ?></h5>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <span class="text-secondary text-sm"><?= $kelas->jumlah_mutasi ?> dari <?= $kelas->jumlah_siswa ?> dimutasi</span>
                                </div>
                                <div class="d-flex justify-content-center mt-4">
                                    <a href="<?= base_url('admin/mutasi_kelas/' . $kelas->kelas_id) ?>" class="badge bg-primary">Mutasi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="d-flex justify-content-end">
                <?= form_open('admin/mutasi_kelas/store_all') ?>
                <button type="submit" class="btn btn-success" onclick="return confirm('Yakin Ingin Menyimpan? Data siswa yang belum dimutasi dianggap tahan kelas/tidak pindah kelas!');">
                    Simpan Mutasi
                </button>
                </form>
            </div>
        </div>

    </div>
</section>

<?= $this->endSection(); ?>