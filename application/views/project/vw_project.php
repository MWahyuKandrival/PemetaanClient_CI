<div class="container-fluid">
    <div class="main-content">
        <div class="row">
            <div class="col-md-12 bg-white Tulisanbagus" >
                <!-- button search -->
                <h1 style="float: left; font-size: 25px;"><b>List Data Project</b></h1>
                
                <a href="<?= base_url('Project/addproject') ?>" class="btn btn-primary" style="float: right; margin-top: 10px;"><i class="fa fa-plus"></i>Tambah Data Project</a>
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
                                <td>Nama project</td>
                                <td>Nama client</td>
                                <!-- <td>Domain</td> -->
                                <td>Domain</td>
                                <td>Status</td>
                                <!-- <td>Status</td> -->
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($project as $us) : ?>
                                <tr>
                                    <td><?= $i; ?>.</td>
                                    <td><?= $us['nama_projek']; ?></td>
                                    <td><?= $us['nama']; ?></td>
                                    <td><?= $us['domain']; ?></td>
                                    <td class="<?php if($us['status'] == "Berakhir"){echo "text-danger";}else{echo "text-success";}?>"><?= $us['status']; ?></td>
                                    <td>
                                        <a href="<?= base_url('Project/hapus/') . $us['kode_projek']; ?>" class="badge badge-danger" onclick="return confirm('Apakah anda ingin menghapus Project <?= $us['nama_projek']?>?');">Hapus</a>
                                        <a href="<?= base_url('Project/edit/') . $us['kode_projek']; ?>" class="badge badge-warning">Edit</a>
                                        <a href="<?= base_url('Project/detail/') . $us['kode_projek']; ?>" class="badge badge-primary">Detail</a>
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