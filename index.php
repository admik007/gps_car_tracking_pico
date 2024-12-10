<?php
if (empty($_GET["time"])) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
 <title> GPS logging and tracking </title>
 <link rel="SHORTCUT ICON" href="favicon.ico" type="image/x-icon">
 <meta http-equiv="Expires" CONTENT="Sun, 12 May 2003 00:36:05 GMT">
 <meta http-equiv="Pragma" CONTENT="no-cache">
 <meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
 <meta http-equiv="Cache-control" content="no-cache">
 <meta http-equiv="Content-Language" content="sk">
 <meta name="google-site-verification" content="GHY_X_yeijpdBowWr_AKSMWAT8WQ-ILU-Z441AsYG9A">
 <meta name="GOOGLEBOT" CONTENT="noodp">
 <meta name="pagerank" content="10">
 <meta name="msnbot" content="robots-terms">
 <meta name="msvalidate.01" content="B786069E75B8F08919826E2B980B971A">
 <meta name="revisit-after" content="2 days">
 <meta name="robots" CONTENT="index, follow">
 <meta name="alexa" content="100">
 <meta name="distribution" content="Global">
 <meta name="keywords" lang="sk" content="gps, logging, tracking">
 <meta name="description" content="Webpage for GPS logging">
 <meta name="Author" content="ZTK-Comp WEBHOSTING">
 <meta name="copyright" content="(c) 2015 ZTK-Comp">
 <link href="calendar.css" type="text/css" rel="stylesheet">
</head>
<body bgcolor="silver">

<?php
date_default_timezone_set('Europe/Bratislava');
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
 <title> GPS </title>
</head>
<body>
<?php
}

$starttime = explode(' ', microtime());
$starttime = $starttime[1] + $starttime[0];

$ip=$_SERVER["REMOTE_ADDR"]; 
@include"_config.php";


if (empty($_GET["day"])) $day=Date("d");
if (isset($_GET["day"])) $day=$_GET["day"];

if (empty($_GET["month"])) $month=Date("m");
if (isset($_GET["month"])) $month=$_GET["month"]; 

if (empty($_GET["year"])) $year=Date("Y");
if (isset($_GET["year"])) $year=$_GET["year"];

if (empty($_GET["hour"])) $hour=Date("H");
if (isset($_GET["hour"])) $hour=$_GET["hour"];

if (empty($_GET["minute"])) $minute=Date("i");
if (isset($_GET["minute"])) $minute=$_GET["minute"];

if (empty($_GET["second"])) $second=Date("s");
if (isset($_GET["second"])) $second=$_GET["second"];

if (isset($_GET["lat"])) $lat=$_GET["lat"];
if (isset($_GET["lon"])) $lon=$_GET["lon"];
if (isset($_GET["alt"])) $alt=round($_GET["alt"]);

if (empty($_GET["acc"])) $acc="10.0";
if (isset($_GET["acc"])) $acc=$_GET["acc"];

if (empty($_GET["spd"])) $spd="0";
if (isset($_GET["spd"])) $spd=$_GET["spd"];

if (empty($_GET["speed"])) $spd="0";
if (isset($_GET["speed"])) $spd=$_GET["speed"];


if (isset($_GET["sat"])) $sat=$_GET["sat"];

if (empty($_GET["bat"])) $bat="";
if (isset($_GET["bat"])) $bat=$_GET["bat"];

if (isset($_GET["time"])) { 
 $time=$_GET["time"];
 if (preg_match("/2004/", "$time")) {
  $time=$year."-".$month."-".$day."T".$hour.":".$minute.":".$second."Z";
 }

 if (preg_match("/2021/", "$time")) {
  $time=$year."-".$month."-".$day."T".$hour.":".$minute.":".$second."Z";
 }
}

if (empty($_GET["device"])) $device="";
if (isset($_GET["device"])) $device=$_GET["device"];

if (isset($_GET["devicerpi"])) $devicerpi=$_GET["devicerpi"];

if (empty($_POST["devicerpi"])) $_POST["devicerpi"]=$devicerpi;
if (isset($_POST["devicerpi"])) $devicerpi=$_POST["devicerpi"];


if (empty($_GET["provider"])) $provider="GPS";
if (isset($_GET["provider"])) $provider=$_GET["provider"];

if (empty($_GET["direction"])) $direction="0.0";
if (isset($_GET["direction"])) $direction=$_GET["direction"];

