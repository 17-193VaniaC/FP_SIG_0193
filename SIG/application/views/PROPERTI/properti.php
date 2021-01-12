<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Display a map</title>
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
<script src="https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.css" rel="stylesheet" />
<style>
    font-family: Georgia, serif;
	body { margin: 0; padding: 0;  color: white; text-align: center; background-size: cover; }
	#map { 
		position: absolute;
		/*top: 0; bottom: 0; width: 100%; */
		height: 500px;
    /*width: 550px;*/
		width: 100%;

	}#instructions {
  position: absolute;
  margin: 5px;
  width: 30%;
  top: 10%;
  bottom: 20%;
  padding: 5px;
  background-color: rgba(255, 255, 255, 0.9);
  overflow-y: scroll;
  font-family: sans-serif;
  font-size: 0.8em;
  line-height: 2em;
}

.duration {
  font-size: 20px;
  font-weight: bold;
}

</style>
</head>
<body><br><br><br>
<div class="" style="margin-left: 50px;">
	<div class="row" style="width: 100%;"><br>	
    <div class="col" style=" width: 100%;">
      <i style="text-align: center;">Klik peta untuk mendapatkan navigasi dari lokasi anda ke properti ini</i>
      <br>
			<div id="map"></div>
			<div id="instructions">
				
			</div>
		</div>
    <div class="col" style=" width: 100%;">

		
				<?php
						if(empty($Detail->IMG)):
								echo '<div class="col" style="padding-left: 10%;"><div  style=" background-color: grey; text-align: center;height:250px; width: 100%; object-fit: cover;">Tidak ada foto</div><br>'; 
						else:
								echo '<div class="col" style="padding-left: 10%;"><br>	<img src="data:image/jpg;base64,'.base64_encode(stripslashes($Detail->IMG)).'" style="width: 100%; object-fit: cover; height:250px; "/><div>';
						endif;
				?>

		<br>
			<h4>
				<?= $Detail->NAMA_P;?>
			</h4>
				<?= $Detail->ALAMAT;?>
				<br>
				Rp <?= $Detail->HARGA;?>
				<br><br>
				<?= $Detail->DESKRIPSI;?>
      </div>
		</div>
    <div class="image roll"></div>
		<!-- <div id="ps" class=""></div> -->
    <input type="hidden" id="psla" name="">
    <input type="hidden" id="pslo" name="">
<!-- 		<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
		    <div class="carousel-inner">
		  	    <div class="carousel-item active">
				      <img class="d-block w-100" src="..." alt="First slide">
			    </div>
			    <div class="carousel-item">
				      <img class="d-block w-100" src="..." alt="Second slide">
			    </div>
			    <div class="carousel-item">
				      <img class="d-block w-100" src="..." alt="Third slide">
			    </div>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			</a>
		</div> -->

		</div>
</div></div>

<div id="LOCLA" style="display: none;">
    <?php
        $output = $Detail->LATITUDE;
        echo htmlspecialchars($output);
    ?>
</div>
<div id="LOCLO" style="display: none;">
    <?php
        $output = $Detail->LONGITUDE;
        echo htmlspecialchars($output);
    ?>
</div>

