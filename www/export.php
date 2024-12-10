<?php
if (empty($_GET["day"])) $day=Date("d");
if(isset($_GET["day"])) $day=$_GET["day"];

if (empty($_GET["month"])) $month=Date("m");
if(isset($_GET["month"])) $month=$_GET["month"];

if (empty($_GET["year"])) $year=Date("Y");
if(isset($_GET["year"])) $year=$_GET["year"];

if (empty($_GET["device"])) $device='SL514BS';
if(isset($_GET["devicerpi"])) $devicerpi=$_GET["devicerpi"];



@include"_config.php";
$file_name = "${device}_${year}.${month}.${day}";         //File Name
$file_extension = "xls";
$sep = "\t"; //tabbed character

//create MySQL connection   
$result = mysqli_query($spojenie,"SELECT ROUND($MySQL_table1.lat,4) AS Latitude, ROUND($MySQL_table1.lon,4) AS Longiture, alt AS 'Nadmorska vyska', spd AS Rychlost, sat AS Satelitov, ip AS IP, replace(replace(time, 'Z', ''),'T',' ') AS 'Datum a Cas', device AS SPZ, direction AS Smer, $MySQL_table3.miesto AS Adresa FROM $MySQL_table1 INNER JOIN $MySQL_table3 ON ROUND($MySQL_table1.lat,4)=$MySQL_table3.lat WHERE devicerpi='$devicerpi' AND time like '$year-$month-$day%' GROUP BY DATE_FORMAT(`time`, '%H:%i') order by time desc");


//header info for browser
header('Content-Encoding: UTF-8');
header("Content-Type: application/xls"); 
header("Content-Disposition: attachment; filename=\"$file_name.$file_extension\"");
header("Pragma: no-cache");
header("Expires: 0");

// start of printing column names as names of MySQL fields

print( "Latitude" . $sep );
print( "Longiture" . $sep );
print( "Nadmorska vyska" . $sep );
print( "Rychlost" . $sep );
print( "Satelitov" . $sep );
print( "IP" . $sep );
print( "Datum a Cas" . $sep );
print( "SPZ" . $sep );
print( "Smer" . $sep );
print( "Adresa" . $sep );
print( "\n" );
// end of printing column names

#/*******Start of Formatting for Excel*******/   
//start while loop to get data
while($row = mysqli_fetch_row($result)) {
 $schema_insert = "";
 for($j=0; $j<mysqli_num_fields($result);$j++)  {
  if(!isset($row[$j]))
   $schema_insert .= "NULL".$sep;
  elseif ($row[$j] != "")
   $schema_insert .= "$row[$j]".$sep;
  else
   $schema_insert .= "".$sep;
 }
 $schema_insert = str_replace($sep."$", "", $schema_insert);
 $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
 $schema_insert .= "\t";
 print(trim($schema_insert));
 print "\n";
}   
mysqli_close($spojenie);
?>

