<?php
define("DB_HOST", "localhost");
define("DB_USERNAME", "ztk_comp_sk");
define("DB_PASSWORD", "ZTK748596heslo");
define("DB_DATABASE_NAME", "ztk_comp_sk");

// Create connection
$spojenie = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);

// Check connection
if ($spojenie->connect_error) {
  die("Connection failed: " . $spojenie->connect_error);
}

@$MySQL_table0="gps_tracking_aircraft";
@$MySQL_table1="gps_tracking";
@$MySQL_table2="gps_tracking_archive";
@$MySQL_table3="gps_miesto";
@$MySQL_table4="gps_provider";
@$MySQL_table5="temp_hum";
@$MySQL_table6="gps_wifi_tracking";
@$MySQL_table7="bts_tracking";
#@$GAPIKEY="AIzaSyBbUyAXLgSso1QstQJTVw1LDN5e2Oj5kMI";
@$GAPIKEY="054b7c9fcae24adf9976f2e5b6982fa0";
@$TOKENIP="46215d5da4b4d7";
?>
