<div class="container-fluid">
    <div class="main-content">
        <div class="row">
            <div class="col-md-12 bg-white Tulisanbagus">
                <!-- button search -->
                <h1 style="float: left; font-size: 25px;"><b>List Data Client</b></h1>
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
                <a href="<?= base_url('client/export_csv') ?>" class="btn btn-danger" style="float: right; margin-left: 10px;"><i class="fa fa-file-csv"></i>&nbsp;&nbsp;Export</a>
                <a href="<?= base_url('Client/addClient') ?>" class="btn btn-primary" style="float: right;"><i class="fa fa-plus"></i>Tambah Data</a>
            </div>
            <!-- Modal Export -->
            
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
                        <form action="<?php echo base_url('client/import'); ?>" method="post" enctype="multipart/form-data">
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
                                <td>Nama</td>
                                <td>PIC</td>
                                <!-- <td>Domain</td> -->
                                <td>Region</td>
                                <td>Total Projek</td>
                                <td>Status</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($client as $us) : ?>
                                <tr>
                                <td><?= $i; ?>.</td>
                                    <td><?= $us['nama_client']; ?></td>
                                    <td><?= $us['pic']; ?></td>
                                    <!-- <td><?= $us['domain']; ?></td> -->
                                    <td><?= $us['region']; ?></td>
                                    <td><?= $us['jumlah']; ?></td>
                                    <td class="<?php if ($us['status_kerja_sama'] == "Berakhir") {
                                                    echo "text-danger";
                                                } else {
                                                    echo "text-success";
                                                } ?>"><?= $us['status_kerja_sama']; ?></td>
                                    <td>
                                        <a href="<?= base_url('Client/hapus/') . $us['id_client']; ?>" class="badge badge-danger" onclick="return confirm('Apakah anda ingin menghapus Client beserta Project nya?');">Hapus</a>
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
<script type="text/javascript">
    function setDate(value) {
        if (value == "today") {
            $('#mulai').val("<?= $tanggal['today'] ?>")
            $('#sampai').val("<?= $tanggal['today'] ?>")
        } else if (value == "week") {
            $('#mulai').val("<?= $tanggal['last_week'] ?>")
            $('#sampai').val("<?= $tanggal['today'] ?>")
        } else if (value == "month") {
            $('#mulai').val("<?= $tanggal['last_month'] ?>")
            $('#sampai').val("<?= $tanggal['today'] ?>")
        } else {
            $('#mulai').val("")
            $('#sampai').val("")
        }
    }
</script>