</body>
</html>
<script>
    var co;
	  var lo = document.getElementById("LOCLO");
    var la = document.getElementById("LOCLA");
    var lo_ = lo.textContent;
    var la_ = la.textContent;

	mapboxgl.accessToken = 'pk.eyJ1IjoiZHVzdHlsYXpsbyIsImEiOiJja2ozdmJzZXEyY2Z4MnBucjNtejNlaGVkIn0.3pSQgGuODsLS1PhQCKSySA';
	var map = new mapboxgl.Map({
		container: 'map',
		style: 'mapbox://styles/mapbox/streets-v10',
		center: [lo_, la_],
		zoom: 11
	});

	var marker = new mapboxgl.Marker()
		.setLngLat([lo_, la_])
		.addTo(map);

	var left = [Number(lo_) - 1, Number(la_) -0.1];
	var right = [Number(lo_)+1, Number(la_)+0.1];
	var bounds = [left, right];
	map.setMaxBounds(bounds);

	var canvas = map.getCanvasContainer();
	var start = [lo_, la_];
      function getRoute(end) {
        var url =
          'https://api.mapbox.com/directions/v5/mapbox/driving-traffic/' +
          Number(lo_) +
          ',' +
          Number(la_) +
          ';' +
          Number(end[0]) +
          ',' +
          Number(end[1]) +
          '?steps=true&geometries=geojson&access_token=' +
          mapboxgl.accessToken;

        var req = new XMLHttpRequest();
        req.open('GET', url, true);
        req.onload = function () {
          var json = JSON.parse(req.response);
          var data = json.routes[0];
          var route = data.geometry.coordinates;
          var geojson = {
            'type': 'Feature',
            'properties': {},
            'geometry': {
              'type': 'LineString',
              'coordinates': route
            }
          };
          if (map.getSource('route')) {
            map.getSource('route').setData(geojson);
          }
          else {
            map.addLayer({
              'id': 'route',
              'type': 'line',
              'source': {
                'type': 'geojson',
                'data': {
                  'type': 'Feature',
                  'properties': {},
                  'geometry': {
                    'type': 'LineString',
                    'coordinates': geojson
                  }
                }
              },
              'layout': {
                'line-join': 'round',
                'line-cap': 'round'
              },
              'paint': {
                'line-color': '#3887be',
                'line-width': 5,
                'line-opacity': 0.75
              }
            });
          }

          var instructions = document.getElementById('instructions');
          var steps = data.legs[0].steps;

          var tripInstructions = [];
          for (var i = 0; i < steps.length; i++) {
            tripInstructions.push('<br><li>' + steps[i].maneuver.instruction) +
              '</li>';
            instructions.innerHTML =
              '🚗<p class="duration">Lama Perjalanan: ' +
              Math.floor(data.duration / 60) +
              ' min   </p>' +
              tripInstructions;
          }
        };
        req.send();
      }

map.on('load', function () {
        getRoute(start);

        map.addLayer({
          'id': 'point',
          'type': 'circle',
          'source': {
            'type': 'geojson',
            'data': {
              'type': 'FeatureCollection',
              'features': [
                {
                  'type': 'Feature',
                  'properties': {},
                  'geometry': {
                    'type': 'Point',
                    'coordinates': start
                  }
                }
              ]
            }
          },
          'paint': {
            'circle-radius': 10,
            'circle-color': '#3887be'
          }
        });

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      }
    else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
function getthepos(positions) {
  return positions;
}

function showPosition(position) {
  document.getElementById("pslo").value = position.coords.longitude;
  document.getElementById("psla").value = position.coords.latitude;
}
          getLocation();

      map.on('click', function (e) {
          var coordsObj = e.lngLat;
          canvas.style.cursor = '';
          var las = document.getElementById('psla').value;
          var los = document.getElementById('pslo').value;
          var coords = [los, las];
          var end = {
            'type': 'FeatureCollection',
            'features': [
              {
                'type': 'Feature',
                'properties': {},
                'geometry': {
                  'type': 'Point',
                  'coordinates': coords
                }
              }
            ]
          };
          if (map.getLayer('end')) {
            map.getSource('end').setData(end);
          } else {
            map.addLayer({
              'id': 'end',
              'type': 'circle',
              'source': {
                'type': 'geojson',
                'data': {
                  'type': 'FeatureCollection',
                  'features': [
                    {
                      'type': 'Feature',
                      'properties': {},
                      'geometry': {
                        'type': 'Point',
                        'coordinates': coords
                      }
                    }
                  ]
                }
              },
              'paint': {
                'circle-radius': 10,
                'circle-color': '#f30'
              }
            });
          }
          getRoute(coords);
        });
      });
</script>
