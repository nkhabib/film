<?php if ($status == "Login" and $access[0] == "admin.access") : ?>
    <?= $this->extend('template/adminTemplate/main'); ?>
    <?= $this->section('contentAdmin'); ?>
<?php else : ?>
    <?= $this->extend('template/template'); ?>
    <?= $this->section('content'); ?>
<?php endif; ?>
<div class="container">
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

    <?php if ($offset + 500 < $total) : ?>
        <small>
            <font color="red">
                Total Data : <?= $total; ?>
                || Data Ditampilkan 500
                || Klik Data Selanjutnya Untuk Meneruskan
            </font>
        </small>
        <a class="btn btn-success" href="<?= base_url('/animes/') . $offset + 500; ?>">Data Berikutnya</a>
    <?php endif; ?>
    <br>
    <?php $count = count($animes); ?>
    <?php if ($count > 0) : ?>
        <table class="display" id="dataTable" style="width: 100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Cover</th>
                    <th>Judul</th>
                    <th>Sinopsis</th>
                    <th>Genre</th>
                    <?php if ($status == "Login" and $access[0] == "admin.access") : ?>
                        <th>Action</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($animes as $anime) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>
                            <img src="<?= base_url("/images/") . $anime['image']; ?>" alt="" width="70px">
                        </td>
                        <td><?= $anime['title']; ?></td>
                        <td style="width: 400px;"><?= $anime['sinopsis']; ?></td>
                        <td>
                            <?php foreach ($anime['id_genre'] as $genre) : ?>
                                <small>
                                    <?= $genre; ?>,
                                </small>
                            <?php endforeach; ?>
                        </td>
                        <?php if ($status == "Login" and $access[0] == "admin.access") : ?>
                            <td>
                                <button type="button" class="badge rounded-pill text-bg-success" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $anime['slug']; ?>">
                                    Detail
                                </button>
                                <!-- <a href="detailAnime/<?= $anime['slug']; ?>" class="badge rounded-pill text-bg-success">Detail</a> -->
                                <a href="editAnime/<?= $anime['slug']; ?>" class="badge rounded-pill text-bg-warning">Edit</a>
                                <form action="/delete/<?= $anime['id'] ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="badge rounded-pill text-bg-danger" onclick="return confirm('Yakin Dihapus ?')">Hapus</button>
                                </form>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <h3>Belum ada anime apapun</h3>
    <?php endif; ?>
</div>
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button> -->

<?= $this->endsection(); ?>
<?= $this->section("outBody"); ?>
<!-- Modal -->
<?php foreach ($animes as $anime) : ?>
    <div class="modal fade" id="exampleModal<?= $anime['slug']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= $anime['title']; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Vertically centered modal -->
<div class="modal-dialog modal-dialog-centered">
    ...
</div>

<!-- Vertically centered scrollable modal -->
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    ...
</div>
<?= $this->endsection(); ?>