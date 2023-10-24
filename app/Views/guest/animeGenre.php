<?php if ($status == "Login" and $access[0] == "admin.access") : ?>
    <?= $this->extend('template/adminTemplate/main'); ?>
    <?= $this->section('contentAdmin'); ?>
<?php else : ?>
    <?= $this->extend('template/template'); ?>
    <?= $this->section('content'); ?>
<?php endif; ?>
<div class="container mt-4">
    <?php if ($access == "admin.access") : ?>
        <a href="inputAnime" class="btn btn-primary">Add Anime</a><br>
    <?php endif; ?>
    <?php if (session()->getFlashdata('fineMessage')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>OK!</strong> <?= session()->getFlashdata('fineMessage'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php elseif (session()->getFlashdata('warnMessage')) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>OK!</strong> <?= session()->getFlashdata('warnMessage'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if ($total > 0) : ?>
        <?php if ($total > 100) : $newOffset = $offset + 100; ?>
            <a href="<?= base_url("genre/$id/$newOffset"); ?>" class="btn btn-success">Data Selanjutnya</a>
        <?php endif; ?>
        <table class="display" id="dataTable" style="width: 100%;">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Cover</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Sinopsis</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($animes as $anime) : ?>
                    <tr>
                        <th scope="row"><?= $no++; ?></th>
                        <td>
                            <img src="<?= base_url("images/") . $anime['image']; ?>" alt="" width="70px">
                        </td>
                        <td><?= $anime['title']; ?></td>
                        <td style="width: 400px;"><?= $anime['sinopsis']; ?></td>
                        <td>
                            <?php foreach ($anime['id_genre'] as $genre) : ?>
                                <small><?= $genre; ?>,</small>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            <a href="detailAnime/<?= $anime['slug']; ?>" class="badge rounded-pill text-bg-success">Detail</a>
                            <?php if ($access == "admin.access") : ?>
                                <a href="editAnime/<?= $anime['slug']; ?>" class="badge rounded-pill text-bg-warning">Edit</a>
                                <form action="/delete/<?= $anime['id'] ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="badge rounded-pill text-bg-danger" onclick="return confirm('Yakin Dihapus ?')">Hapus</button>
                                </form>
                            <?php endif; ?>
                            <a href="<?= base_url("rating/") . $anime['slug']; ?>" class="badge rounded-pill text-bg-success">Beri Rating</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <h3>Belum ada anime apapun</h3>
    <?php endif; ?>
</div>
<?= $this->endsection(); ?>