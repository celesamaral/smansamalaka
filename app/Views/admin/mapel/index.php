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
                    <h5 class="card-title">Daftar Mata Pelajaran</h5>
                    <!-- End Tooltips Examples -->
                    <div class="d-flex justify-content-end mb-4">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#form">
                            <i class="bi bi-plus"></i>
                            Tambah Mata Pelajaran
                        </button>
                    </div>

                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>Kelompok</th>
                                <th>Kelas</th>
                                <th>Mata Pelajaran</th>
                                <th>Guru Pengajar</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_mapel as $mapel) : ?>
                                <tr>
                                    <td><?= $mapel->mapel_kelompok ?></td>
                                    <td><?= $mapel->mapel_kelas ?></td>
                                    <td><?= $mapel->mapel_nama ?></td>
                                    <td><?= $mapel->guru_nama ?></td>
                                    <td>
                                        <?= form_open('admin/mapel/hapus') ?>
                                        <button class="badge bg-secondary border" type="button" data-bs-toggle="modal" data-bs-target="#form<?= $mapel->mapel_id ?>">
                                            edit
                                        </button>
                                        <input type="hidden" name="mapel_id" value="<?= $mapel->mapel_id ?>" class="d-none">
                                        <button type="submit" class="badge bg-danger border">
                                            hapus
                                        </button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="form<?= $mapel->mapel_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Form Mata Pelajaran</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <?= form_open('admin/mapel/update') ?>
                                            <div class="modal-body">
                                                <div class="form-group mb-4">
                                                    <label for="mapel_nama">Nama Mata Pelajaran</label>
                                                    <input type="text" class="form-control <?= (isset(session('errors')['mapel_nama'])) ? 'is-invalid' : '' ?>" id="mapel_nama" name="mapel_nama" value="<?= old('mapel_nama', $mapel->mapel_nama) ?>">
                                                    <div class="invalid-feedback">
                                                        <?php if (isset(session('errors')['mapel_nama'])) : ?>
                                                            <?= session('errors')['mapel_nama'] ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-4">
                                                    <label for="mapel_kelompok">Kelompok</label>
                                                    <select type="text" class="form-select <?= (isset(session('errors')['mapel_kelompok'])) ? 'is-invalid' : '' ?>" id="mapel_kelompok" name="mapel_kelompok" ?>">
                                                        <option value="">Pilih Kelompok</option>
                                                        <option value="umum" <?= set_select('mapel_kelompok', 'umum', ($mapel->mapel_kelompok == 'umum')) ?>>Umum</option>
                                                        <option value="IPA" <?= set_select('mapel_kelompok', 'IPA', ($mapel->mapel_kelompok == 'IPA')) ?>>IPA</option>
                                                        <option value="IPS" <?= set_select('mapel_kelompok', 'IPS', ($mapel->mapel_kelompok == 'IPS')) ?>>IPS</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        <?php if (isset(session('errors')['mapel_kelompok'])) : ?>
                                                            <?= session('errors')['mapel_kelompok'] ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-4">
                                                    <label for="mapel_kelas">Kelas</label>
                                                    <select type="text" class="form-select <?= (isset(session('errors')['mapel_kelas'])) ? 'is-invalid' : '' ?>" id="mapel_kelas" name="mapel_kelas">
                                                        <option value="">Pilih Kelas</option>
                                                        <option value="X" <?= set_select('mapel_kelas', 'X', ($mapel->mapel_kelas == 'X')) ?>>X</option>
                                                        <option value="XI" <?= set_select('mapel_kelas', 'XI', ($mapel->mapel_kelas == 'XI')) ?>>XI</option>
                                                        <option value="XII" <?= set_select('mapel_kelas', 'XII', ($mapel->mapel_kelas == 'XII')) ?>>XII</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        <?php if (isset(session('errors')['mapel_kelas'])) : ?>
                                                            <?= session('errors')['mapel_kelas'] ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-4">
                                                    <label for="guru_id">Guru</label>
                                                    <select type="text" class="form-select <?= (isset(session('errors')['guru_id'])) ? 'is-invalid' : '' ?>" id="guru_id" name="guru_id">
                                                        <option value="">Pilih Guru</option>
                                                        <?php foreach ($data_guru as $guru) : ?>
                                                            <option value="<?= $guru->guru_id ?>" <?= set_select('guru_id', $guru->guru_id, ($guru->guru_id == $mapel->guru_id)) ?>><?= $guru->guru_nama ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        <?php if (isset(session('errors')['guru_id'])) : ?>
                                                            <?= session('errors')['guru_id'] ?>
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
                <h5 class="modal-title" id="exampleModalLabel">Form Mata Pelajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('admin/mapel/store') ?>
            <div class="modal-body">
                <div class="form-group mb-4">
                    <label for="mapel_nama">Nama Mata Pelajaran</label>
                    <input type="text" class="form-control <?= (isset(session('errors')['mapel_nama'])) ? 'is-invalid' : '' ?>" id="mapel_nama" name="mapel_nama" value="<?= old('mapel_nama') ?>">
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['mapel_nama'])) : ?>
                            <?= session('errors')['mapel_nama'] ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="mapel_kelompok">Kelompok</label>
                    <select type="text" class="form-select <?= (isset(session('errors')['mapel_kelompok'])) ? 'is-invalid' : '' ?>" id="mapel_kelompok" name="mapel_kelompok" value="<?= old('mapel_kelompok') ?>">
                        <option value="">Pilih Kelompok</option>
                        <option value="umum" <?= set_select('mapel_kelompok', 'umum', (old('mapel_kelompok') == 'umum')) ?>>Umum</option>
                        <option value="XI" <?= set_select('mapel_kelompok', 'IPA', (old('mapel_kelompok') == 'IPA')) ?>>IPA</option>
                        <option value="IPS" <?= set_select('mapel_kelompok', 'IPS', (old('mapel_kelompok') == 'IPS')) ?>>IPS</option>
                    </select>
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['mapel_kelompok'])) : ?>
                            <?= session('errors')['mapel_kelompok'] ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="mapel_kelas">Kelas</label>
                    <select type="text" class="form-select <?= (isset(session('errors')['mapel_kelas'])) ? 'is-invalid' : '' ?>" id="mapel_kelas" name="mapel_kelas" value="<?= old('mapel_kelas') ?>">
                        <option value="">Pilih Kelas</option>
                        <option value="X" <?= set_select('mapel_kelas', 'X', (old('mapel_kelas') == 'X')) ?>>X</option>
                        <option value="XI" <?= set_select('mapel_kelas', 'XI', (old('mapel_kelas') == 'XI')) ?>>XI</option>
                        <option value="XII" <?= set_select('mapel_kelas', 'XII', (old('mapel_kelas') == 'XII')) ?>>XII</option>
                    </select>
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['mapel_kelas'])) : ?>
                            <?= session('errors')['mapel_kelas'] ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="guru_id">Guru</label>
                    <select type="text" class="form-select <?= (isset(session('errors')['guru_id'])) ? 'is-invalid' : '' ?>" id="guru_id" name="guru_id" value="<?= old('guru_id') ?>">
                        <option value="">Pilih Guru</option>
                        <?php foreach ($data_guru as $guru) : ?>
                            <option value="<?= $guru->guru_id ?>" <?= set_select('guru_id', $guru->guru_id, ($guru->guru_id == old('guru_id'))) ?>><?= $guru->guru_nama ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?php if (isset(session('errors')['guru_id'])) : ?>
                            <?= session('errors')['guru_id'] ?>
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