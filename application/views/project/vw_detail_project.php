<div class="main-content">
    <section class="section">
        <div class="section-header d-flex ">
            <!-- button search -->
            <h1>Form Detail Project <?= $project['nama_projek']?></h1>
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- MEMANGGIL MAP -->
                <div id="map" style="width:100%; height: 98%;"></div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label>Nama Project</label>
							<input class="form-control" value="<?=$project['nama_projek']?>" disabled>
                        </div>
                        <div class="form-group">
							<label>Domain</label>
							<input class="form-control" value="<?=$project['domain']?>" disabled>
                        </div>
                        <div class="form-group">
							<label>Package</label>
							<input class="form-control" value="<?=$project['package']?>" disabled>
                        </div>
                        <div class="form-group">
							<label>ID Client</label>
							<input class="form-control" value="<?=$project['nama']?>" disabled>
                        </div>
                        <div class="form-group">
							<label>Start Date</label>
							<input class="form-control" value="<?=$project['start_date']?>" disabled>
                        </div>
                        <div class="form-group">
							<label>End Date</label>
							<input class="form-control" value="<?=$project['end_date']?>" disabled>
                        </div>
                        <div class="form-group">
							<label>Status</label>
							<input class="form-control" value="<?=$project['status']?>" disabled>
                        </div>
                        <div class="form-group">
							<label>Ketua Project</label>
							<input class="form-control" value="<?=$project['ketua_projek']?>" disabled>
                        </div>
                        <a href="<?= base_url('Project') ?>" style="margin-left:10px;" class="btn btn-success float-left">Tutup</a>
					</form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

<script>
    var map = L.map('map').setView([<?=$project['latitude']?>, <?=$project['longitude']?>], 10);

    var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',
    }).addTo(map);

    //var marker = L.marker([0.5102756596410103, 101.44848654368349],{draggable:true}).addTo(map)
    var marker = L.marker([<?=$project['latitude']?>, <?=$project['longitude']?>],{draggable:false}).addTo(map)
    // 		.bindPopup('<b>Latitude : </b>'+lat[1]+'<br><b>Longitude : </b>'+lng[0]).openPopup(); 
    var popup = L.popup()
        .setLatLng([0.5102756596410103, 101.44848654368349], 14)

    function onMapClick(e) {
        var coord = e.latlng.toString().split(',');
        var lat = coord[0].split('(');
        var lng = coord[1].split(')');
        var lokasi1 = lat[1];
        var lokasi2 = lng[0];
        document.getElementById("Llat").innerHTML = "--> Koordinat : " + lokasi1;
        document.getElementById("Llng").innerHTML = "--> Koordinat : " + lokasi2;
        //alert(lokasi1  +' | '+ lokasi2); 
    }
    map.on('click', onMapClick);
</script>