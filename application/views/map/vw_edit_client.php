<div class="main-content">
    <section class="section">
        <div class="section-header d-flex ">
            <!-- button search -->
            <h1>Form Edit Client <?= $client['nama_client'] ?></h1>
        </div>
        <div class="row">
            <!-- <div class="col-md-6"> -->
                <!-- MEMANGGIL MAP -->
                <!-- <div id="map" style="width:100%; height: 98%;"></div> -->
            <!-- </div> -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url('Client/update'); ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_client" value="<?= $client['id_client']; ?>">
                            <div class="form-group">
                                <label for="nama">Nama Pemilik</label>
                                <input name="nama_client" autocomplete="off" type="text" value="<?= $client['nama_client']; ?>" class="form-control" id="nama_client">
                                <?= form_error('nama_client', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="pic">PIC</label>
                                <input name="pic" autocomplete="off" type="text" value="<?= $client['pic']; ?>" class="form-control" id="pic">
                                <?= form_error('pic', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input name="alamat" autocomplete="off" type="text" value="<?= $client['alamat']; ?>" class="form-control" id="alamat">
                                <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="negara">Negara</label>
                                <input name="negara" autocomplete="off" type="text" value="<?= $client['negara']; ?>" class="form-control" id="negara">
                                <?= form_error('negara', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="region">Region</label>
                                <input name="region" autocomplete="off" value="<?= $client['region']; ?>" type="text" class="form-control" id="region">
                                <?= form_error('region', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="email">E-Mail</label>
                                <input name="email" autocomplete="off" value="<?= $client['email']; ?>" type="text" class="form-control" id="email">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No Handphone</label>
                                <input name="no_hp" autocomplete="off" value="<?= $client['no_hp']; ?>" type="text" class="form-control" id="no_hp">
                                <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="domain">Domain</label>
                                <input name="domain" autocomplete="off" value="<?= $client['domain']; ?>" type="text" class="form-control" id="domain">
                                <?= form_error('domain', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <!-- <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <label id=Llat style="color:white;background-color:black;"></label>
                                <input id="lokasi1" name="latitude" autocomplete="off" value="<?= $client['latitude']; ?>" type="text" class="form-control">
                                <?= form_error('latitude', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <label id=Llng style="color:white;background-color:black;"></label>
                                <input id="lokasi2" name="longitude" autocomplete="off" value="<?= $client['longitude']; ?>" type="text" class="form-control">
                                <?= form_error('longitude', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div> -->
                            <!-- <div class="form-group">
                                <label for="mulai_kerja_sama">Tanggal Mulai Kerja Sama</label>
                                <input name="mulai_kerja_sama" autocomplete="off" value="<?= $client['mulai_kerja_sama']; ?>" type="date" class="form-control" id="mulai_kerja_sama">
                                <?= form_error('mulai_kerja_sama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="henti_kerja_sama">Tanggal Berhenti Kerja Sama</label>
                                <input name="henti_kerja_sama" autocomplete="off" value="<?= $client['henti_kerja_sama']; ?>" type="date" class="form-control" id="henti_kerja_sama">
                                <?= form_error('henti_kerja_sama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div> -->
                            <div class="form-group">
                                <label for="status_kerja_sama">Status Kerja Sama</label>
                                <select name="status_kerja_sama" class="form-control" id="status_kerja_sama">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Berakhir" <?php if($client['status_kerja_sama'] == "Berakhir") echo "selected"?>>Berakhir</option>
                                </select>
                                <?= form_error('status_kerja_sama', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <!-- <div class="form-group">
							<label for="link_foto">Foto</label>
						    	<div class="custom-file">
								    <input type="file" class="custom-file-input" name="gambar" id="link_foto">
							    	<label for="link_foto" class="custom-file-label">Choose File</label>
							    </div>
						    </div> -->
                            <button type="submit" name="tambah" class="btn btn-primary float-left">Edit Data</button>
                            <a href="<?= base_url('Client') ?>" style="margin-left:10px;" class="btn btn-success float-left">Tutup</a>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
<!-- 
<script>
    var map = L.map('map').setView([<?= $client['latitude'] ?>, <?= $client['longitude'] ?>], 10);

    var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',
    }).addTo(map);

    var marker = L.marker([<?= $client['latitude'] ?>, <?= $client['longitude'] ?>], {
        draggable: true
    }).addTo(map);
    marker.on('dragend', function(e) {
        document.getElementById('lokasi1').value = marker.getLatLng().lat;
        document.getElementById('lokasi2').value = marker.getLatLng().lng;
    });
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
        document.getElementById("Llat").innerHTML = " Koordinat : " + lokasi1;
        document.getElementById("Llng").innerHTML = " Koordinat : " + lokasi2;

        //alert(lokasi1  +' | '+ lokasi2); 

    }
    map.on('click', onMapClick);
</script> -->