<?= $this->extend('layout_guru'); ?>
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
                    <h5 class="card-title">Rekapan Nilai Siswa Kelas <?= $kelas->kelas_tingkat ?> <?= $kelas->jurusan_nama ?> <?= $kelas->kelas_abjad ?></h5>
                    <!-- End Tooltips Examples -->
                    <div class="d-flex justify-content-end">
                        <?= form_open('guru/hitung_nilai') ?>
                        <input type="hidden" name="kelas_id" value="<?= $kelas->kelas_id ?>">
                        <input type="hidden" name="mapel_id" value="<?= $mapel->mapel_id ?>">
                        <button type="submit" class="btn btn-success m-1">Hitung Nilai</button>
                        </form>
                        <a href="<?= base_url('guru/penilaian/' . $kelas->kelas_id . '/' . $mapel->mapel_id . '/cetak') ?>" class="btn btn-warning ml-2 mr-2 m-1"><i class="bi bi-printer"></i>
                            Cetak
                        </a>
                    </div>
                    <?php $no = 1; ?>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>

                                <?php foreach ($data_kd as $kd) { ?>
                                    <th>KD <?= $no++; ?></th>
                                <?php } ?>
                                <th>UTS</th>
                                <th>UAS</th>
                                <th>Nilai Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_siswa as $nilai) { ?>

                                <tr>
                                    <?php
                                    $kd_count = 0;
                                    $kd_total = 0;
                                    ?>
                                    <td><?= $nilai->siswa_nama ?></td>
                                    <?php foreach ($nilai->nilai as $kd) { ?>
                                        <?php
                                        $kd_count++;
                                        $kd_nilai =  ($kd->tugas1 + $kd->tugas2 + $kd->ulangan1 + $kd->ulangan2) / 4;
                                        $kd_total += $kd_nilai; ?>
                                        <td><?= $kd_nilai ?></td>
                                    <?php } ?>
                                    <td><?= $nilai->uts ?></td>
                                    <td><?= $nilai->uas ?></td>
                                    <td><?= $nilai->akhir ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</section>
<?= $this->endSection(); ?>