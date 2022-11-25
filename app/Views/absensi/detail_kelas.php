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
                    <h5 class="card-title">Form Absensi</h5>
                    <!-- End Tooltips Examples -->
                    <?= form_open('guru/absensi/absen') ?>
                    <input type="hidden" name="absensi_id" value="<?= $absensi->absensi_id ?>">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detail_absensi as $absen) : ?>
                                <tr>
                                    <td>
                                        <input type="hidden" name="siswa_id[]" value="<?= $absen->siswaId ?>">
                                        <?= $absen->siswa_nama ?>

                                    </td>
                                    <td>
                                        <input type="hidden" name="detail_absensi[<?= $absen->siswaId ?>]" value="<?= $absen->detailabsensi_id ?>">
                                        <select name="kehadiran[<?= $absen->siswaId ?>]" id="kehadiran" class="form-select">
                                            <option value="">Pilih</option>
                                            <option value="H" <?= set_select('kehadiran[' . $absen->siswaId . ']', 'H', ($absen->detailabsensi_kehadiran == 'H')) ?>>Hadir</option>
                                            <option value="S" <?= set_select('kehadiran[' . $absen->siswaId . ']', 'S', ($absen->detailabsensi_kehadiran == 'S')) ?>>Sakit</option>
                                            <option value="I" <?= set_select('kehadiran[' . $absen->siswaId . ']', 'I', ($absen->detailabsensi_kehadiran == 'I')) ?>>Ijin</option>
                                            <option value="A" <?= set_select('kehadiran[' . $absen->siswaId . ']', 'A', ($absen->detailabsensi_kehadiran == 'A')) ?>>Tanpa Keterangan</option>
                                        </select>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Simpan Absensi</button>
                    </form>
                </div>
            </div>

        </div>

    </div>
</section>
<?= $this->endSection(); ?>