<?php
$starttime = explode(' ', microtime());
$starttime = $starttime[1] + $starttime[0];


$PORT = $_SERVER["SERVER_PORT"];
if ($PORT == '80') {
$HTTP='http://';
}
else {
$HTTP='https://';
}

$MAPA=" 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 18,";
//$MAPA=" 'https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', { maxZoom: 17,";


if(isset($_GET["id"])) $id=$_GET["id"];
if(isset($_GET["lat"])) $lat=$_GET["lat"];
if(isset($_GET["lon"])) $lon=$_GET["lon"];
if(isset($_GET["zoom"])) $zoom=$_GET["zoom"];
if(isset($_GET["day"])) $day=$_GET["day"];
if(isset($_GET["month"])) $month=$_GET["month"];
if(isset($_GET["year"])) $year=$_GET["year"];
if(isset($_GET["device"])) $device=$_GET["device"];
if(isset($_GET["devicerpi"])) $devicerpi=$_GET["devicerpi"];
$tracking_list_db_row=0;

if ((empty($_GET["day"])) && (empty($_GET["month"])) && (empty($_GET["year"]))) {
 $day = Date("d");
 $month = Date("m");
 $year = Date("Y");
} else {
 $day=$_GET["day"];
 $month=$_GET["month"];
 $year=$_GET["year"];
}