if (empty($_GET["dir"])) $direction="0.0";
if (isset($_GET["dir"])) $direction=$_GET["dir"];

if (empty($_GET["temprpi"])) $temprpi="";
if (isset($_GET["temprpi"])) $temprpi=$_GET["temprpi"];

if (empty($_GET["loadrpi"])) $loadrpi="";
if (isset($_GET["loadrpi"])) $loadrpi=$_GET["loadrpi"];



### BTS RELATED
if (empty($_GET["MCC"])) $mcc="";
if (isset($_GET["MCC"])) $mcc=$_GET["MCC"];

if (empty($_GET["MNC"])) $mnc="";
if (isset($_GET["MNC"])) $mnc=$_GET["MNC"];

if (empty($_GET["BSIC"])) $bsic="";
if (isset($_GET["BSIC"])) $bsic=$_GET["BSIC"];

if (empty($_GET["CELLID"])) $cellid="";
if (isset($_GET["CELLID"])) $cellid=$_GET["CELLID"];

if (empty($_GET["LAC"])) $lac="";
if (isset($_GET["LAC"])) $lac=$_GET["LAC"];
### BTS RELATED

if (!empty($_GET["time"])) {
 $timeT=str_replace("T","\T",$time);
 $timeZ=str_replace("Z","\Z",$timeT);
 $epoch= strtotime (gmdate($timeZ));
 date_default_timezone_set("Europe/Bratislava");
 $time=date ('Y-m-d\TH:i:s\Z',$epoch);

 switch ($devicerpi) {
  case "000000001ff7c174":
   $device='NODE01';
   break;

  case "00000000XXXXXXX2":
   $device='NODE02';
   break;

  case "00000000XXXXXXX3":
   $device='NODE03';
   break;

  case "00000000b9a53cd6":
   $device='NODE04';
   break;

  case "0000000000000004":
   $device='NODE05';
   break;

  case "00000000c8490d90":
   $device='NODE06';
   break;

  case "00000000c545db48":
   $device='NODE07';
   break;

  case "000000000fc36336":
   $device='NODE08';
   break;

  case "00000000279ea942":
   $device='NODE09';
   break;

  case "00000000ac48fd74":
   $device='NODE10';
   break;

  case "00000000XXXXXX11":
   $device='NODE11';
   break;

  case "00000000XXXXXX12":
   $device='NODE12';
   break;

  case "00000000d43572d2":
   $device='NODE13';
   break;

  case "00000000897db5d7":
   $device='NODE14';
   break;

  case "0000000051dbb57b":
   $device='NODE15';
   break;


  case "e661640843228b25":
   $device='RPIPC01';
   break;

  case "e6616408436a6d21":
   $device='RPIPC02';
   break;

  case "e6614c311b817339":
   $device='RPIPC03';
   break;

  case "e6614c311b956c39":
   $device='RPIPC04';
   break;

  case "e661640843632921":
   $device='RPIPC05';
   break;

  case "e66164084360a42e":
   $device='RPIPC06';
   break;

  case "e6616408432e7829":
   $device='RPIPC07';
   break;

  case "e6616408438f952e":
   $device='RPIPC08';
   break;

  case "e66164084387252d":
   $device='RPIPC09';
   break;

  case "e661385283997828":
   $device='RPIPC10';
   break;


  case "MAPA":
   $device='MAPA';
   break;

  case "MAPA2":
   $device='MAPA2';
   break;

#  default:
#   $device=' UNKNOWN';
 }


 $DEVI=strstr( $devicerpi, "000000" );

 if (($ip == '176.10.42.177') OR ($ip == '5.75.148.0') OR ($ip == '2a01:4f8:1c1b:699c::1') OR ($ip == '94.130.228.164') OR ($ip == '2a01:4f8:1c1c:9ce::1')){
  list($DATE, $TIME) = explode("T", $time);
  echo "D: $DATE <br>\n";
  echo "T: $TIME <br>\n";
  $TIME=trim($TIME, "Z");
  list($year, $month, $day) = explode("-", $DATE);
  list($hour, $minute, $second) = explode(":", $TIME);
  echo "$year $month $day $hour $minute $second <br>\n<br>\n";
 }

 mysqli_query($spojenie,"INSERT INTO $MySQL_table1 VALUES('0','$lat','$lon','$alt','$acc','$spd','$sat','$time','$bat','$ip','$year','$month','$day','$hour','$minute','$second','$device','$provider','$direction','$devicerpi','$temprpi','$loadrpi')");
 echo " DeviceRPI: ".$devicerpi."<br>\n";
 echo " Device:    ".$device."<br>\n";
# echo " Zapisane:  ".$time."<br>\n";
# echo " TimeT:     ".$timeT."<br>\n";
# echo " TimeZ:     ".$timeZ."<br>\n";
 echo " MySQL done - NODE<br><br>";


########## BTS RELATED ##########
 if ($mcc != "") {
  $bts_total = mysqli_query($spojenie,"SELECT * FROM $MySQL_table7 WHERE mcc='$mcc' AND mnc='$mnc' AND cellid='$cellid'");
  $bts_total_count = mysqli_num_rows ($bts_total);
  if ($bts_total_count == '0') {
   mysqli_query($spojenie,"INSERT INTO $MySQL_table7 VALUES('0','$lat','$lon','$alt','$time','$device','$mcc','$mnc','$bsic','$cellid','$lac','|no info|GSM')");
   echo "INSERT INTO $MySQL_table7 VALUES('0','$lat','$lon','$alt','$time','$device','$mcc','$mnc','$bsic','$cellid','$lac','|no info|GSM')<br>";
   echo "BTS ADDED<br>";
  } else {
   $bts_total_data=mysqli_fetch_array ($bts_total, MYSQLI_ASSOC);

   if ($bts_total_data['lat']  == 0.000000) {
    mysqli_query($spojenie,"UPDATE $MySQL_table7 SET lat='$lat' WHERE mcc='$mcc' AND mnc='$mnc' AND cellid='$cellid'");
    mysqli_query($spojenie,"UPDATE $MySQL_table7 SET time='$time' WHERE mcc='$mcc' AND mnc='$mnc' AND cellid='$cellid'");
    echo "LAT UPDATED<br>";
   } 

   if ($bts_total_data['lon']  == 0.000000) {
    mysqli_query($spojenie,"UPDATE $MySQL_table7 SET lon='$lon' WHERE mcc='$mcc' AND mnc='$mnc' AND cellid='$cellid'");
    mysqli_query($spojenie,"UPDATE $MySQL_table7 SET time='$time' WHERE mcc='$mcc' AND mnc='$mnc' AND cellid='$cellid'");
    echo "LON UPDATED<br>";
   }

   if ($bts_total_data['alt']  != $alt) {
    mysqli_query($spojenie,"UPDATE $MySQL_table7 SET alt='$alt' WHERE mcc='$mcc' AND mnc='$mnc' AND cellid='$cellid'");
    mysqli_query($spojenie,"UPDATE $MySQL_table7 SET time='$time' WHERE mcc='$mcc' AND mnc='$mnc' AND cellid='$cellid'");
    echo "ALT UPDATED<br>";
   }

   if ($bts_total_data['lac']  != $lac) {
    mysqli_query($spojenie,"UPDATE $MySQL_table7 SET lac='$lac' WHERE mcc='$mcc' AND mnc='$mnc' AND cellid='$cellid'");
    mysqli_query($spojenie,"UPDATE $MySQL_table7 SET time='$time' WHERE mcc='$mcc' AND mnc='$mnc' AND cellid='$cellid'");
    echo "LAC UPDATED<br>";
   }
  }
 }
########## BTS RELATED ##########

} else {

 $REQUESTED=$month;
 $CURRENT=Date("m");
 $CURRENTLAST=date("m", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-0 month" ) );
 if (($CURRENT == $REQUESTED) || ($CURRENTLAST == $REQUESTED)) {
  $MySQL_table=$MySQL_table1;
 }
 else {
  $MySQL_table=$MySQL_table2;
 }
#$MySQL_table=$MySQL_table.'_KE482LM';
#echo "$MySQL_table";

 $tracking_list_db_total = mysqli_query($spojenie,"SELECT * FROM $MySQL_table WHERE devicerpi='$devicerpi' AND time like '$year-$month-$day%' order by time asc");
 $tracking_list_db_row_total = mysqli_num_rows ($tracking_list_db_total);




 if ($tracking_list_db_row_total < '1500') {
#  $tracking_list_db = mysqli_query($spojenie,"SELECT * FROM $MySQL_table WHERE devicerpi='$devicerpi' AND lat not like '0.0%' AND time like '$year-$month-$day%' GROUP BY DATE_FORMAT(`time`, '%H:%i:%s') order by time desc");
  $tracking_list_db = mysqli_query($spojenie,"SELECT * FROM $MySQL_table WHERE devicerpi='$devicerpi' AND time like '$year-$month-$day%' GROUP BY DATE_FORMAT(`time`, '%H:%i:%s') order by time desc");
 }

 if ($tracking_list_db_row_total > '1501') {
  if ($tracking_list_db_row_total < '2500') {
#   $tracking_list_db = mysqli_query($spojenie,"SELECT * FROM $MySQL_table WHERE devicerpi='$devicerpi' AND lat not like '0.0%' AND time like '$year-$month-$day%' GROUP BY DATE_FORMAT(`time`, '%H:%i') order by time desc");
   $tracking_list_db = mysqli_query($spojenie,"SELECT * FROM $MySQL_table WHERE devicerpi='$devicerpi' AND time like '$year-$month-$day%' GROUP BY DATE_FORMAT(`time`, '%H:%i') order by time desc");
  }
 }

 if ($tracking_list_db_row_total > '2501') {
  if ($tracking_list_db_row_total < '3200') {
#   $tracking_list_db = mysqli_query($spojenie,"SELECT * FROM $MySQL_table WHERE devicerpi='$devicerpi' AND lat not like '0.0%' AND time like '$year-$month-$day%' AND id mod 3 = 0 GROUP BY DATE_FORMAT(`time`, '%H:%i') order by time desc");
   $tracking_list_db = mysqli_query($spojenie,"SELECT * FROM $MySQL_table WHERE devicerpi='$devicerpi' AND time like '$year-$month-$day%' AND id mod 3 = 0 GROUP BY DATE_FORMAT(`time`, '%H:%i') order by time desc");
  }
 }

 if ($tracking_list_db_row_total > '3201') {
#  $tracking_list_db = mysqli_query($spojenie,"SELECT * FROM $MySQL_table WHERE devicerpi='$devicerpi' AND lat not like '0.0%' AND time like '$year-$month-$day%' AND id mod 5 = 0 GROUP BY DATE_FORMAT(`time`, '%H:%i') order by time desc");
  $tracking_list_db = mysqli_query($spojenie,"SELECT * FROM $MySQL_table WHERE devicerpi='$devicerpi' AND time like '$year-$month-$day%' AND id mod 5 = 0 GROUP BY DATE_FORMAT(`time`, '%H:%i') order by time desc");
 }




# $tracking_list_db = mysqli_query($spojenie,"SELECT * FROM $MySQL_table WHERE device='$device' AND lat != '0.0' AND time like '$year-$month-$day%' GROUP BY DATE_FORMAT(`time`, '%H:%i') order by time desc");
# $tracking_list_db = mysqli_query($spojenie,"SELECT * FROM $MySQL_table WHERE device='$device' AND lat != '0.0' AND time like '$year-$month-$day%' GROUP BY DATE_FORMAT(`time`, '%H:%i:%s') order by time desc");
# $tracking_list_db = mysqli_query($spojenie,"SELECT * FROM $MySQL_table WHERE device='$device' AND time like '$year-$month-$day%' GROUP BY DATE_FORMAT(`time`, '%H:%i') order by time desc");
 $tracking_list_db_row = mysqli_num_rows ($tracking_list_db);

 $tracking_list_db_devicesrpi = mysqli_query($spojenie,"SELECT DISTINCT(devicerpi) FROM $MySQL_table WHERE devicerpi != '' AND time like '$year-$month-$day%' order by device asc");
 $tracking_list_db_devicesrpi_row = mysqli_num_rows ($tracking_list_db_devicesrpi);

 $tracking_list_db_devicesrpi_total = mysqli_query($spojenie,"SELECT DISTINCT(devicerpi) FROM $MySQL_table WHERE devicerpi != '' order by device");
 $tracking_list_db_devicesrpi_total_row = mysqli_num_rows ($tracking_list_db_devicesrpi_total);





if ( $devicerpi == '' ) {
 $selected_devicerpi=" >>> Vyberte si zariadenie <<< ";
} else {
 $selected_devicerpi = " >>> Vybrane: ".$devicerpi." <<< ";
}


echo "<table border=\"0\" width=\"260\" align=\"center\">
 <tr>
  <td align=\"center\">
   <form method=\"post\" action=\"index.php?year=".$year."&amp;month=".$month."&amp;day=".$day."&amp;devicerpi=".$devicerpi."\">
    <select name=\"devicerpi\">
     <option value=\"".$devicerpi."\" selected> ".$selected_devicerpi."</option>
";

 for ($i = 1; $i <= $tracking_list_db_devicesrpi_row; $i++) {
  $devicerpientries = mysqli_fetch_array($tracking_list_db_devicesrpi, MYSQLI_ASSOC);
  $devicerpiinfo=$devicerpientries["devicerpi"];

  $devicerpientries_details = mysqli_query($spojenie,"SELECT device FROM $MySQL_table WHERE devicerpi='$devicerpiinfo' LIMIT 1");
  $devrpientries = mysqli_fetch_array ($devicerpientries_details, MYSQLI_ASSOC);
  $devrpiinfo = $devrpientries["device"];


   echo "     <option value=\"".$devicerpiinfo."\"> ".$i." ".$devrpiinfo." - ".$devicerpiinfo." </option>
"; 
}

echo "    </select>
    <input type=\"submit\" value=\"Potvrdit\">
   </form>
  </td>
 </tr>
 <tr>
  <td align=\"center\">
   <a href=\"http://".$_SERVER["SERVER_NAME"]."/osm.php?year=$year&amp;month=$month&amp;day=$day&amp;devicerpi=$devicerpi\" target=\"_blank\" style=\"text-decoration:none\"><b>Zobraz mapu</b> ($tracking_list_db_row) / ($tracking_list_db_row_total)</a><br>
   <a href=\"http://".$_SERVER["SERVER_NAME"]."/export.php?year=$year&amp;month=$month&amp;day=$day&amp;devicerpi=$devicerpi\" target=\"_blank\" style=\"text-decoration:none\"><b>Export Excel</a><br>
</table>\n\n";

############################################
################# KALENDAR #################
############################################
class Calendar {
    /**
     * Constructor
     */
    public function __construct(){
        $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
    }
    /********************* PROPERTY ********************/
    public $dayLabels = array("Pon","Uto","Str","Štv","Pia","Sob","Ned");
    public $currentYear=0;
    public $currentMonth=0;
    public $currentDay=0;
    public $currentDate=null;
    public $daysInMonth=0;
    public $naviHref= null;

    /********************* PUBLIC **********************/
    /**
    * print out the calendar
    */
    public function show() {
        $year  = null;
        $month = null;
        $day = null;
        if(null==$year&&isset($_GET['year'])){
            $year = $_GET['year'];
        }else if(null==$year){
            $year = date("Y",time());
        }

        if(null==$month&&isset($_GET['month'])){
            $month = $_GET['month'];
        }else if(null==$month){
            $month = date("m",time());
        }

        if(null==$day&&isset($_GET['day'])){
            $day = $_GET['day'];
        }else if(null==$day){
            $day = date("d",time());
        }

        $this->currentYear=$year;
        $this->currentMonth=$month;
        $this->daysInMonth=$this->_daysInMonth($month,$year);
        $content='<div id="calendar">'.
                        '<div class="box">'.
                        $this->_createNavi().
                        '</div>'.
                        '<div class="box-content">'.
                                '<ul class="label">'.$this->_createLabels().'</ul>';
                                $content.='<div class="clear"></div>';
                                $content.='<ul class="dates">';

                                $weeksInMonth = $this->_weeksInMonth($month,$year);
                                // Create weeks in a month
                                for( $i=0; $i<$weeksInMonth; $i++ ){
                                    //Create days in a week
                                    for($j=1;$j<=7;$j++){
                                        $content.=$this->_showDay($i*7+$j);
                                    }
                                }
                                $content.='</ul>';
                                $content.='<div class="clear"></div>';
                        $content.='</div>';
        $content.='</div>';
        return $content;
    }
    /********************* PRIVATE **********************/
    /**
    * create the li element for ul
    */
    public function _showDay($cellNumber){
        $year  = null;
        $month = null;
        $day = null;
        if(null==$year&&isset($_GET['year'])){
            $year = $_GET['year'];
        }else if(null==$year){
            $year = date("Y",time());
        }

        if(null==$month&&isset($_GET['month'])){
            $month = $_GET['month'];
        }else if(null==$month){
            $month = date("m",time());
        }


        if(null==$day&&isset($_GET['day'])){
            $day = $_GET['day'];
        }else if(null==$day){
            $day = date("d",time());
        }

        $this->selectedDAY=$day;
        if($this->currentDay==0){
            $firstDayOfTheWeek = date('N',strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));
            if(intval($cellNumber) == intval($firstDayOfTheWeek)){
                $this->currentDay=1;
            }
        }
        if( ($this->currentDay!=0)&&($this->currentDay<=$this->daysInMonth) ){
            $this->currentDate = date('Y-m-d',strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay)));
            $cellContent = $this->currentDay;
	    if ($cellContent < 10) {
	         $cellContent = '0'.$cellContent;
	    }

            $this->currentDay++;
        }else{
            $this->currentDate =null;
            $cellContent=null;
        }
	/* Here is list of days */
        $todayday = date('d');
        $todayYmd = date('Ymd');


        if ($cellContent == $todayday) {
         $bgcolor="style=\"background: red!important\"";
        } else {
         $bgcolor="style=\"background: silver!important\"";
        }

        if ($cellContent == $this->selectedDAY) {
         $bgcolor="style=\"background: lightgreen!important\"";
        }

        return '<li '.$bgcolor.'> <a href="?year='.$this->currentYear.'&amp;month='.$this->currentMonth.'&amp;day='.$cellContent.'&amp;devicerpi='.$this->devicerpi.'">'.$cellContent.'</a> </li>
';
    }
    /**
    * create navigation
    */
    public function _createNavi(){
        $devicerpi = $_POST['devicerpi'];
        $this->devicerpi=$devicerpi;
        $nextMonth = $this->currentMonth==12?1:intval($this->currentMonth)+1;
        $nextYear = $this->currentMonth==12?intval($this->currentYear)+1:$this->currentYear;
        $preMonth = $this->currentMonth==1?12:intval($this->currentMonth)-1;
        $preYear = $this->currentMonth==1?intval($this->currentYear)-1:$this->currentYear;
        return
	/* Calendar menu */
            '<div class="header">'.
                '<a class="prev" href="'.$this->naviHref.'?month='.sprintf('%02d',$preMonth).'&amp;year='.$preYear.'&amp;devicerpi='.$this->devicerpi.'"> <<< </a>'.
                '<span class="title"><a href=".">'.date('Y M',strtotime($this->currentYear.'-'.$this->currentMonth.'-1')).' '.date('d').' '.date('H:i').'</a></span>'.
                '<a class="next" href="'.$this->naviHref.'?month='.sprintf("%02d", $nextMonth).'&amp;year='.$nextYear.'&amp;devicerpi='.$this->devicerpi.'"> >>> </a>'.
            '</div>';
    }
    /**
    * create calendar week labels
    */
    public function _createLabels(){
        $content='';
        foreach($this->dayLabels as $index=>$label){
            $content.='<li class="'.($label==6?'end title':'start title').' title">'.$label.'</li>';
        }
        return $content;
    }
    /**
    * calculate number of weeks in a particular month
    */
    public function _weeksInMonth($month=null,$year=null){
        if( null==($year) ) {
            $year =  date("Y",time());
        }
        if(null==($month)) {
            $month = date("m",time());
        }
        // find number of days in this month
        $daysInMonths = $this->_daysInMonth($month,$year);
        $numOfweeks = ($daysInMonths%7==0?0:1) + intval($daysInMonths/7);
        $monthEndingDay= date('N',strtotime($year.'-'.$month.'-'.$daysInMonths));
        $monthStartDay = date('N',strtotime($year.'-'.$month.'-01'));
        if($monthEndingDay<$monthStartDay){
            $numOfweeks++;
        }
        return $numOfweeks;
    }
    /**
    * calculate number of days in a particular month
    */
    public function _daysInMonth($month=null,$year=null){
        if(null==($year))
            $year =  date("Y",time());
        if(null==($month))
            $month = date("m",time());
        return date('t',strtotime($year.'-'.$month.'-01'));
    }
}
$calendar = new Calendar();
echo $calendar->show();
############################################
################# KALENDAR #################
############################################

function distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 5) {
$degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));
$distance = $degrees * 111.13384; // 1 degree = 111.13384 km, based on the average diameter of the Earth (12,735 km)
return round($distance, $decimals);
}

 $WEB_HEADER="
<table align=\"center\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\">
 <tr>
  <td bgcolor=\"#000000\"><font color=\"00FAAA\"><b>ID</b></font></td>
  <td bgcolor=\"#000000\"><font color=\"00FAAA\"><b>Súradnice</b></font></td>
  <td bgcolor=\"#000000\"><font color=\"00FAAA\"><b>Nadm. výška</b></font></td>
  <td bgcolor=\"#000000\"><font color=\"00FAAA\"><b>Rýchlosť</b></font></td>
  <td bgcolor=\"#000000\"><font color=\"00FAAA\"><b>Smer</b></font></td>
  <td bgcolor=\"#000000\"><font color=\"00FAAA\"><b>Satelity</b></font></td>
  <td bgcolor=\"#000000\"><font color=\"00FAAA\"><b>Čas</b></font></td>
  <td bgcolor=\"#000000\"><font color=\"00FAAA\"><b>IP</b></font></td>
  <td bgcolor=\"#000000\"><font color=\"00FAAA\"><b>Miesto</b></font></td>
  <td bgcolor=\"#000000\"><font color=\"00FAAA\"><b>ŠPZ</b></font></td>
  <td bgcolor=\"#000000\"><font color=\"00FAAA\"><b>Bateria</b></font></td>
