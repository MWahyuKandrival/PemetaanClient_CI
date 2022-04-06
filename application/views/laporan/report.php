<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="<?= base_url('assets') ?>/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
    <div class="row">
        <div class="col text-center">
            <h3 class="h3 text-dark"><?= $title ?></h3>
        </div>
    </div> 
    <hr>   
    <div class="row">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama Client</td>
                    <td>Owner</td>
                    <td>Alamat</td>
                    <!-- <td>Negara</td> -->
                    <td>Region</td>
                    <td>Domain</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all_jual as $p) : ?>
                    <tr>
                        <td><?= $p['id_client'] ?></td>
                        <td><?= $p['nama_client'] ?></td>
                        <td><?= $p['owner'] ?></td>
                        <td><?= $p['alamat'] ?></td>
                        <!-- <td><?= $p['negara'] ?></td> -->
                        <td><?= $p['region'] ?></td>
                        <td><?= $p['domain'] ?></td>
                        <td><?= $p['status_kerja_sama'] ?></td>
                    </tr>
                    <?php endforeach ?>
            </tbody>
        </table>
    </div>
</body>
</html>