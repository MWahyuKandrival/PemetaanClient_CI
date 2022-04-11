<div class="main-content">
    <section class="section">
        <div class="section-header d-flex ">
            <!-- button search -->
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
							<label>Nama Client</label>
							<input class="form-control" value="<?=$client['nama_client']?>" disabled>
                        </div>
                        <div class="form-group">
							<label>Owner</label>
							<input class="form-control" value="<?=$client['owner']?>" disabled>
                        </div>
                        <div class="form-group">
							<label>Alamat</label>
							<input class="form-control" value="<?=$client['alamat']?>" disabled>
                        </div>
                        <div class="form-group">
							<label>Negara</label>
							<input class="form-control" value="<?=$client['negara']?>" disabled>
                        </div>
                        <div class="form-group">
							<label>Region</label>
							<input class="form-control" value="<?=$client['region']?>" disabled>
                        </div>
                        <div class="form-group">
							<label>Email</label>
							<input class="form-control" value="<?=$client['email']?>" disabled>
                        </div>
                        <div class="form-group">
							<label>No Hp</label>
							<input class="form-control" value="<?=$client['no_hp']?>" disabled>
                        </div>
                        <div class="form-group">
							<label>Domain</label>
							<input class="form-control" value="<?=$client['domain']?>" disabled>
                        </div>
                        <div class="form-group">
							<label>Latitude</label>
							<input class="form-control" value="<?=$client['latitude']?>" disabled>
                        </div>
                        <div class="form-group">
							<label>Longitude</label>
							<input class="form-control" value="<?=$client['longitude']?>" disabled>
                        </div>
                        <div class="form-group">
							<label>Total Project</label>
							<input class="form-control" value="<?=$client['jumlah']?>" disabled>
                        </div>
                        <!-- <div class="form-group">
							<label>Tanggal Henti Kerja Sama</label>
							<input class="form-control" value="<?=$client['henti_kerja_sama']?>" disabled>
                        </div> -->
                        <div class="form-group">
							<label>Status Kerja Sama</label>
							<input class="form-control" value="<?=$client['status_kerja_sama']?>" disabled>
                        </div>
                        <a href="<?= base_url('Project/list/').$client['id_client'] ?>" class="btn btn-primary float-left">Lihat Projek</a>
                        <a href="<?= base_url('Client') ?>" style="margin-left:10px;" class="btn btn-success float-left">Tutup</a>
					</form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

<script>
    var map = L.map('map').setView([<?=$client['latitude']?>, <?=$client['longitude']?>], 10);

    var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',
    }).addTo(map);

    //var marker = L.marker([0.5102756596410103, 101.44848654368349],{draggable:true}).addTo(map)
    var marker = L.marker([<?=$client['latitude']?>, <?=$client['longitude']?>],{draggable:false}).addTo(map)
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