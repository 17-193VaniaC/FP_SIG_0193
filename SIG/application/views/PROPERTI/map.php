<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>Custom tooltip</title>
<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
<script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css' rel='stylesheet' />
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.0.1/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.0.1/mapbox-gl.css' rel='stylesheet' />
<style>
  body { margin:0; padding:0; }
  #map { position:absolute; top:10%; bottom:0; width:100%; }
</style>
</head>
<body><br><br><br>
<div id="LOCLO" style="display: none;">
 
 <?php

 ?>

</div>
<div id='map'></div>

<script>
	var io  = <?php echo json_encode($properti); ?>;
	var lo  = document.getElementById("LOCLO");
    var lo_ = lo.textContent;

L.mapbox.accessToken = 'pk.eyJ1IjoiZHVzdHlsYXpsbyIsImEiOiJja2ozdmJzZXEyY2Z4MnBucjNtejNlaGVkIn0.3pSQgGuODsLS1PhQCKSySA';
var map = L.mapbox.map('map')
    .setView([io[0]['LATITUDE'], io[0]['LONGITUDE']], 13)
    .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));

var features = []
for (i=0;i<io.length;i++){
	features.push({
		"type" : "Feature",
		"geometry":{
			"type":"Point",
			"coordinates": [io[i]['LONGITUDE'],io[i]['LATITUDE']]
		},
		"properties":{
			"title": [io[i]['NAMA_P']],
			"description": "Alamat :" + io[i]['ALAMAT'] + '<br> Harga: Rp ' + io[i]['HARGA'] + 
			'<br><a class="btn btn-info" style="text-decoration: none; color: white; size: 12px;" href= <?php echo site_url("properti/propertidetail/'+ io[i]['ID_P'] + '");?>">Lihat Detail</a><?php if (isset($user['ROLE'])) : ?> <?php if ($user['ROLE'] == 'Admin') : ?><p><a class="btn btn-dark" style=" size: 12px;text-decoration: none; color: white;" href="<?php echo site_url("properti/editproperti/' + io[i]['ID_P'] + '"); ?>">Ubah</a></p><?php endif;?><?php endif;?>' ,
			'marker-color': '#548cba',
            'marker-size': 'large',
            'marker-symbol': 'building'
		}

	});
}

// for (i=0;i<io.length;i++){
// 	features.push({
// 		"type" : "Feature",
// 		"geometry":{
// 			"type":"Point",
// 			"coordinates":[io[i]['LATITUDE'], io[i]['LONGITUDE']],
// 		},
// 		"properties":{
// 			"title": [io[i]['NAMA_P']],
// 			"description": '<p>io][]</p><p>[io][]<,p>'
// 		}

// 	});
// }



var featureLayer = L.mapbox.featureLayer({
        type: 'FeatureCollection',
        features: features
    })
.addTo(map);



// Note that calling `.eachLayer` here depends on setting GeoJSON _directly_
// above. If you're loading GeoJSON asynchronously, like from CSV or from a file,
// you will need to do this within a `featureLayer.on('ready'` event.
// featureLayer.eachLayer(function(layer) {\
//     var content = '<h2>A ferry ride!<\/h2>' +
//         '<p>From: ' + layer.feature.properties.from + '<br \/>' +
//         'to: ' + layer.feature.properties.to + '<\/p>';
//     layer.bindPopup(content);
// });

// for (i=0;i<io.length;i++){

//  var popup = new mapboxgl.Popup({ offset: [0, -15] })
//     .setLngLat(features[i].geometry.coordinates)
//     .setHTML('<h3>' + features[i].properties.title + '</h3><p>' + features[i].properties.description + '</p>')
//  .addTo(map);

// }
</script>
</body>
</html>