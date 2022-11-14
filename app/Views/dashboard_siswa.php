<?= $this->extend('layout_siswa'); ?>
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

<section class="section dashboard">
    <div class="row">
        <div class="col-md-4 col-sm-12">

            <div class="card info-card customers-card">

                <div class="card-body">
                    <h5 class="card-title">Status <span>| Status Siswa</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div class="ps-3">
                            <h6><?= strtoupper(siswa()->siswa_status) ?></h6>

                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="col-md-4 col-sm-12">

            <div class="card info-card customers-card">

                <div class="card-body">
                    <h5 class="card-title">Kelas <span></span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-diagram-2"></i>
                        </div>
                        <div class="ps-3">
                            <h6><?= $kelas->kelas_tingkat ?> <?= $kelas->kelas_abjad ?></h6>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="col-md-4 col-sm-12">

            <div class="card info-card customers-card">

                <div class="card-body">
                    <h5 class="card-title">Jurusan <span></span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-diagram-2"></i>
                        </div>
                        <div class="ps-3">
                            <h6><?= strtoupper($kelas->jurusan_nama) ?></h6>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="col-md-4 col-sm-12">

            <div class="card info-card customers-card">

                <div class="card-body">
                    <h5 class="card-title">Tahun <span>| Ajaran</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-card"></i>
                        </div>
                        <div class="ps-3">
                            <?php if (!empty($tahunajaran)) : ?>
                                <h6><?= $tahunajaran->tahunajaran_tahun ?> Semester <?= $tahunajaran->tahunajaran_semester ?></h6>
                            <?php else : ?>
                                <h6>Belum Ada Yang Aktif</h6>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="pagetitle">
        <h1>Pengumuman</h1>
        <!-- <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Components</li>
            <li class="breadcrumb-item active">Tooltips</li>
        </ol>
    </nav> -->
    </div>
    <div class="row">
        <?php foreach ($data_pengumuman as $pengumuman) : ?>
            <div class="col-md-6">
                <div class="card mb-2">
                    <div class="card-body">

                        <h5 class="card-title"><?= $pengumuman->pengumuman_judul ?>

                        </h5>
                        <?php if (session('user')->user_type == 'admin') : ?>
                            <!-- <div class="d-flex justify-content-end mt-4"> -->
                            <a href="<?= base_url('admin/pengumuman/edit/' . $pengumuman->pengumuman_id) ?>" class="badge bg-secondary text-sm">edit pengumuman</a>
                            <!-- </div> -->
                        <?php endif; ?><br>
                        <span class="text-weight-bold text-secondary mb-2">Tanggal : <?= $pengumuman->pengumuman_tgl ?></span>

                        <p><?= $pengumuman->pengumuman_isi ?></p>

                        <?php if (session('user')->user_type == 'admin') : ?>
                            <?php if ($pengumuman->pengumuman_status == 'tampil') : ?>
                                <?= form_open('admin/pengumuman/tarik') ?>
                                <input type="hidden" name="pengumuman_id" value="<?= $pengumuman->pengumuman_id ?>">
                                <button type="submit" class="badge border bg-warning">tarik Pengumuman</button>
                                </form>
                            <?php endif ?>
                            <?php if ($pengumuman->pengumuman_status == 'no tampil') : ?>
                                <?= form_open('admin/pengumuman/tampilkan') ?>
                                <input type="hidden" name="pengumuman_id" value="<?= $pengumuman->pengumuman_id ?>">
                                <button type="submit" class="badge border bg-success">tampilkan pengumuman</button>
                                </form>
                            <?php endif ?>
                            <?= form_open('admin/pengumuman/delete') ?>
                            <input type="hidden" name="pengumuman_id" value="<?= $pengumuman->pengumuman_id ?>">
                            <button type="submit" class="badge bg-danger border">Hapus Pengumuman</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?= $this->endSection(); ?>