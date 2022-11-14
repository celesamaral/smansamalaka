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

                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kompetensi Dasar</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ?>
                            <?php foreach ($data_kd as $kd) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $kd->kd_nama ?></td>
                                    <td>
                                        <?= form_open('guru/penilaian') ?>
                                        <input type="hidden" name="kd_id" value="<?= $kd->kd_id ?>">
                                        <input type="hidden" name="kelas_id" value="<?= $kelas->kelas_id ?>" class="d-none">
                                        <input type="hidden" name="mapel_id" value="<?= $mapel->mapel_id ?>" class="d-none">
                                        <button type="submit" class="badge bg-secondary border">input nilai</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-4">
                        <a href="<?= current_url() ?>/rekapan" class="badge bg-success">Lihat Rekapan</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
<?= $this->endSection(); ?>