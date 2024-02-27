<div class="main-content">
    <section class="section">

        <div class="col-md-12 bg-white Tulisanbagus">
            <!-- button search -->
            <h1 style="float: left; font-size: 25px;">Halaman MAP</h1>
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
            "<?= $key['nama_projek'] ?><br>" +
            "<?= $key['nama_client'] ?><br>" +
            "<?= $key['negara'] ?><br>" +
            '<a href ="<?= base_url('Project/detail/') . $key["kode_projek"] ?>">See Detail...</a>').on('click', function(e) {
            map.flyTo(e.latlng, 13);
        }).addTo(search);
    <?php } ?>
    //  LAYER 1 -> ALL DATA
    var clientLayer = L.layerGroup();
    <?php foreach ($client as $key) { ?>
        var lokasi = L.marker([<?= $key["latitude"] ?>, <?= $key["longitude"] ?>]).bindPopup("<center><b>INFORMATION</b></center><br>" +
            "<?= $key["nama_projek"] ?><br>" +
            "<?= $key["nama_client"] ?><br>" +
            "<?= $key["negara"] ?><br>" +
            '<a href ="<?= base_url('Project/detail/') . $key["kode_projek"] ?>">See Detail...</a>').on('click', function(e) {
            map.flyTo(e.latlng, 13);
        }).addTo(clientLayer);
    <?php } ?>
    // LAYER 2 -> SELEKSI Negara = Indonesia
    var negaraIndonesia = L.layerGroup();
    <?php foreach ($filterIndonesia as $key) { ?>
        var lokasi = L.marker([<?= $key["latitude"] ?>, <?= $key["longitude"] ?>]).bindPopup("<center><b>INFORMATION</b></center><br>" +
            "<?= $key["nama_projek"] ?><br>" +
            "<?= $key["nama_client"] ?><br>" +
            "<?= $key["negara"] ?><br>" +
            '<a href ="<?= base_url('Project/detail/') . $key["kode_projek"] ?>">See Detail...</a>').on('click', function(e) {
            map.flyTo(e.latlng, 13);
        }).addTo(negaraIndonesia);
    <?php } ?>
    // LAYER 3 -> SELEKSI Negara != Indonesia
    var negaraForeign = L.layerGroup();
    <?php foreach ($filterForeign as $key) { ?>
        var lokasi = L.marker([<?= $key["latitude"] ?>, <?= $key["longitude"] ?>]).bindPopup("<center><b>INFORMATION</b></center><br>" +
            "<?= $key["nama_projek"] ?><br>" +
            "<?= $key["nama_client"] ?><br>" +
            "<?= $key["negara"] ?><br>" +
            '<a href ="<?= base_url('Project/detail/') . $key["kode_projek"] ?>">See Detail...</a>').on('click', function(e) {
            map.flyTo(e.latlng, 13);
        }).addTo(negaraForeign);
    <?php } ?>

    var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    });

    var osmHOT = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'});


    var map = L.map('map', {
        center: [0.8742919, 114.4477902],
        zoom: 5,
        layers: [search, osm, osmHOT],
        //fullscreenControl: true,
        // fullscreenControl: {
        // pseudoFullscreen: false // if true, fullscreen to page width and height
        // }
        
    });

    // Create a new map with a fullscreen button:
//     var map = new L.Map('map', {
//     // fullscreenControl: true,
//     // OR
//     fullscreenControl: {
//         pseudoFullscreen: false // if true, fullscreen to page width and height
//     }
//     }
    
// );
    map.isFullscreen() // Is the map fullscreen?
    map.toggleFullscreen() // Either go fullscreen, or cancel the existing fullscreen.

    // `fullscreenchange` Event that's fired when entering or exiting fullscreen.
    map.on('fullscreenchange', function () {
        if (map.isFullscreen()) {
            console.log('entered fullscreen');
        } else {
            console.log('exited fullscreen');
        }
    });

    map.addControl(new L.Control.Fullscreen({
    title: {
        'false': 'View Fullscreen',
        'true': 'Exit Fullscreen'
    }
}));
// or, add to an existing map:
// map.addControl(new L.Control.Fullscreen());

    var baseLayers = {
        'OSM': osm,
        'OSMHot': osmHOT,
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
