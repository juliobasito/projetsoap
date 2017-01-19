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
            <b>Adresse de départ:</b> <?php echo $missionstart->localisation ?>
        </div>
        <div class="col s12">
            <b>Adresse d'arrivée:</b> <?php echo $missionend->localisation ?>
        </div>
        <div class="col s12">
            <b>Date de maximum de livraison:</b> <?php echo $mission->End ?>
        </div>
        <div class="col s12">
            <b>Type de marchandise</b> <?php echo $mission->Content ?>
        </div>
    </div>
    <div class="row center-align">
        <i class="material-icons" onclick="details()" style="cursor:pointer;">reorder</i>
    </div>
</div>
<div id="carte" style="width:100%; height:400px;"></div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCKkgefLFmKzT-O14c3rICcraC-IrBo4KE"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript">
    var lat = "";
    var lng ="";
    var lat2 = "";
    var lng2 = "";
    var carte = new google.maps.Map(document.getElementById("carte"));
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
        /*if(navigator.geolocation)
            navigator.geolocation.getCurrentPosition(maPosition);*/
        var tab = [];
        var a2 = '<?php echo $missionstart->localisation ?>';
        var b2 = '<?php echo $missionend->localisation ?>';
        var a = a2.replace(/ /g,"");
        var b = b2.replace(/ /g,"");
        tab = [a,b];
        initialiser("44.857283", "-0.554112");
                $.getJSON('http://maps.googleapis.com/maps/api/geocode/json?address=' + a + '&sensor=false', null, function (data) {
                    var p = data.results[0].geometry.location
                    var latlng = new google.maps.LatLng(p.lat, p.lng);
                    lat = p.lat;
                    lng = p.lng;
                    new google.maps.Marker({
                        position: latlng,
                        map: carte
                    });
                    $.getJSON('http://maps.googleapis.com/maps/api/geocode/json?address=' + b + '&sensor=false', null, function (data) {
                        var p = data.results[0].geometry.location
                        var latlng = new google.maps.LatLng(p.lat, p.lng);
                        lat2 = p.lat;
                        lng2 = p.lng;
                        new google.maps.Marker({
                            position: latlng,
                            map: carte
                        });
                        var latlng = new google.maps.LatLng(lat, lng);
                        var arrivee = new google.maps.LatLng(lat2, lng2);
                        directionsDisplay = new google.maps.DirectionsRenderer();
                        directionsDisplay.setMap(carte);
                        var directionsService = new google.maps.DirectionsService();
                        calculate(latlng, arrivee, directionsDisplay, directionsService);
                });



        });



    }


    function maPosition(position) {
        initialiser(position.coords.latitude, position.coords.longitude);
    }



    function initialiser(latitude,longitude) {
        var latlng = new google.maps.LatLng(latitude, longitude);
        var options = {
            center: latlng,
            zoom: 17,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        carte = new google.maps.Map(document.getElementById("carte"),options);


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
                directionDisplay.setDirections(result);
                document.getElementById("distance").innerHTML = (result.routes[0].legs[0].distance.value / 1000).toFixed(2) + ' KM';
                document.getElementById("temps").innerHTML = Math.floor(result.routes[0].legs[0].duration.value / 60) + ' Min';
            }
        });
    }
    function geocode(adress)
    {
        var q = $q.defer();
        var geocoder= new google.maps.Geocoder();
        var address = adress;
        var tab =[];
        geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                lat = results[0].geometry.location.lat();
                lng = results[0].geometry.location.lng();
                tab = [lat, lng];
                q.resolve(tab);
            }
        });
        return q.promise;

    }

    function codeAddress(address) {
        var map = new google.maps.Map(document.getElementById("carte"));
        /* Récupération de la valeur de l'adresse saisie */
        var address = address;
        /* Appel au service de geocodage avec l'adresse en paramètre */
        geocoder.geocode( { 'address': address}, function(results, status) {
            /* Si l'adresse a pu être géolocalisée */
            if (status == google.maps.GeocoderStatus.OK) {
                /* Récupération de sa latitude et de sa longitude */
                address.lat = results[0].geometry.location.lat();
                address.lng = results[0].geometry.location.lng();
                map.setCenter(results[0].geometry.location);
                /* Affichage du marker */
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
                /* Permet de supprimer le marker précédemment affiché */
                markers.push(marker);
                if(markers.length > 1)
                    markers[(i-1)].setMap(null);
                i++;
            } else {
                alert("Le geocodage n\'a pu etre effectue pour la raison suivante: " + status);
            }
        });
    }

</script>