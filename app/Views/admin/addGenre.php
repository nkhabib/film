<?= $this->extend('template/adminTemplate/main'); ?>
<?= $this->section('contentAdmin'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <form action="/addGenre" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="mb-3">
                    <label class="form-label" for="genre">Genre</label>
                    <font color="red"><?= validation_show_error('genre'); ?></font>
                    <input type="text" class="form-control" name="genre" id="genre" value="<?= old('genre'); ?>">
                </div>
                <!-- <button>Tambah Genre</button> -->
                <button type="submit" class="btn btn-success">Simpan Genre</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>