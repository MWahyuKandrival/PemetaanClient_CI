<div class="main-content">
    <section class="section">
        <div class="section-header d-flex ">
            <!-- button search -->
            <div class="d-flex ">
                <?php echo form_open('') ?>
                <div>
                    <h1>Form Edit Data Project <?= $project['nama_projek']?></h1>
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
                        <form action="<?= base_url('Project/update')?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="kode_projek" value="<?= $project['kode_projek']?>">
                            <div class="form-group">
                                <label for="nama">Nama Project</label>
                                <input name="nama_projek" autocomplete="off" type="text" value="<?= $project['nama_projek']; ?>" class="form-control" id="nama_client">
                                <?= form_error('nama_projek', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="domain">domain</label>
                                <input name="domain" autocomplete="off" type="text" value="<?= $project['domain']; ?>" class="form-control" id="domain">
                                <?= form_error('domain', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="package">Package</label>
                                <select name="package" id="menu_id" class="form-control">
                                    <option value="" <?php if($project['package'] == "") echo "selected"?>>Pilih Package</option>
                                    <option value="Bronze" <?php if($project['package'] == "Bronze") echo "selected"?>>Bronze</option>
                                    <option value="Silver" <?php if($project['package'] == "Silver") echo "selected"?>>Silver</option>
                                    <option value="Gold" <?php if($project['package'] == "Gold") echo "selected"?>>Gold</option>
                                    <option value="Platinum" <?php if($project['package'] == "Platinum") echo "selected"?>>Platinum</option>
                                </select>
                            </div>

                            <div class="form-group search_select_box">
                                <label for="id_client">Nama Client</label>
                                <select name="id_client" id="id_client" class="form-control" data-live-search="true">
                                    <option value="">Pilih Client</option>
                                    <?php foreach ($client as $p) : ?>
                                        <option value="<?= $p['id_client']; ?>" <?php if($project['id_client'] == $p['id_client']) echo "selected"?>><?= $p['nama_client']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <label id=Llat style="color:white;background-color:black;"></label>
                                <input id="lokasi1" name="latitude" autocomplete="off" value="<?= $project['latitude']; ?>" type="text" class="form-control">
                                <?= form_error('latitude', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <label id=Llng style="color:white;background-color:black;"></label>
                                <input id="lokasi2" name="longitude" autocomplete="off" value="<?= $project['longitude']; ?>" type="text" class="form-control">
                                <?= form_error('longitude', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                                
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input name="start_date" autocomplete="off" value="<?= $project['start_date']; ?>" type="date" class="form-control" id="region">
                                <?= form_error('start_date', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input name="end_date" autocomplete="off" value="<?= $project['end_date']; ?>" type="date" class="form-control" id="region">
                                <?= form_error('start_date', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="menu_id" class="form-control">
                                    <option value="" <?php if($project['status'] == "") echo "selected"?>>Pilih Status</option>
                                    <option value="Aktif" <?php if($project['status'] == "Aktif") echo "selected"?>>Aktif</option>
                                    <option value="Berakhir" <?php if($project['status'] == "Berakhir") echo "selected"?>>Berakhir</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="ketua_projek">Ketua_projek</label>
                                <input name="ketua_projek" autocomplete="off" value="<?= $project['ketua_projek']; ?>" type="text" class="form-control" id="domain">
                                <?= form_error('ketua_projek', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <!-- <div class="form-group">
							<label for="link_foto">Foto</label>
						    	<div class="custom-file">
								    <input type="file" class="custom-file-input" name="gambar" id="link_foto">
							    	<label for="link_foto" class="custom-file-label">Choose File</label>
							    </div>
						    </div> -->
                            <button type="submit" name="tambah" class="btn btn-primary float-left">Edit Project</button>
                            <a href="<?= base_url('project')?>" class="btn btn-danger" style="margin-left: 10px;">Kembali</a>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script>
    var map = L.map('map').setView([<?= $project['latitude']?>, <?= $project['longitude']?>], 10);

    var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',
    }).addTo(map);

    $(document).ready(function() {
        $('.search_select_box select').selectpicker();    
    });

    var marker = L.marker([<?= $project['latitude']?>, <?= $project['longitude']?>],{draggable:true}).addTo(map)
    marker.on('dragend', function(e) {
        document.getElementById('lokasi1').value = marker.getLatLng().lat;
        document.getElementById('lokasi2').value = marker.getLatLng().lng;
    });
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