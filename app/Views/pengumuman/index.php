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
            <?php if (session('user')->user_type == 'admin') : ?>
                <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#form">
                    <i class="bi bi-plus"></i>
                    Tambah Pengumuman
                </button>
            <?php endif; ?>
            <div class="row">
                <?php foreach ($data_pengumuman as $pengumuman) : ?>
                    <div class="card col-md-6 mb-2">
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
                <?php endforeach; ?>
            </div>

        </div>

    </div>
</section>
<?php if (session('user')->user_type == 'admin') : ?>

    <div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pengumuman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?= form_open('admin/pengumuman/store') ?>
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="pengumuman_judul">Judul</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['pengumuman_judul'])) ? 'is-invalid' : '' ?>" id="pengumuman_judul" name="pengumuman_judul" value="<?= old('pengumuman_judul') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['pengumuman_judul'])) : ?>
                                <?= session('errors')['pengumuman_judul'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <textarea id="editor" rows="10" name="pengumuman_isi"></textarea>

                    <button type="submit" class="btn btn-primary">
                        Tambah Pengumuman
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>
<script src="<?= base_url('ckeditor/build/ckeditor.js') ?>"></script>
<style>
    .ck-editor__editable_inline {
        min-height: 200px;
    }
</style>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            // Look, ma! No plugins!
        })
        .then(editor => {
            console.log('Editor was initialized', editor);
        })
        .catch(error => {
            console.error(error.stack);
        });
</script>
<?= $this->endSection(); ?>