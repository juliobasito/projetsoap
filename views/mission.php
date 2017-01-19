<div class="row card">
  <div class="row">
    <div class="col s6 center-align">
      <div class="row">
        <h3 id="temps">0 Min</h3>
        <h5>Temps restant</h5>
      </div>
    </div>
    <div class="col s6">
      <div class="row">
        <h3 id="distance">0KM</h3>
        <h5>Distance restante</h5>
      </div>
    </div>
  </div>
  <div class="row" id="details" style="display:none;">
    <div class="col s12">
      <b>Adresse de départ:</b> 419 Rue du Maréchal Niel, 33100 Bordeaux, France
    </div>
    <div class="col s12">
      <b>Adresse d'arrivée:</b> 419 Rue du Maréchal Niel, 33100 Bordeaux, France
    </div>
    <div class="col s12">
      <b>Date de maximum de livraison:</b> 01/01/2016 10H00
    </div>
    <div class="col s12">
      <b>Type de marchandise</b> Sable
    </div>
  </div>
  <div class="row center-align">
    <i class="material-icons" onclick="details()" style="cursor:pointer;">reorder</i>
  </div>
</div>
<div id="carte" style="width:100%; height:400px;"></div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCKkgefLFmKzT-O14c3rICcraC-IrBo4KE"></script>
<script type="text/javascript">
init();

function details(){
  if(document.getElementById("details").style.display == "none")
  {
    document.getElementById("details").style.display = "block";
  }
  else{
    document.getElementById("details").style.display = "none";
  }
}

function init()
{
  if(navigator.geolocation)
    navigator.geolocation.getCurrentPosition(maPosition);
  setTimeout(init,2000);
}

function maPosition(position) {
  initialiser(position.coords.latitude, position.coords.longitude);
}




function initialiser(latitude,longitude) {
  var latlng = new google.maps.LatLng(latitude, longitude);
  var arrivee = new google.maps.LatLng( 44.849402, -0.557838);
  geocoder = new google.maps.Geocoder();

  var test = geocode();
  var options = {
    center: latlng,
    zoom: 17,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  var carte = new google.maps.Map(document.getElementById("carte"), options);
  directionsDisplay = new google.maps.DirectionsRenderer();
  directionsDisplay.setMap(carte);
  var directionsService = new google.maps.DirectionsService();

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
      document.getElementById("distance").innerHTML = (result.routes[0].legs[0].distance.value / 1000).toFixed(2) + ' KM';
      document.getElementById("temps").innerHTML = Math.floor(result.routes[0].legs[0].duration.value / 60) + ' Min';
    }
  });
}

function geocode()
{
  var address = "1600 Amphitheatre Parkway, Mountain View, CA 94043, USA";
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
     var lat = results[0].geometry.location.lat();
     var lng = results[0].geometry.location.lng();
   }
 });
}
</script>