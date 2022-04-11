<div class="main-content">
    <section class="section">
        <div class="section-header d-flex ">
            <!-- button search -->
            <div class="d-flex ">
                <?php echo form_open('') ?>
                <div>

                    <h1>Form Tambah Data Project</h1>
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
                                <label for="nama">Nama Project</label>
                                <input name="nama_projek" autocomplete="off" type="text" value="<?= set_value('nama_client'); ?>" class="form-control" id="nama_client">
                                <?= form_error('nama_projek', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="domain">domain</label>
                                <input name="domain" autocomplete="off" type="text" value="<?= set_value('owner'); ?>" class="form-control" id="owner">
                                <?= form_error('domain', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="package">Package</label>
                                <select name="package" id="menu_id" class="form-control">
                                    <option value="">Pilih Package</option>
                                    <option value="">Bronze</option>
                                    <option value="">Silver</option>
                                    <option value="">Gold</option>
                                    <option value="">Platinum</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="client">Nama Client</label>
                                <select name="project" id="client" class="form-control">
                                    <option value="">Pilih Client</option>
                                    <?php foreach ($client as $p) : ?>
                                        <option value="<?= $p['id_client']; ?>"><?= $p['nama_client']; ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input name="start_date" autocomplete="off" value="<?= set_value('region'); ?>" type="date" class="form-control" id="region">
                                <?= form_error('start_date', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input name="end_date" autocomplete="off" value="<?= set_value('region'); ?>" type="date" class="form-control" id="region">
                                <?= form_error('start_date', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="menu_id" class="form-control">
                                    <option value="">Pilih Status</option>
                                    <option value="">Aktif</option>
                                    <option value="">Menunggu</option>
                                    <option value="">Berakhir</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="ketua_projek">Ketua_projek</label>
                                <input name="ketua_projek" autocomplete="off" value="<?= set_value('domain'); ?>" type="text" class="form-control" id="domain">
                                <?= form_error('ketua_projek', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>


                            <!-- <div class="form-group">
							<label for="link_foto">Foto</label>
						    	<div class="custom-file">
								    <input type="file" class="custom-file-input" name="gambar" id="link_foto">
							    	<label for="link_foto" class="custom-file-label">Choose File</label>
							    </div>
						    </div> -->
                            <button type="submit" name="tambah" class="btn btn-primary float-left">Tambah Project</button>
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

    $(document).ready(function() {
        $('#client').change(function() {
            var id = $("client").val();
            console.log(id);
            $.ajax({
                type: "POST",
                url: "<?= base_url('Client/getData/') ?>" + id,
                dataType: "JSON",
                success: async function(data) {
                    console.log(data);
                }
            });
        });

    });

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