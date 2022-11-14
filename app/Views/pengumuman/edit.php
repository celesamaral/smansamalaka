<?= $this->extend('layout_admin'); ?>
<?= $this->section('title'); ?>
<?= $title ?>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<div class="pagetitle">
    <h1><?= $title ?></h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Components</li>
            <li class="breadcrumb-item active">Tooltips</li>
        </ol>
    </nav>
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
                    <h5 class="card-title">Edit Pengumuman</h5>
                    <!-- End Tooltips Examples -->
                    <?= form_open('admin/pengumuman/update'); ?>
                    <input type="hidden" name="pengumuman_id" value="<?= $pengumuman->pengumuman_id ?>">
                    <div class="form-group mb-4">
                        <label for="pengumuman_judul">Judul</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['pengumuman_judul'])) ? 'is-invalid' : '' ?>" id="pengumuman_judul" name="pengumuman_judul" value="<?= old('pengumuman_judul', $pengumuman->pengumuman_judul) ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['pengumuman_judul'])) : ?>
                                <?= session('errors')['pengumuman_judul'] ?>
                            <?php endif; ?>
                        </div>

                    </div>
                    <div class="form-group mb-4">
                        <textarea name="pengumuman_isi" id="editor" cols="30" rows="10"><?= $pengumuman->pengumuman_isi ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>

        </div>

    </div>
</section>
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