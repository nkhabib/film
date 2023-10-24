<?= $this->extend('template/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="card mb-3">
        <div class="text-center">
            <img src="https://static.zerochan.net/Uchiha.Madara.full.3601200.jpg" class="card-img-top" alt="..." style="width: 200px;">
        </div>
        <div class="card-body">
            <h5 class="card-title"><?= $animes['title']; ?></h5>
            <p class="card-text"><?= $animes['sinopsis']; ?></p>
            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
            <a href="/animes" class="btn btn-success">Kembali</a>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>