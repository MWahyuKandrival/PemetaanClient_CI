<div class="container-fluid">
	<h1 class="h3 mb-4 text-gray-800"><?php  ?></h1>
	<div class="row ">
		<div class="col-md-6 ">
        <div id="map" style="width:100%; height: 98%;"></div>
			<!-- <div class="card">
				<div class="card-header">
					PICTURE
				</div>
				<div class="card-body">
                 
				<div>
                    <img style="width:100%" src="<?=$client->link_foto?>" alt="foto_bank">
                </div>
                   
				</div>
			</div> -->

		</div>

        <!-- Begin Page For Content -->
        <div class="col-md-6 ">
			<div class="card">
				<div class="card-header">
					<?php echo $judul?>
				</div>
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
							<label>Tanggal Mulai Kerja Sama</label>
							<input class="form-control" value="<?=$client['mulai_kerja_sama']?>" disabled>
                        </div>
                        <div class="form-group">
							<label>Tanggal Henti Kerja Sama</label>
							<input class="form-control" value="<?=$client['henti_kerja_sama']?>" disabled>
                        </div>
                        <div class="form-group">
							<label>Status Kerja Sama</label>
							<input class="form-control" value="<?=$client['status_kerja_sama']?>" disabled>
                        </div>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>
</div>

<script>
    var map = L.map('map').setView([0.8742919, 114.4477902], 5);

    var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',
    }).addTo(map);

    //var marker = L.marker([0.5102756596410103, 101.44848654368349],{draggable:true}).addTo(map)
    // var marker = L.marker([0.5102756596410103, 101.44848654368349],{draggable:false}).addTo(map)
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