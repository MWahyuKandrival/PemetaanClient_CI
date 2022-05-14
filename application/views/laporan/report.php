<div class="container-fluid">
    <div class="main-content">
        <div class="row">
            <div class="col-md-12 bg-white Tulisanbagus">
                <!-- button search -->
                <h1 style="float: left; font-size: 25px;"><b>Detail</b></h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <?php foreach ($message[0] as $key => $value) : ?>
                                    <th><?= $key ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($message as $row) : ?>
                                <tr>
                                    <td><?= $i; ?>.</td>
                                    <?php foreach ($row as $key => $value) : ?>
                                        <td><?= $value ?></td>
                                    <?php endforeach; ?>
                                    <?php $i++; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>