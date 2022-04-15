<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <a href="<?= base_url('client') ?>">
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Client</h4>
                            </div>
                            <div class="card-body">
                                <?= $totalUser['total'] ?>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-circle"></i>
                    </div>
                    <a href="<?= base_url('client/index/Aktif') ?>">
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Client Aktif</h4>
                            </div>
                            <div class="card-body">
                                <?= $UserAktif['total'] ?>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-circle"></i>
                    </div>
                    <a href="<?= base_url('client/index/Berakhir') ?>">
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Client Berakhir</h4>
                            </div>
                            <div class="card-body">
                                <?= $UserNonAktif['total'] ?>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-file"></i>
                    </div>
                    <a href="<?= base_url('Project') ?>">
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Project</h4>
                            </div>
                            <div class="card-body">
                                <?= $totalProject['total_project'] ?>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="far fa-file"></i>
                    </div>
                    <a href="<?= base_url('Project/index/Aktif') ?>">
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Projek Aktif</h4>
                        </div>
                        <div class="card-body">
                            <?= $AktifProject['total_project'] ?>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file"></i>
                    </div>
                    <a href="<?= base_url('Project/index/Berakhir') ?>">
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Projek Berakhir</h4>
                        </div>
                        <div class="card-body">
                            <?= $BerakhirProject['total_project'] ?>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <canvas id="dashChart"></canvas>
            </div>
        </div>
    </section>
</div>

<?php
$labelTahun = array();
$dataTahun = array();

foreach ($Year as $tahun) :
    $labelTahun[] = $tahun['year'];
    $dataTahun[] = $tahun['Total'];
endforeach;
?>

<script>
    var labeltahun = <?= json_encode($labelTahun) ?>;
    var datatahun = <?= json_encode($dataTahun) ?>;
    const labels = [
        '0-4', '5-9', '10-14', '15-19', '20-24', '25-29', '30-34', '35-39',
        '40-44', '45-49', '50-54', '55-59', '60-64', '65-69', '70-74', '75+'
    ];
    var xValues = [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150];
    var yValues = [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15];
    const data = {
        labels: labeltahun,
        datasets: [{
            label: 'Total',
            data: datatahun,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1,
            tension: 0.5
        }]
    };
    const config = {
        type: 'line',
        data,
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Tahun'
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    };

    var ctx = document.getElementById('dashChart');
    var dashChart = new Chart(ctx, config);
</script>