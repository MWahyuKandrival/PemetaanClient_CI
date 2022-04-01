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