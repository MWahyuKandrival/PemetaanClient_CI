<div class="main-content">
    <section class="section">
        <div class="section-header d-flex flex-row-reverse">
            <!-- button search -->
            <div class="d-flex flex-row-reverse">
                <?php echo form_open('') ?>
                <div>
                    <input type="text" style="height:37px;border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;" name="keyword" autocomplete="off" placeholder="search">
                    <input class="btn btn-primary " type="submit" name="search_submit" value="Cari">
                </div>
                <?php echo form_close() ?>
            </div>


        </div>
        <div class="row">
            <div class="col">
                <!-- MEMANGGIL MAP -->
                <div id="map" style="width:100%; height: 550px;"></div>
            </div>
        </div>
    </section>
</div>
<script>
    //=================================================================//
    //  |   |   |   |   CONTROL LAYER
    //=================================================================//
    // LAYER SEARCH   

    var search = L.layerGroup();
    <?php 
        foreach ($products as $key) { ?>
        var lokasi = L.marker([<?= $key['latitude'] ?>, <?= $key['longitude'] ?>]).bindPopup("<center><b>INFORMATION</b></center><br>" +
            "<?= $key['nama_client'] ?><br>" +
            "<?= $key['owner'] ?><br>" +
            "<?= $key['negara'] ?><br>" +
            '<a href ="<?= base_url('bank_data/detail/') . $key["id_client"] ?>">See Detail...</a>').addTo(search);
    <?php } ?>
    //  LAYER 1 -> ALL DATA
    var clientLayer = L.layerGroup();
    <?php foreach ($client as $key) { ?>
        var lokasi = L.marker([<?= $key["latitude"] ?>, <?= $key["longitude"] ?>]).bindPopup("<center><b>INFORMATION</b></center><br>" +
            "<?= $key["nama_client"] ?><br>" +
            "<?= $key["owner"] ?><br>" +
            "<?= $key["negara"] ?><br>" +
            '<a href ="<?= base_url('bank_data/detail/') . $key["id_client"] ?>">See Detail...</a>').addTo(clientLayer);
    <?php } ?>
    // LAYER 2 -> SELEKSI Negara = Indonesia
    var negaraIndonesia = L.layerGroup();
    <?php foreach ($filterIndonesia as $key) { ?>
        var lokasi = L.marker([<?= $key["latitude"] ?>, <?= $key["longitude"] ?>]).bindPopup("<center><b>INFORMATION</b></center><br>" +
            "<?= $key["nama_client"] ?><br>" +
            "<?= $key["owner"] ?><br>" +
            "<?= $key["negara"] ?><br>" +
            '<a href ="<?= base_url('bank_data/detail/') . $key["id_client"] ?>">See Detail...</a>').addTo(negaraIndonesia);
    <?php } ?>
    // LAYER 3 -> SELEKSI Negara != Indonesia
    var negaraForeign = L.layerGroup();
    <?php foreach ($filterForeign as $key) { ?>
        var lokasi = L.marker([<?= $key["latitude"] ?>, <?= $key["longitude"] ?>]).bindPopup("<center><b>INFORMATION</b></center><br>" +
            "<?= $key["nama_client"] ?><br>" +
            "<?= $key["owner"] ?><br>" +
            "<?= $key["negara"] ?><br>" +
            '<a href ="<?= base_url('bank_data/detail/') . $key["id_client"] ?>">See Detail...</a>').addTo(negaraForeign);
    <?php } ?>

    var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>';
    var mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

    var grayscale = L.tileLayer(mbUrl, {
        id: 'mapbox/light-v9',
        tileSize: 512,
        zoomOffset: -1,
        attribution: mbAttr
    });
    var streets = L.tileLayer(mbUrl, {
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        attribution: mbAttr
    });

    var map = L.map('map', {
        center: [0.8742919, 114.4477902],
        zoom: 5,
        layers: [streets, search]
    });

    var baseLayers = {
        'Grayscale': grayscale,
        'Streets': streets,
    };

    var overlays = {
        'All Data': clientLayer,
        'Indonesia': negaraIndonesia,
        'Foreign': negaraForeign,
        // 'Bank Umum': jbfungsiLayerBU,
        // 'Bank Sentral': jbfungsiLayerBST,
        // 'Bank Perkreditan Rakyat': jbfungsiLayerBPR,
        // 'Bank Milik Pemerintah': jbkepemilikanLayerBMP,
        // 'Bank Milik Swasta Nasional': jbkepemilikanLayerBSMN,
        // 'Bank Pembangunan Daerah': jbkepemilikanLayerBPD,
        // 'Bank Asing': jbkepemilikanLayerBA,
        // 'Bank Milik Campuran': jbkepemilikanLayerBMC,
        'Use Search': search,
    };

    var layerControl = L.control.layers(baseLayers, overlays).addTo(map);
</script>