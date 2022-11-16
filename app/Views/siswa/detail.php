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
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detail Siswa</h5>
                    <!-- End Tooltips Examples -->
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="table-responsive-sm">
                                <table class="table">
                                    <tr>
                                        <th>Nama Siswa</th>
                                        <td><?= $siswa->siswa_nama ?></td>
                                    </tr>
                                    <tr>
                                        <th>NISN</th>
                                        <td><?= $siswa->siswa_nisn ?></td>
                                    </tr>
                                    <tr>
                                        <th>NIS</th>
                                        <td><?= $siswa->siswa_nis ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td><?= $siswa->siswa_jk ?></td>
                                    </tr>
                                    <tr>
                                        <th>TTL</th>
                                        <td><?= $siswa->siswa_tempat_lahir ?>, <?= $siswa->siswa_tgl_lahir ?></td>
                                    </tr>
                                    <tr>
                                        <th>Golongan Darah</th>
                                        <td><?= $siswa->siswa_goldarah ?></td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td><?= $siswa->siswa_alamat ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nomor HP</th>
                                        <td><?= $siswa->siswa_hp ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?= $siswa->siswa_email ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <img src="<?= base_url('assets/img/profile/' . $siswa->user_profile) ?>" alt="" class="img-thumbnail">
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
<?= $this->endSection(); ?>