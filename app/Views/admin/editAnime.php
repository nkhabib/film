<?= $this->extend('template/template'); ?>
<?= $this->section('content'); ?>
<div class="container mt-2">
    <div class="row">
        <div class="col-md-6">
            <form action="/updateAnime/<?= $anime['id']; ?>" method="post" enctype="multipart/form-data">
                <?= @csrf_field(); ?>
                <div class="row mb-3">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <?php if (validation_show_error('title')) : ?>
                            <font color="red"><?= validation_show_error('title'); ?></font>
                        <?php endif; ?>
                        <?php if (old('title')) {
                            $title = old('title');
                        } else {
                            $title = $anime['title'];
                        }
                        ?>
                        <input type="text" name="title" class="form-control" id="title" value="<?= $title; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="sinopsis" class="col-sm-2 col-form-label">Sinopsis</label>
                    <div class="col-sm-10">
                        <?php if (validation_show_error('sinopsis')) : ?>
                            <font color="red"><?= validation_show_error('sinopsis'); ?></font>
                        <?php endif; ?>
                        <?php if (old('sinopsis')) {
                            $sinopsis = old('sinopsis');
                        } else {
                            $sinopsis = $anime['sinopsis'];
                        } ?>
                        <textarea name="sinopsis" class="form-control" id="sinopsis" cols="30" rows="5"><?= $sinopsis; ?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="cover" class="col-sm-2 col-form-label">Cover</label>
                    <div class="col-sm-4">
                        <img src="<?= base_url("images/") . $anime['image']; ?>" class="imgPreview" alt="" style="width: 150px;">
                    </div>
                    <div class="col-sm-6">
                        <?php if (validation_show_error('cover')) : ?>
                            <font color="red"><?= validation_show_error('cover'); ?></font>
                        <?php endif; ?>
                        <input type="file" name="cover" class="form-control inputWithPreview" id="cover" value="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label d-inline">Genre</label>
                    <div class="col-sm-10">
                        <?php foreach ($genres as $genre) : ?>
                            <div class="form-check form-check-inline">
                                <?php if (in_array($genre['id'], $id_genre)) : ?>
                                    <input class="form-check-input" type="checkbox" name="genre[]" id="genre<?= $genre['id']; ?>" value="<?= $genre['id']; ?>" checked>
                                <?php else : ?>
                                    <input class="form-check-input" type="checkbox" name="genre[]" id="genre<?= $genre['id']; ?>" value="<?= $genre['id']; ?>">
                                <?php endif; ?>
                                <label class="form-check-label" for="genre<?= $genre['id']; ?>"><?= $genre['name']; ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <input type="submit" name="update" class="btn btn-primary" value="Update Anime">
                <!-- <button type="submit" name="update" class="btn btn-primary">Update Anime</button> -->
            </form>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>