<!---  <td bgcolor=\"#000000\"><font color=\"00FAAA\"><b>Load</b></font></td> --->
 </tr>
";
 $WEB_MIDDLE="";
 $WEB_FOOTER="</table>\n\n";

$lon_last=0;
$lat_last=0;
$KM=0;
$km_st=0;

 for ($i = 1; $i <= $tracking_list_db_row; $i++) {
  $entries = mysqli_fetch_array ($tracking_list_db, MYSQLI_ASSOC);

  $direction='---';
  if (($entries['direction'] >   '0') and ($entries['direction'] <  '45' )) { $drection='S';}
  if (($entries['direction'] >  '46') and ($entries['direction'] < '125' )) { $direction='V';}
  if (($entries['direction'] > '126') and ($entries['direction'] < '225' )) { $direction='J';}
  if (($entries['direction'] > '226') and ($entries['direction'] < '275' )) { $direction='Z';}
  if (($entries['direction'] > '276') and ($entries['direction'] < '366' )) { $direction='S';}

  $bgmiesto='#ffffff';

############################################
############## GPS TO ADDRESS ##############
############################################
  $GET_LAT=substr($entries['lat'], 0, 7);
  $GET_LON=substr($entries['lon'], 0, 7);
  $MIESTO_DB=mysqli_query($spojenie,"SELECT miesto FROM $MySQL_table3 WHERE lat like '$GET_LAT%' and lon like '$GET_LON%' AND status='OK' LIMIT 1;");
  $MIESTO_DB_ROW = mysqli_num_rows ($MIESTO_DB);
  if ($MIESTO_DB_ROW == "1" ) {
   $MIESTO=mysqli_fetch_array ($MIESTO_DB, MYSQLI_ASSOC);
   $miesto=$MIESTO['miesto'];
  } else {
   $url="https://api.geoapify.com/v1/geocode/reverse?type=street&format=xml&lat=".$entries['lat']."&lon=".$entries['lon']."&apiKey=".$GAPIKEY;
   $myfile = fopen("get_url.txt", "a");
   fwrite($myfile, $url."\n");
   fclose($myfile);
   $miesto="<a href=\"".$url."\" target=\"_blank\">no data</a>";
  }

############################################
############## GPS TO ADDRESS ##############
############################################

############################################
############## IP TO PROVIDER ##############
############################################
  $IP=$entries['ip'];
#  $ispprovider = json_decode(file_get_contents("http://ipinfo.io/{$IP}"));

#  $ISP_DB=mysqli_query($spojenie,"SELECT provider FROM $MySQL_table4 WHERE ip='$IP' LIMIT 1;");
#  $ISP_DB_ROW = mysqli_num_rows ($ISP_DB);
#  if ($ISP_DB_ROW == "1" ) {
#   $ISP=mysqli_fetch_array ($ISP_DB, MYSQLI_ASSOC);
#   $ispprovider=$ISP['provider'];
#  } else {
#   $ispprovider = json_decode(file_get_contents("http://ipinfo.io/{$IP}"));
#   echo "INSERT INTO $MySQL_table4 VALUES('0','$IP','$ispprovider'); <br>";
#   mysqli_query($spojenie,"INSERT INTO $MySQL_table4 VALUES('0','$IP','$ispprovider');");
#  }
############################################
############## IP TO PROVIDER ##############
############################################
  if ($entries['provider'] == 'network') { $bgmiesto='#f0f000'; }
  if ($entries['bat'] < '20') { $bgmiesto='#ff8000';}
  if ($entries['bat'] < '10') { $bgmiesto='#ff0000';}
  if ($entries['bat'] == '') { $bgmiesto='';}

#  $SPD=$entries['spd']*3.6;
  $SPD=substr($entries['spd'],0,2);
  if ($SPD < '3') {$SPD='0';}

  $point1 = array("lat" => $lat_last, "long" => $lon_last);
  $point2 = array("lat" => $entries['lat'], "long" => $entries['lon']);
  if ($KM == "0") {
   $km = 0;
   $km_st = distanceCalculation($point1['lat'], $point1['long'], $point2['lat'], $point2['long']);
   $km2 = distanceCalculation($point1['lat'], $point1['long'], $point2['lat'], $point2['long']);
  } else {
   $km = distanceCalculation($point1['lat'], $point1['long'], $point2['lat'], $point2['long']);
   $km2 = distanceCalculation($point1['lat'], $point1['long'], $point2['lat'], $point2['long']);
  }

  $lat_last=$entries['lat'];
  $lon_last=$entries['lon'];

  $SPZ=$entries['device'];

if ($entries['lat'] == '0.000000' ){
 $POS=round($entries['lat'],4).' / '.round($entries['lon'],4);
} else {
 $POS='<a href="osm.php?id='.$entries['id'].'&amp;lat='.$entries['lat'].'&amp;lon='.$entries['lon'].'&amp;zoom=18" target="_blank" style="text-decoration:none">'.round($entries['lat'],4).' / '.round($entries['lon'],4).'</a>';
}

 switch ($devicerpi) {
  case "e661385283997828":
   $SPZ="KE978IE";
   break;
  case "e6616408438f952e":
   $SPZ="KE482LM";
   break;
  case "e66164084387252d":
   $SPZ="AA116LJ";
   break;
}


  $WEB_MIDDLE=$WEB_MIDDLE.' <tr>
  <td bgcolor="'.$bgmiesto.'">'.$i.'</td>
  <td bgcolor="'.$bgmiesto.'">'.$POS.'</td>
  <td bgcolor="'.$bgmiesto.'">'.round($entries['alt'],3).' m.n.m.</td>
  <td bgcolor="'.$bgmiesto.'" >'.round($SPD,2).' km/h</td>
  <td bgcolor="'.$bgmiesto.'" align="center">'.$direction.'</td>
  <td bgcolor="'.$bgmiesto.'" align="center">'.$entries['sat'].'</td>
  <td bgcolor="'.$bgmiesto.'">'.$entries['time'].'</td>
  <td bgcolor="'.$bgmiesto.'">'.$entries['ip'].'</td>
  <td bgcolor="'.$bgmiesto.'">'.$miesto.'</td>
  <td bgcolor="'.$bgmiesto.'">'.$SPZ.'</td>
  <td bgcolor="'.$bgmiesto.'">'.$entries['bat'].'</td>
<!---  <td bgcolor="'.$bgmiesto.'">'.$entries['loadrpi'].'</td> --->
 </tr>
'; 

  $KM=$KM+$km2;
 }
 echo $WEB_HEADER.$WEB_MIDDLE.$WEB_FOOTER;
 echo '<p align="center">
<a href="http://validator.w3.org/check?uri=referer" target="_blank">
 <img src="http://www.w3.org/Icons/valid-html401" alt="Valid HTML 4.01 Transitional" height="31" width="88" border="0">
</a> <br>
';


 echo "<font color=\"000DDA\"> Priblížne prejazdené km: ".round(($KM - $km_st),2)." </font> <br>
";

 $mtime = explode(' ', microtime());
 $totaltime = $mtime[0] + $mtime[1] - $starttime;
 printf ('<font color="000DDA"> Stránka vygenerovaná za %.3f sekundy. </font>', $totaltime);
}

mysqli_close($spojenie);
?>

</body>
</html>
