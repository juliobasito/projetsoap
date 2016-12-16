<div class="row card">
  <div class="col s6 center-align">
    <div class="row">
      <h3>00:29:00</h3>
      <h5>Temps restant</h5>
    </div>
  </div>
  <div class="col s6">
    <div class="row">
      <h3>12.3 KM</h3>
      <h5>Distance restante</h5>
    </div>
  </div>
</div>
<div id="carte" style="width:100%; height:400px;"></div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCKkgefLFmKzT-O14c3rICcraC-IrBo4KE"></script>
<script type="text/javascript">
if(navigator.geolocation)
  navigator.geolocation.getCurrentPosition(maPosition);

function maPosition(position) {
  var infopos = "Position déterminée :\n";
  infopos += "Latitude : "+position.coords.latitude +"\n";
  infopos += "Longitude: "+position.coords.longitude+"\n";
  infopos += "Altitude : "+position.coords.altitude +"\n";
  initialiser(position.coords.latitude, position.coords.longitude);
}




function initialiser(latitude,longitude) {
  var latlng = new google.maps.LatLng(latitude, longitude);
  var arrivee = new google.maps.LatLng( 44.849402, -0.557838);

  var options = {
    center: latlng,
    zoom: 17,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  var carte = new google.maps.Map(document.getElementById("carte"), options);
  directionsDisplay = new google.maps.DirectionsRenderer();
  directionsDisplay.setMap(carte);
  var directionsService = new google.maps.DirectionsService();

  setMarker(carte, latlng);
  setMarker(carte, arrivee);
  calculate(latlng, arrivee, directionsDisplay, directionsService);


}

function setMarker(carte, latlng)
{
  var marker = new google.maps.Marker({
    position: latlng,
    map: carte,
    title: 'Hello World!'
  });
}

function calculate(origin, destination, directionDisplay, directionsService){
  current_pos = origin;
  end_pos = destination;
  var request = {
    origin:current_pos,
    destination:end_pos,
    travelMode: google.maps.TravelMode.DRIVING
  };
  directionsService.route(request, function(result, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(result);
    }
  });
}
</script>