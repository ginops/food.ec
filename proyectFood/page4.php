

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Next to me | food.ec</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
  <link href="css/codiqa.ext.min.css" rel="stylesheet">
  <link href="css/jquery.mobile.theme-1.3.1.min.css" rel="stylesheet">
  <link href="css/jquery-mobile.css" rel="stylesheet">
  <link href="css/jquery.mobile.structure-1.3.1.min.css" rel="stylesheet">

  <script src="js/jquery-1.9.1.min.js"></script>
  <script src="js/jquery.mobile-1.3.1.min.js"></script>
  <script src="js/codiqa.ext.min.js"></script>
  <script src="js/food.ec.js"></script>
  
  <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDSppyaoZ-OVO1k7drDfofcuduZgpVNRIQ&sensor=true">
  </script>
  
  
  <script type="text/javascript">
      var x = document.getElementById("map");
      var markers = [];
      var infoWindow;
      var map;
      var htmls = [];
      var directionsDisplay = new google.maps.DirectionsRenderer(); 
      var directionsService = new google.maps.DirectionsService();
                  
        function initialize() {
            var $_GET = {};

            document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
                function decode(s) {
                    return decodeURIComponent(s.split("+").join(" "));
                }

                $_GET[decode(arguments[1])] = decode(arguments[2]);
            });
            infoWindow = new google.maps.InfoWindow();
            Glat = $_GET['lat'];
            Glong = $_GET['long'];
            rID = $_GET['id'];
            
              var mapOptions = {
                  center: new google.maps.LatLng(Glat, Glong),
                  zoom: 16,
                  mapTypeId: google.maps.MapTypeId.ROADMAP,
                  minZoom: 12,
                  maxZoom: 20,
                  streetViewControl: false

                };
                map = new google.maps.Map(document.getElementById("map"),
                    mapOptions);
                
                var marker = new google.maps.Marker({
                    
                    map: map,
                    position: new google.maps.LatLng(Glat, Glong)
                });
                var htmls = "<b>" + "Yo" + "</b>";
                google.maps.event.addListener(marker, 'click', function() {
                    infoWindow.setContent(htmls);
                    infoWindow.open(map, marker);
                    
                });
                setmarkers(latlongLocal, html);
              
        }
        function getLocation(id) {
            rID = id;
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else { 
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            var lat = position.coords.latitude;
            var long = position.coords.longitude;
            window.location.href = "page4.php?lat=" + lat +"&long=" + long +"&id=" + rID; 

        }
        function setmarkers(latlong, html){
            var pinColor = "00ced1";
            var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
                        new google.maps.Size(21, 34),
                        new google.maps.Point(0,0),
                        new google.maps.Point(10, 34));
            var marker = new google.maps.Marker({
                    map: map,
                    icon: pinImage,
                    position: latlong
                });
            
                google.maps.event.addListener(marker, 'click', function() {
                    infoWindow.setContent(html);
                    infoWindow.open(map, marker);
                    
                });
                directionsDisplay.setMap(map);
                var start =  new google.maps.LatLng(Glat, Glong);                   
                calcRuta(start, latlong);
        }
        function calcRuta (start, end){
                    var request = {
                        origin:start,
                        destination:end,
                        travelMode: google.maps.TravelMode.DRIVING
                    };
                    directionsService.route(request, function(result, status) {
                        if (status === google.maps.DirectionsStatus.OK) {
                          directionsDisplay.setDirections(result);
                        }
                      });
        }
        function savemarkers(nombre, direccion, lat, long){
            latlongLocal = new google.maps.LatLng(lat, long);
            html = "<b>" + nombre + "</b> </br>" + direccion;
        }
    </script>
</head>
<body onload="initialize();">
    <div data-role="page" data-control-title="Cerca de mi" id="page4">
      <div data-theme="b" data-role="header">
          <h3>
              Next to me
          </h3>
      </div>
    
    <div data-role="content">
    <div id="map" style="width: fit-content;height: 250px; margin-left: 3%; margin-right: 3%"></div>
        
      <?php
        if (!isset($_GET['lat']) || !isset($_GET['long'])){
            echo "<script> getLocation(".$_GET['id']."); </script>";
            echo 'works';
        }else{
            
            $id = $_GET['id'];
            $db = mysql_connect("localhost", "root",""); 
            $mydb = mysql_select_db("youneedisfood");
            mysql_query("SET NAMES 'utf8'");
            $sql = "SELECT idRestaurantes, Nombre, Direccion, Latitud, Longitud, Logo FROM restaurantes WHERE idRestaurantes = ".$id;

            $result = mysql_query($sql); 
            if ($row = mysql_fetch_array($result)){ 
            echo '<table class="table table-hover table-bordered table-responsive"> '; 
            //Mostramos los nombres de las tablas 
            do { 
                $lat = $row["Latitud"];
                $long = $row["Longitud"];
                $dir = $row["Direccion"];
                $nombre = $row["Nombre"];
                echo '<script>
                        savemarkers('.'"'.$nombre.'"'.','.'"'.$dir.'"'.','.'"'.$lat.'"'.','.'"'.$long.'"'.');
                      </script>';
                //echo '<tr>'; 
                      //echo '<td>' .$lat.','.$long. '</td><td>'; 
                      //echo '</tr>'; 
                echo "<tr> "; 
                echo '<td><img src="img/'.$row["Logo"].'" class="img-responsive"> </td> '; 
                echo "<td>Name: ".$row["Nombre"]."<br> Address: ".$row["Direccion"]."</td> "; 
                echo "</tr> "; 
            } while ($row = mysql_fetch_array($result)); 
                echo "</table> "; 
            } else { 
                echo "¡ No se ha encontrado ningún registro !"; 
            }
        }
    ?>         
        
         
      </div>
      
      <div data-role="tabbar" data-iconpos="top" data-theme="e">
          <ul>
              <li>
                  <a href="index.php" data-transition="fade" data-theme="" data-icon="search">
                      Search
                  </a>
              </li>
              <li>
                  <a href="categorias.php" data-transition="fade" data-theme="" data-icon="bars">
                      Categories
                  </a>
              </li>
              <li>
                  <a href="cerca.php" data-transition="fade" data-theme="" data-icon="star">
                      Next to me
                  </a>
              </li>
          </ul>
      </div>
  </div>
</body>
</html>
