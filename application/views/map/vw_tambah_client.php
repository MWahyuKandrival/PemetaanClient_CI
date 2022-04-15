<div class="main-content">
    <section class="section">
        <div class="section-header d-flex ">
            <!-- button search -->
            <div class="d-flex ">
                <?php echo form_open('') ?>
                <div>

                    <h1>Form Tambah Data Client</h1>
                </div>
                <?php echo form_close() ?>
            </div>
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
                                <label for="nama">Nama Client</label>
                                <input name="nama_client" autocomplete="off" type="text" value="<?= set_value('nama_client'); ?>" class="form-control" id="nama_client">
                                <?= form_error('nama_client', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="owner">Owner</label>
                                <input name="owner" autocomplete="off" type="text" value="<?= set_value('owner'); ?>" class="form-control" id="owner">
                                <?= form_error('owner', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input name="alamat" autocomplete="off" type="text" value="<?= set_value('alamat'); ?>" class="form-control" id="alamat">
                                <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="negara">Negara</label>
                                <input name="negara" autocomplete="off" type="text" value="<?= set_value('negara'); ?>" class="form-control" id="negara">
                                <?= form_error('negara', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="region">Region</label>
                                <input name="region" autocomplete="off" value="<?= set_value('region'); ?>" type="text" class="form-control" id="region">
                                <?= form_error('region', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="email">E-Mail</label>
                                <input name="email" autocomplete="off" value="<?= set_value('email'); ?>" type="text" class="form-control" id="email">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No Handphone</label>
                                <input name="no_hp" autocomplete="off" value="<?= set_value('no_hp'); ?>" type="text" class="form-control" id="no_hp">
                                <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="domain">Domain</label>
                                <input name="domain" autocomplete="off" value="<?= set_value('domain'); ?>" type="text" class="form-control" id="domain">
                                <?= form_error('domain', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <label id=Llat style="color:white;background-color:black;"></label>
                                <input id="lokasi1" name="latitude" autocomplete="off" value="<?= set_value('latitude'); ?>" type="text" class="form-control">
                                <?= form_error('latitude', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <label id=Llng style="color:white;background-color:black;"></label>
                                <input id="lokasi2" name="longitude" autocomplete="off" value="<?= set_value('longitude'); ?>" type="text" class="form-control">
                                <?= form_error('longitude', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="status_kerja_sama">Status Kerja Sama</label>
                                <select name="status_kerja_sama" class="form-control">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Berakhir">Berakhir</option>
                                </select>
                            </div>

                            <!-- <div class="form-group">
							<label for="link_foto">Foto</label>
						    	<div class="custom-file">
								    <input type="file" class="custom-file-input" name="gambar" id="link_foto">
							    	<label for="link_foto" class="custom-file-label">Choose File</label>
							    </div>
						    </div> -->
                            <button type="submit" name="tambah" class="btn btn-primary float-left">Tambah Client</button>
                            <button style="margin-left:10px;" type="reset" name="tambah" class="btn btn-success float-left">Reset</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
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
        // document.getElementById("Llat").innerHTML = "--> Koordinat : " + lokasi1;
        // document.getElementById("Llng").innerHTML = "--> Koordinat : " + lokasi2;
        document.getElementById("lokasi1").value = lokasi1;
        document.getElementById("lokasi2").value = lokasi2;

        //alert(lokasi1  +' | '+ lokasi2); 

    }
    map.on('click', onMapClick);
</script>