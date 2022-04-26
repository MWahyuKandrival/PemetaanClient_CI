<div class="container-fluid">
    <div class="main-content">
        <div class="row">
            <div class="col-md-12 bg-white Tulisanbagus">
                <!-- button search -->
                <h1 style="float: left; font-size: 25px;"><b>List Data Project</b></h1>
                <?php if (!empty($success_msg)) { ?>
                    <div class="col-xs-12">
                        <div class="alert alert-success"><?php echo $success_msg; ?></div>
                    </div>
                <?php } ?>
                <?php if (!empty($error_msg)) { ?>
                    <div class="col-xs-12">
                        <div class="alert alert-danger"><?php echo $error_msg; ?></div>
                    </div>
                <?php } ?>
                <button class="btn btn-success" data-toggle="modal" data-target="#exampleImport" style="float: right; margin-left: 10px;"><i class="fa fa-file-csv"></i>&nbsp;&nbsp;Import</button>
                <button class="btn btn-danger" data-toggle="modal" data-target="#example" style="float: right; margin-left: 10px;"><i class="fa fa-file-csv"></i>&nbsp;&nbsp;Export</button>
                <a href="<?= base_url('Project/addproject') ?>" class="btn btn-primary" style="float: right;"><i class="fa fa-plus"></i>Tambah Data</a>
            </div>
            <!-- Modal Export -->
            <div class="modal fade" id="example" tabindex="-1" role="dialog" aria-labelledby="example" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleLabel">Pilih Rentang Waktu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('Project/export_csv') ?>" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <center>
                                    <button type="button" class="btn btn-primary" onclick="setDate('all')">All Data</button>
                                    <button type="button" class="btn btn-primary" onclick="setDate('today')">Hari ini</button>
                                    <button type="button" class="btn btn-primary" onclick="setDate('week')">7 Hari yang lalu</button>
                                    <button type="button" class="btn btn-primary" onclick="setDate('month')">1 Bulan yang lalu</button>
                                </center>
                                <div class="form-group">
                                    <label for="mulai">Dari</label>
                                    <input name="mulai" autocomplete="off" value="<?= set_value('mulai'); ?>" type="date" class="form-control" id="mulai">
                                    <?= form_error('mulai', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="sampai">Sampai</label>
                                    <input name="sampai" autocomplete="off" value="<?= set_value('sampai'); ?>" type="date" class="form-control" id="sampai">
                                    <?= form_error('sampai', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal Import -->
            <div class="modal fade" id="exampleImport" tabindex="-1" role="dialog" aria-labelledby="exampleImport" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleLabel">Import CSV</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?php echo base_url('project/import'); ?>" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <center>
                                    <input type="file" name="file" />
                                </center>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" name="importSubmit" value="Submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
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
                                <td>Nama Project</td>
                                <td>Nama Client</td>
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
                                    <td class="<?php if ($us['status'] == "Berakhir") {
                                                    echo "text-danger";
                                                } else {
                                                    echo "text-success";
                                                } ?>"><?= $us['status']; ?></td>
                                    <td>
                                        <a href="<?= base_url('Project/hapus/') . $us['kode_projek']; ?>" class="badge badge-danger" onclick="return confirm('Apakah anda ingin menghapus Project <?= $us['nama_projek'] ?>?');">Hapus</a>
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
