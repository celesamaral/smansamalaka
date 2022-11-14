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

<section class="section dashboard">
    <div class="row">
        <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card">

                <div class="card-body">
                    <h5 class="card-title">Jumlah <span>| Siswa Aktif</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6><?= $siswa_aktif ?></h6>
                            <a href="<?= base_url('admin/siswa/aktif') ?>" class="text-primary small pt-1 fw-bold">Lihat Siswa >></a>

                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card">

                <div class="card-body">
                    <h5 class="card-title">Jumlah <span>| Siswa Laki-Laki</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6><?= $siswa_l ?></h6>
                            <a href="<?= base_url('admin/siswa/aktif') ?>" class="text-primary small pt-1 fw-bold">Lihat Siswa >></a>

                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card">

                <div class="card-body">
                    <h5 class="card-title">Jumlah <span>| Siswa Perempuan</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6><?= $siswa_p ?></h6>
                            <a href="<?= base_url('admin/siswa/aktif') ?>" class="text-primary small pt-1 fw-bold">Lihat Siswa >></a>

                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card">

                <div class="card-body">
                    <h5 class="card-title">Jumlah <span>| Guru</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6><?= $guru ?></h6>
                            <a href="<?= base_url('admin/guru') ?>" class="text-primary small pt-1 fw-bold">Lihat Guru >></a>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
<?= $this->endSection(); ?>