<div class="container-fluid">
    <div class="main-content">
        <div class="row">
            <div class="col-md-12 bg-white Tulisanbagus" >
                <!-- button search -->
                <h1 style="float: left; font-size: 25px;"><b>List Data Client</b></h1>
                <a href="<?= base_url('client/export') ?>" class="btn btn-danger" style="float: right; margin-top: 10px; margin-left: 10px;"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a>
                <a href="<?= base_url('Map/addclient') ?>" class="btn btn-primary" style="float: right; margin-top: 10px;"><i class="fa fa-plus"></i>Tambah Data Client</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <!-- <div class="section-header d-flex flex-row-reverse">
            <table class="table table-striped table-hover"> -->
                        <thead class="thead-dark">
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>Owner</td>
                                <!-- <td>Domain</td> -->
                                <td>Region</td>
                                <!-- <td>Status</td> -->
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($client as $us) : ?>
                                <tr>
                                    <td><?= $i; ?>.</td>
                                    <td><?= $us['nama_client']; ?></td>
                                    <td><?= $us['owner']; ?></td>
                                    <!-- <td><?= $us['domain']; ?></td> -->
                                    <td><?= $us['region']; ?></td>
                                    <!-- <td><?= $us['status_kerja_sama']; ?></td> -->
                                    <td>
                                        <a href="<?= base_url('Client/hapus/') . $us['id_client']; ?>" class="badge badge-danger">Hapus</a>
                                        <a href="<?= base_url('Client/edit/') . $us['id_client']; ?>" class="badge badge-warning">Edit</a>
                                        <a href="<?= base_url('Client/detail/') . $us['id_client']; ?>" class="badge badge-primary">Detail</a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>