<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Daftar Properti</title>
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
<script src="https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.css" rel="stylesheet" />
<style>
	body { margin: 0; padding: 0;  color: black; text-align: center; background-size: cover; min-height: 92vh; font-family: Georgia, serif; }
	#map { position: absolute; 
		/*top: 0; bottom: 0; width: 100%; */
		height: 80%;
		width: 60%;
	}
	#content_list{
		background-color: grey;
		margin: 5pt;
		width: 30%;
		text-align: left;
	}
</style>
</head>
<body>
<div class="container-xl" style=":margin-top 50px;">
<br><br><br><br><br>

		<?php foreach ($properti as $list_p) : ?>
			<div class="content_list" style="text-align: left; background-color: white; width: 30%;  margin: 10pt; float: left; height: 400px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); font-family: Arial, sans-serif;">
            <?php $id = $list_p->ID_P; ?>
			<a href="<?php echo site_url('properti/propertidetail/' .$id); ?>" style="text-decoration: none; color: black;">
				<div style="height: 50%; background-color: white; width: 100%; ">
					<?php
						if(empty($list_p->IMG)):
								echo '<p style="x:50%; y:30%;">Tidak ada foto</p>';
						else:
								echo '<img src="data:image/jpg;base64,'.base64_encode(stripslashes($list_p->IMG)).'" style="width: 100%; object-fit: cover; height:200px;"/>';
						endif;
					?>
			</div>
				<div style="padding: 15px; ">
				<p><?php echo $list_p->NAMA_P; ?></p>
				<p style="font-size: 12px;"><?php echo $list_p->LUAS; ?> m | <?php echo $list_p->TIPE; ?> | Rp <?php echo $list_p->HARGA; ?></p>
				<?php if ($list_p->TIPE == "Rumah") : ?>
				<!-- <p style="font-size: 12px;"><?php echo $ket->TOILET; ?> m | <?php echo $list_p->KAMAR; ?></p> -->
				<?php endif;?>
				
			

				<p style="font-size: 14px;"><?php echo $list_p->ALAMAT; ?></p>
			</a>
				<!-- <p><?php if ($user['ROLE'] == 'Admin') : ?> -->
					<!-- <td class="table-option-row"> -->
						<a href="<?php echo site_url('properti/editproperti/' . $list_p->ID_P) ?>""><button class=" btn btn-info">Edit</button></a>
						<a href=" <?php echo site_url('properti/delete/' . $list_p->ID_P) ?>""><button class=" btn btn-danger">Hapus</button></a>
					<!-- </td> -->
				<!-- <?php endif; ?> -->
				</div>
			</div>
		<?php endforeach;  ?>

   <?php if ($pagination) : ?>
        <div class="row">
            <div class="col">
                <!--Tampilkan pagination-->
                <?php echo $pagination; ?>
            </div>
        </div>
    <?php endif; ?>
	</div>
<!-- <div id="map"></div> -->
</body>
</html>
<!-- <script>
	mapboxgl.accessToken = 'pk.eyJ1IjoiZHVzdHlsYXpsbyIsImEiOiJja2ozdmJzZXEyY2Z4MnBucjNtejNlaGVkIn0.3pSQgGuODsLS1PhQCKSySA';
	var map = new mapboxgl.Map({
		container: 'map', // container id
		style: 'mapbox://styles/mapbox/streets-v11', // style URL
		center:[107.533867, -6.899541],
		zoom:11
	});
	var marker = new mapboxgl.Marker()
		.setLngLat([107.533867, -6.899541])
		.addTo(map);

</script> -->