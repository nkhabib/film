<?= $this->extend('template/adminTemplate/main'); ?>
<?= $this->section('contentAdmin'); ?>
<div class="container mt-4">
    <a href="/addGenre" class="btn btn-success">Add Genre</a>
    <table class="display" id="dataTable" style="width: 100%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Genre</th>
                <!-- <th>Judul</th>
                <th>Sinopsis</th>
                <th>Genre</th> -->
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
                <th>---</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($genres as $genre) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $genre['name']; ?></td>
                    <td><?= $genre['created_at']; ?></td>
                    <td><?= $genre['updated_at']; ?></td>
                    <td>
                        <!-- <a href="<?= base_url("editGenre/") . $genre['id'];  ?>" class="badge rounded-pill text-bg-warning">Edit</a> -->
                        <form action="<?= base_url("/editGenre/") . $genre['id'] ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="PUT">
                            <button type="submit" class="badge rounded-pill text-bg-warning">Edit</button>
                        </form>
                        <form action="<?= base_url("/deleteGenre/") . $genre['id'] ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="badge rounded-pill text-bg-danger" onclick="return confirm('Yakin Dihapus ?')">Hapus</button>
                        </form>
                    </td>
                    <td>
                        <a href="<?= base_url("/genre/") . $genre['id']; ?>" class="btn btn-success">Lihat Genre</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- <table>
        <thead>
            <td>No</td>
            <td>Nama</td>
            <td>Action</td>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($genres as $genre) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $genre['name']; ?></td>
                    <td>
                        <form action="editGenre/<?= $genre['id']; ?>" method="POST" class="d-inline">
                            <?= @csrf_field(); ?>
                            <input type="hidden" name="_method" value="PUT">
                            <input type="submit" name="genre" value="Edit">
                        </form>
                        <form action="deleteGenre/<?= $genre['id']; ?>" method="POST" class="d-inline">
                            <?= @csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" name="genre" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table> -->
</div>
<?= $this->endsection(); ?>