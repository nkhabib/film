<?= $this->extend('template/adminTemplate/main'); ?>
<?= $this->section('contentAdmin'); ?>
<div class="container mt-4">
    <form action="/updateGenre/<?= $genre['id']; ?>" method="post">
        <?= csrf_field(); ?>
        <div class="mb-3">
            <label class="form-label" for="genre">Genre</label>
            <input type="hidden" name="_method" value="PUT">
            <font color="red"><?= validation_show_error('genre'); ?></font>
            <?= validation_show_error('genre'); ?>
            <input type="text" class="form-control" name="genre" id="genre" value="<?= $genre['name']; ?>"><br>
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </form>
</div>
<?= $this->endsection(); ?>