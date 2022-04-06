<div class="container-fluid">
<div class="main-content">
    <section class="section">
        <a href="<?= base_url('client/export') ?>" class="badge badge-danger float-right"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a>
        <div class="float-left">
            <a href="<?= base_url('Map/addclient') ?>" class="btn btn-primary"><i class="fa fa-plus"></i>Tambah Data Client</a>
        </div>
        <?= $this->session->flashdata('message'); ?>
        <div class="clearfix">
        </div>
        <div class="card shadow mb-4">
            <div class="card-body"></div>
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
                            <td><?= $us['owner']; ?></td>
                            <!-- <td><?= $us['domain']; ?></td> -->
                            <td><?= $us['region']; ?></td>
                            <td><?= $us['status_kerja_sama']; ?></td>
                            <td>
                                <a href="<?= base_url('Client/hapus/') . $us['id_client']; ?>" class="badge badge-danger">Hapus</a>
                                <a href="<?= base_url('Client/edit/') . $us['id_client']; ?>" class="badge badge-danger">Edit</a>
                                <a href="<?= base_url('Client/detail/') . $us['id_client']; ?>" class="badge badge-danger">Detail</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
</div>