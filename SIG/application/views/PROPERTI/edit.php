<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
<script src="https://api.mapbox.com/mapbox-gl-js/v2.0.1/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v2.0.1/mapbox-gl.css" rel="stylesheet" />
<style>
	#map {position: relative; height: 200px; width: 100%; }
	#info {
display: absolute;
position: relative;
margin: 0px auto;
width: 50%;
padding: 10px;
border: none;
border-radius: 3px;
font-size: 12px;
text-align: center;
color: #222;
background: #fff;}
</style>
<div class="row" style="background-color: white; min-height: 92vh;">
	<div class="col">
		<div class="container">
			<div class="row justify-content-center" style="margin-top: 100px;">
				<div class="col-lg-9">
					<!-- FLASH MESSAGE -->
					<?php if ($this->session->flashdata('success')) { ?>
						<?php
						echo "<div class='alert alert-success'>";
						echo $this->session->flashdata('success');
						echo "</div>";
						?>
					<?php } ?>
					<?php if ($this->session->flashdata('failed')) { ?>
						<?php
						echo $this->session->flashdata('failed');
						echo "<strong>Gagal</strong>";
						echo "</div>";
						?>
					<?php } ?>
					<!-- END FLASH MESSAGE -->

						<div class="card-body pb-20">
							<div class="row justify-content-center" style="margin-top: 20px;">
								<div class="col-lg">
									<div class="text-center">
										<h2>Edit Properti</h2>
									</div>
									<form action="" method="post" enctype='multipart/form-data'>
										<table style="margin-top: 20px; width: 100%">
											<?php
										if(!empty($properti->IMG)):
												echo '<img src="data:image/jpg;base64,'.base64_encode(stripslashes($properti->IMG)).'" style="height: 90%;width: 100%;background-size:cover;"/>';
										endif;
											?>

											<tr>
												<td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
													<label for="pict2">Foto*</label>
													<small>optional</small>
												</td>
												<td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
													<input type="file" name="pict2">
												</td>


											</tr>

											<tr>
												<td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
													<label for="n_properti">Nama Properti</label>
												</td>
												<td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
													<input type="text" name="n_properti" placeholder="Nama Properti" class="form-control" value="<?php echo $properti->NAMA_P?>" />
													<input name="id_prop" type="hidden" value="<?php echo $properti->ID_P?>" >

													<small class="text-danger"><?php echo form_error('n_properti') ?></small>
												</td>

											</tr>
											<tr>
												<td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
													<label for="almt">Alamat</label>
												</td>
												<td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
													<input type="text" name="almt" placeholder="" class="form-control" value="<?php echo $properti->ALAMAT?>" />
													<small class="text-danger"><?php echo form_error('almt') ?></small>
												</td>
											</tr>
											<tr>
												<td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
													<label for="price">Harga</label>
												</td>
												<td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
													<input type="number" name="price" placeholder="Rp" class="form-control" value="<?php echo $properti->HARGA?>" />
													<small class="text-danger"><?php echo form_error('price') ?></small>
												</td>
											</tr>
											<tr>
												<td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
													<label for="size">Luas</label>
												</td>
												<td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
													<input type="number" name="size" placeholder="Meter persegi" class="form-control" value="<?php echo $properti->LUAS?>" />
													<small class="text-danger"><?php echo form_error('size') ?></small>
												</td>
											</tr>
											<tr>
												<td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
													<label for="type">Tipe</label>
												</td>
												<td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
													<select class="form-control form-control-user" name="type" value="<?php echo $properti->TIPE?>" >
															<option value="Rumah">Rumah</option>
															<option value="Apartemen">Apartemen</option>
															<option value="Tanah">Tanah</option>

													</select>
													<small class="text-danger"><?php echo form_error('type') ?></small>

												</td>
											</tr>
											<tr>
												<td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
													<label for="desk">Deskripsi</label>
												</td>
												<td class="text-left" style="margin-left: 3px; width: 30%; padding-top:20px; padding-right: 20px">
													<input type="textfield" name="desk" placeholder="Deskripsi" style="-moz-appearance: textfield; margin: 0;" class="form-control" value="<?php echo $properti->DESKRIPSI?>"/>
													<small class="text-danger"><?php echo form_error('desk') ?></small>
												</td>
											</tr>

												
											<tr style="background-color: #f2f5f5;">
												<td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
													<label for="lat">Lokasi</label>
												</td>
												<td class="text-left" style="margin-left: 3px; width: 30%; padding-top:20px; padding-right: 20px">
													<input type="textfield" id="lt" name="lat" placeholder="Latitude Lokasi" style="-moz-appearance: textfield; margin: 0;" class="form-control" value="<?php echo $properti->LATITUDE?>"/>
													<small class="text-danger"><?php echo form_error('lat') ?></small>
												</td>
											</tr>
											<tr style="background-color: #f2f5f5;">
												<td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
													<label for="long"></label>
												</td>
												<td class="text-left" style="margin-left: 3px; width: 30%; padding-top:20px; padding-right: 20px">
													<input id="lo" type="textfield" name="long" placeholder="Longitude Lokasi" style="-moz-appearance: textfield; margin: 0;" class="form-control" value="<?php echo $properti->LONGITUDE?>"/>
													<small class="text-danger"><?php echo form_error('long') ?></small>
													<br>
												</td>
											</tr>
											<tr style="background-color: #f2f5f5;">
												<td style="white-space: nowrap; width: 100">
													
												</td>
												<td>
												<a class="btn btn-primary" style="color: white;" onclick="getLocation()"><strong>Gunakan Lokasi Anda</strong></a>
												atau pilih pada peta
											<br><br>
												</td>
											</tr>
											<tr>
													<td style="white-space: nowrap;" colspan="2">	
															<div id="map"></div>
															<pre id="info"></pre>
													</td>
											</tr>
											
											
											
										</table>
										<div class="row mx-1" style="float:right; margin-top : 3%;">
											<div class="col">
												<button value="save" type="submit" class="btn btn-success">
													Simpan
												</button>
											</div>
											<div class="col">
												<a href="<?php echo site_url("properti"); ?>" s class="btn btn-secondary">
													Batal
												</a>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
var lt = document.getElementById("lt");
var lo = document.getElementById("lo");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPositionLong);
    navigator.geolocation.getCurrentPosition(showPositionLat);
  } else { 
    lt.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPositionLat(position) {
  	document.getElementById("lt").value = position.coords.latitude;
}

function showPositionLong(position) {
	lo.innerHTML = position.coords.longitude;
	document.getElementById("lo").value = position.coords.longitude;
}

</script>
<script>
	mapboxgl.accessToken = 'pk.eyJ1IjoiZHVzdHlsYXpsbyIsImEiOiJja2ozdmJzZXEyY2Z4MnBucjNtejNlaGVkIn0.3pSQgGuODsLS1PhQCKSySA';
	var map = new mapboxgl.Map({
			container: 'map', // container id
			style: 'mapbox://styles/mapbox/streets-v11',
			center: [107, -6.9], // starting position
			zoom: 9 // starting zoom
	});
	 
	map.on('click', function (e) {
	document.getElementById('info').innerHTML =
	positions = e.lngLat.wrap();
			document.getElementById("lo").value = positions["lng"];
			document.getElementById("lt").value = positions["lat"];
	});
</script>