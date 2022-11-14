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
            <?php if (session()->has('message')) : ?>
                <div class="alert alert-secondary">
                    <p><?= session('message') ?></p>
                </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tabel Jadwal Pelajaran</h5>
                    <!-- End Tooltips Examples -->

                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#form">
                        <i class="bi bi-plus"></i>
                        Buat Jadwal
                    </button>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Hari</th>
                                <th>Jenis</th>
                                <th>Waktu</th>
                                <th>Mata Pelajaran</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_jadwal as $jadwal) : ?>
                                <tr>
                                    <td><?= $jadwal->jadwal_hari ?></td>
                                    <td><?= $jadwal->jadwal_jenis ?></td>
                                    <td><?= $jadwal->jadwal_mulai ?> - <?= $jadwal->jadwal_selesai ?></td>
                                    <td><?= $jadwal->mapel_nama ?></td>
                                    <td>
                                        <?= form_open('admin/jadwal/store') ?>
                                        <!-- tombol edit -->
                                        <button type="button" class="badge bg-secondary border" data-bs-toggle="modal" data-bs-target="#form<?= $jadwal->jadwal_id ?>">
                                            edit
                                        </button>
                                        <!-- Tombol Hapus -->
                                        <input type="hidden" name="jadwal_id" value="<?= $jadwal->jadwal_id ?>" class="d-none">
                                        <button class="badge bg-danger border" type="submit">hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>

    </div>
</section>
<div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('admin/jadwal/store') ?>
            <div class="modal-body">
                <input type="hidden" name="kelas_id" value="<?= $kelas->kelas_id ?>">
                <div class="form-group mb-4">
                    <label for="jadwal_hari">Hari</label>
                    <select class="form-select <?= (isset(session('errors')['jadwal_hari'])) ? 'is-invalid' : '' ?>" id="jadwal_hari" name="jadwal_hari">
                        <option value="">Pilih Hari</option>
                        <?php foreach ($hari as $h) : ?>
                            <option value="<?= $h->hari_nama ?>" <?= set_select('jadwal_hari', $h->hari_nama, (old('jadwal_hari') == $h->hari_nama)) ?>><?= $h->hari_nama ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['jadwal_hari'])) : ?>
                            <?= session('errors')['jadwal_hari'] ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="jadwal_jenis">Jenis</label>
                    <select class="form-select <?= (isset(session('errors')['jadwal_jenis'])) ? 'is-invalid' : '' ?>" id="jadwal_jenis" name="jadwal_jenis">
                        <option value=""></option>
                        <option value="Pelajaran" <?= set_select('jadwal_jenis', 'Pelajaran', (old('jadwal_jenis') == 'Pelajaran')) ?>>Pelajaran</option>
                        <option value="Istirahat" <?= set_select('jadwal_jenis', 'Istirahat', (old('jadwal_jenis') == 'Istirahat')) ?>>Istirahat</option>
                    </select>
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['jadwal_jenis'])) : ?>
                            <?= session('errors')['jadwal_jenis'] ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div id="pelajaran">
                    <div class="form-group mb-4">
                        <label for="mapel_id">Mata Pelajaran</label>
                        <select class="form-select <?= (isset(session('errors')['mapel_id'])) ? 'is-invalid' : '' ?>" id="mapel_id" name="mapel_id" required>
                            <option value="">Pilih Mata Pelajaran</option>
                            <?php foreach ($data_mapel as $mapel) : ?>
                                <option value="<?= $mapel->mapel_id ?>" <?= set_select('mapel_id', $mapel->mapel_id, (old('mapel_id') == $mapel->mapel_id)) ?>><?= $mapel->mapel_nama ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['mapel_id'])) : ?>
                                <?= session('errors')['mapel_id'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="jadwal_mulai">Waktu Mulai</label>
                    <input type="time" class="form-control <?= (isset(session('errors')['jadwal_mulai'])) ? 'is-invalid' : '' ?>" id="jadwal_mulai" name="jadwal_mulai" value="<?= old('jadwal_mulai') ?>">
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['jadwal_mulai'])) : ?>
                            <?= session('errors')['jadwal_mulai'] ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="jadwal_selesai">Waktu Selesai</label>
                    <input type="time" class="form-control <?= (isset(session('errors')['jadwal_selesai'])) ? 'is-invalid' : '' ?>" id="jadwal_selesai" name="jadwal_selesai" value="<?= old('jadwal_selesai') ?>">
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['jadwal_selesai'])) : ?>
                            <?= session('errors')['jadwal_selesai'] ?>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('scripts') ?>

<script type="text/javascript">
    var pelajaran;
    // window.onload = function() {
    //     alert('Page is loaded');
    // };
    $(document).ready(function() {
        if ($('#jadwal_jenis').val() != 'Pelajaran') {
            pelajaran = $('#pelajaran').children();
            $('#pelajaran').empty();
        }
    });
    $('#jadwal_jenis').on('change', function() {
        if (this.value == 'Pelajaran') {
            // alert(pelajaran);
            $('#pelajaran').append(pelajaran);
        } else {
            $('#pelajaran').empty();
        }
    });
</script>
<?= $this->endSection(); ?>