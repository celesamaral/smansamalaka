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
            <?= form_open('guru/penilaian/store') ?>
            <input type="hidden" name="kelas_id" id="kelas_id" value="<?= $kelas->kelas_id ?>">
            <input type="hidden" name="kd_id" id="kd_id" value="<?= $kd->kd_id ?>">
            <?php if ($kd->kd_jenis != 'uas' && $kd->kd_jenis != 'uts') : ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Jenis Penilaian</h5>
                        <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <div class="form-group mb-4">
                            <label for="nilaisiswa_jenis">Jenis Penilaian</label>
                            <select onchange="doRequest()" type="text" class="form-select <?= (isset(session('errors')['nilaisiswa_jenis'])) ? 'is-invalid' : '' ?>" id="nilaisiswa_jenis" name="nilaisiswa_jenis" ?>">
                                <option value="">- Pilih Jenis Penilaian -</option>
                                <option value="tugas 1">Tugas 1</option>
                                <option value="tugas 2">Tugas 2</option>
                                <option value="ulangan 1">Ulangan 1</option>
                                <option value="ulangan 2">Ulangan 2</option>
                            </select>
                            <div class="invalid-feedback">
                                <?php if (isset(session('errors')['nilaisiswa_jenis'])) : ?>
                                    <?= session('errors')['nilaisiswa_jenis'] ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"> <?= $kd->kd_nama ?></h5>
                    <!-- End Tooltips Examples -->

                    <div id="tableform">
                        <?php if ($kd->kd_jenis == 'uas' || $kd->kd_jenis == 'uts') : ?>
                            <input type="hidden" name="nilaisiswa_jenis" value="<?= $kd->kd_jenis ?>">
                            <table class="table table-stripped" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Nama Siswa</th>
                                        <th style="width: 20%;">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($nilaisiswa as $nilai) : ?>
                                        <tr>
                                            <td><?= $nilai->siswa_nama ?></td>
                                            <td>
                                                <div class="form-group mb-4">
                                                    <input type="hidden" name="nilaisiswa_id[]" value="<?= $nilai->nilaisiswa_id ?>">
                                                    <input type="hidden" name="siswa_id[]" value="<?= $nilai->siswa_id ?>">
                                                    <input type="number" step=".1" class="form-control <?= (isset(session('errors')['nilaisiswa'])) ? 'is-invalid' : '' ?>" id="nilaisiswa" name="nilaisiswa[]" value="<?= old('nilaisiswa', $nilai->nilaisiswa_nilai) ?>">
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            </form>

        </div>

    </div>
</section>
<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>
<script>
    async function doRequest() {
        $('#tableform').empty();
        let url = '<?= base_url('guru/penilaian/get_nilai') ?>';
        let data = {
            'kelas_id': $('#kelas_id').val(),
            'kd_id': $('#kd_id').val(),
            'nilaisiswa_jenis': $('#nilaisiswa_jenis').val(),
        };

        let res = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        });

        if (res.ok) {

            // let text = await res.text();
            // return text;

            let ret = await res.json();
            $('#tableform').append(ret.form);

        } else {
            return `HTTP error: ${res.status}`;
        }
    }
</script>
<?= $this->endSection(); ?>