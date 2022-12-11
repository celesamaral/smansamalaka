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
                    <h5 class="card-title">Nilai Mata Pelajaran Tahun Ajaran <?= $tahunajaran->tahunajaran_tahun ?> Semester <?= $tahunajaran->tahunajaran_semester ?></h5>

                    <?= form_open(session('user')->user_type . '/nilai/cetak', ['target' => '_blank']) ?>
                    <input type="hidden" name="siswa_id" value="<?= $siswa->siswa_id ?>">
                    <button type="submit" class="btn btn-success">Cetak</button>
                    </form>
                    <!-- End Tooltips Examples -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th>KD 1</th>
                                <th>KD 2</th>
                                <th>KD 3</th>
                                <th>KD 4</th>
                                <th>UTS</th>
                                <th>UAS</th>
                                <th>Nilai Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_mapel as $mapel) : ?>
                                <tr>
                                    <td><?= $mapel->mapel_nama ?></td>
                                    <?php foreach ($mapel->nilai as $nilai) : ?>
                                        <?php $nilai_kd = 0;
                                        $nilai_kd += ($nilai->tugas1 + $nilai->tugas2 + $nilai->ulangan1 + $nilai->ulangan2) / 4;
                                        ?>
                                        <td><?= $nilai_kd ?></td>
                                    <?php endforeach; ?>
                                    <td><?= $mapel->uts ?></td>
                                    <td><?= $mapel->uas ?></td>
                                    <td><?= $mapel->akhir ?></td>

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