if ((empty($_GET["lat"])) && (empty($_GET["lon"])) && (empty($_GET["zoom"]))) { 

########## More points (day)
 @include"_config.php";


 $REQUESTED=$month;
 $CURRENT=Date("m");
 $CURRENTLAST=date("m", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );
 if (($CURRENT == $REQUESTED) || ($CURRENTLAST == $REQUESTED)) {
  $MySQL_table=$MySQL_table1;
 }
 else {
  $MySQL_table=$MySQL_table2;
 }

 $tracking_list_db = mysqli_query($spojenie,"SELECT * FROM $MySQL_table WHERE lat!='0.0' AND lon!='0.0' AND devicerpi='$devicerpi' AND time like '$year-$month-$day%' order by time asc");


 $tracking_list_db_row =  mysqli_num_rows ($tracking_list_db);
 if ($tracking_list_db_row < '15000') {
  $tracking_list_db = mysqli_query($spojenie,"SELECT * FROM $MySQL_table WHERE lat!='0.0' AND lon!='0.0' AND devicerpi='$devicerpi' AND time like '$year-$month-$day%' order by time asc");
 } 

 if ($tracking_list_db_row > '15001') {
  if ($tracking_list_db_row < '25000') {
   $tracking_list_db = mysqli_query($spojenie,"SELECT * FROM $MySQL_table WHERE lat!='0.0' AND lon!='0.0' AND devicerpi='$devicerpi' AND time like '$year-$month-$day%' AND id mod 2 = 0 order by time asc");
  }
 }

 if ($tracking_list_db_row > '25001') {
  if ($tracking_list_db_row < '32000') {
   $tracking_list_db = mysqli_query($spojenie,"SELECT * FROM $MySQL_table WHERE lat!='0.0' AND lon!='0.0' AND devicerpi='$devicerpi' AND time like '$year-$month-$day%' AND id mod 3 = 0 order by time asc");
  }
 }

 if ($tracking_list_db_row > '32001') {
  $tracking_list_db = mysqli_query($spojenie,"SELECT * FROM $MySQL_table WHERE lat!='0.0' AND lon!='0.0' AND devicerpi='$devicerpi' AND time like '$year-$month-$day%' AND id mod 5 = 0 order by time asc");
 }

 for ($i = 0; $i <= 1; $i++) {
  $entries = mysqli_fetch_array ($tracking_list_db);
  if ($entries == '0' ){
   $lat='48.700000';
   $lon='20.100000';
   $zoom='13';
  } else {
   $marker='var latLong = [
';


   for ($i = 1; $i <= $tracking_list_db_row; $i++) {
    $entries = mysqli_fetch_array ($tracking_list_db);
    if ((!empty($entries['lat'])) && (!empty($entries['lon']))) {

     $GET_LAT=substr($entries['lat'], 0, 6);
     $GET_LON=substr($entries['lon'], 0, 6);
     $miesto_db = mysqli_query($spojenie,"SELECT miesto FROM $MySQL_table3 WHERE lat like '$GET_LAT%' AND lon like '$GET_LON%' AND status='OK' LIMIT 1;");
     $miesto = mysqli_fetch_array ($miesto_db);
     if (!empty($miesto['miesto'])) {
      $miesto=$miesto['miesto'];
     } else {
      $miesto="- - -";
     }


     $direction='---';
     if (($entries['direction'] >   '0') and ($entries['direction'] <  '45' )) { $drection='S';}
     if (($entries['direction'] >  '46') and ($entries['direction'] < '125' )) { $direction='V';}
     if (($entries['direction'] > '126') and ($entries['direction'] < '225' )) { $direction='J';}
     if (($entries['direction'] > '226') and ($entries['direction'] < '275' )) { $direction='Z';}
     if (($entries['direction'] > '276') and ($entries['direction'] < '366' )) { $direction='S';}
#     $marker=$marker.' ["<b>TIME: '.$entries['time'].'</b><br> <b>Address</b>: '.$miesto.'<br>Speed: '.$entries['spd']*3.6.'km/h<br> Direction: '.$direction.' / '.$entries['direction'].'°<br> Position: '.$entries['lat'].' / '.$entries['lon'].' ('.$entries['alt'].'mnm)",'.$entries['lat'].','.$entries['lon'].'],


     $marker=$marker.' ["<b>TIME: '.$entries['time'].'</b><br> <b>Address</b>: '.$miesto.'<br><b>Speed:</b> '.$entries['spd']*3.6.'km/h<br><b>Direction:</b> '.$direction.' / '.$entries['direction'].'°<br><b>Position:</b> '.$entries['lat'].' / '.$entries['lon'].' ('.$entries['alt'].'mnm) <br><b>ID:</b> '.$entries['id'].'",'.$entries['lat'].','.$entries['lon'].'],
';
     if (($entries['lat'] == '0.000000') and ($entries['lon'] == '0.000000')) {
      $lat='48.700000';
      $lon='20.100000';
      $zoom='9';
     } else {
      $lat=$entries['lat'];
      $lon=$entries['lon'];
      $zoom='10';

     }
    }
   }
   $marker=$marker.' ["Default",0.000000,0.000000]
];';
  }
 }
} else {
########## One point
 $lat=$_GET["lat"];
 $lon=$_GET["lon"];
 $marker='var latLong = [ ["<b>Last position:</b> '.$lat.' / '.$lon.' <br><b>ID:</b> '.$id.'",'.$lat.','.$lon.'] ];';
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
 <title> OpenStreetMaps - Leaflet </title>
 <meta http-equiv="Expires" CONTENT="Sun, 12 May 2003 00:36:05 GMT">
 <meta http-equiv="Pragma" CONTENT="no-cache">
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <meta http-equiv="Cache-control" content="no-cache">
 <meta http-equiv="Content-Language" content="sk">
<!-- <meta http-equiv="refresh" content="60">-->
 <meta name="google-site-verification" content="GHY_X_yeijpdBowWr_AKSMWAT8WQ-ILU-Z441AsYG9A">
 <meta name="GOOGLEBOT" CONTENT="noodp">
 <meta name="pagerank" content="10">
 <meta name="msnbot" content="robots-terms">
 <meta name="msvalidate.01" content="B786069E75B8F08919826E2B980B971A">
 <meta name="revisit-after" content="2 days">
 <meta name="robots" CONTENT="index, follow">
 <meta name="alexa" content="100">
 <meta name="distribution" content="Global">
 <meta name="keywords" lang="en" content="osm, openstreetmaps, maps, leaflet">
 <meta name="description" content="OpenStreetMaps with Leaflet in Docker">
 <meta name="Author" content="ZTK-Comp WEBHOSTING">
 <meta name="copyright" content="(c) 2019 ZTK-Comp">
 <link rel="stylesheet" href="leaflet.css">
 <script type="text/javascript" src="leaflet.js"></script>

<script type="text/javascript">
//function countdown() {
//    var i = document.getElementById('counter');
//    if (parseInt(i.innerHTML)<=0) {
//        location.reload();
//    }
//if (parseInt(i.innerHTML)!=0) {
//    i.innerHTML = parseInt(i.innerHTML)-1;
//}
//}
//setInterval(function(){ countdown(); },1000);
</script>


</head>
<body bgcolor="black" text="white">
<?php

if (!empty($miesto)) {
 $miesto=$miesto;
} else {
 $miesto="- - -";
}


echo "<center>
<font color=\"red\"><b>Position:</b></font> ".$lat." / ".$lon."<br>
<font color=\"red\"><b>Address</b></font>: ".$miesto."<br>
<font color=\"red\"><b>Points:</b></font> ".$tracking_list_db_row." (total) <br>
<font color=\"red\"><b>Screen:</b></font> "?>
<script>
 document.write(window.innerWidth-"50"+"px x ");
 document.write(window.innerHeight-"200"+"px");
</script>
<br><font color="red"><b>Refresh:</b></font> <span id="counter">40</span> second(s).
<div id="status"></div>

<?php "</center> \n"; ?>

<table id="map" width="100"><td id="maph" height="100">
</td></table>

<script>
document.getElementById("map").width = window.innerWidth-"50";
document.getElementById("maph").height = window.innerHeight-"200";
</script>

<script type="text/javascript">
    map = L.map('map').setView([<?php echo $lat;?>, <?php echo $lon;?>], <?php echo $zoom;?>);
    L.tileLayer(
    <?php echo $MAPA;?>
    }).addTo(map);

    var popup = L.popup();
    function onMapClick(e) {
        popup
        .setLatLng(e.latlng)
        .setContent("<b>Your position on map</b> <br>" + "<b>Lat:</b> " + e.latlng.lat.toFixed(6) + "<br> <b>Lon:</b> " + e.latlng.lng.toFixed(6))
        .openOn(map);
    }
    map.on('click', onMapClick);


<?php echo $marker;?>

for (var i = 0; i < latLong.length; i++) {
    marker = new L.circle([latLong[i][1],latLong[i][2]], 5, {
    color: '#000000',
    fillColor: '#FF0000',
    fillOpacity: 3,
    radius: 1
    }).addTo(map).bindPopup(latLong[i][0]);
}

</script>

<?php
$mtime = explode(' ', microtime());
$totaltime = $mtime[0] + $mtime[1] - $starttime;
printf ('<font color="FF0000"> Stránka vygenerovaná za %.3f sekundy. </font>', $totaltime);
mysqli_close($spojenie);
?>
</body>
</html>

