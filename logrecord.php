<?php

#$trip = array(
#	$_REQUEST['user'],
#	$_REQUEST['pass'],
#	$_REQUEST['DevBat'],
#	$_REQUEST['Gids'],
#	$_REQUEST['Lat'],
#	$_REQUEST['Long'],
#	$_REQUEST['Elv'],
#	$_REQUEST['Seq'],
#	$_REQUEST['Trip'],
#	$_REQUEST['Odo'],
#	$_REQUEST['SOC'],
#	$_REQUEST['AHr'],
#	$_REQUEST['BatTemp'],
#	$_REQUEST['Amb'],
#	$_REQUEST['Wpr'],
#	$_REQUEST['PlugState'],
#	$_REQUEST['ChrgMode'],
#	$_REQUEST['ChrgPwr'],
#	$_REQUEST['VIN'],
#	$_REQUEST['PwrSw'],
#	$_REQUEST['Tunits'],
#	$_REQUEST['RPM'],
#);

$user = $_REQUEST['user'];
$pass = $_REQUEST['pass'];
$DevBat = $_REQUEST['DevBat'];
$Gids = $_REQUEST['Gids'];
$Lat = $_REQUEST['Lat'];
$Long = $_REQUEST['Long'];
$Elv = $_REQUEST['Elv'];
$Seq = $_REQUEST['Seq'];
$Trip = $_REQUEST['Trip'];
$Odo = $_REQUEST['Odo'];
$SOC = $_REQUEST['SOC'];
$AHr = $_REQUEST['AHr'];
$BatTemp = $_REQUEST['BatTemp'];
$Amb = $_REQUEST['Amb'];
$Wpr = $_REQUEST['Wpr'];
$PlugState = $_REQUEST['PlugState'];
$ChrgMode = $_REQUEST['ChrgMode'];
$ChrgPwr = $_REQUEST['ChrgPwr'];
$VIN = $_REQUEST['VIN'];
$PwrSw = $_REQUEST['PwrSw'];
$Tunits = $_REQUEST['Tunits'];
$RPM = $_REQUEST['RPM'];

#$sendUrl = sprintf('http://api.myevstats.com?user=%s&pass=%s&DevBat=%s&Gids=%s&Lat=%s&Long=%s&Elv=%s&Seq=%s&Trip=%s&Odo=%s&SOC=%s&AHr=%s&BatTemp=%s&Amb=%s&Wpr=%s&PlugState=%s&ChrgMode=%s&ChrgPwr=%s&VIN=%s&PwrSw=%s&Tunits=%s&RPM=%s',
#$user, 'password', $DevBat, $Gids, '0', '0', '0', $Seq, $Trip, $Odo, $SOC, $AHr, $BatTemp, $Amb, $Wpr, $PlugState, $ChrgMode, $ChrgPwr, $VIN, $PwrSw, $Tunits, $RPM);

#$ch = curl_init($sendUrl);
#curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
#curl_setopt($ch, CURLOPT_HEADER, 0);

#curl_exec($ch);
#curl_close($ch);

$now = getdate();

#$fp = fopen('drivelog.csv', 'a');
#fputcsv($fp, $now);
#fwrite($fp, "URL for myevstats:\n");
#fwrite($fp, $sendUrl . "\n");
#fwrite($fp, "Query string:\n");
#fwrite($fp, $_SERVER['QUERY_STRING'] . "\n");

$dbsettings = parse_ini_file("../../leafspy.ini");
$mysqli = new mysqli($dbsettings['server'], $dbsettings['login'], $dbsettings['password'], $dbsettings['database']);
if($mysqli->connect_errno) {
	$fp = fopen('../drivelog.csv', 'a');
	fwrite($fp, "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error . PHP_EOL);
	fclose($fp);
}

$recordTime = $now['year'] . '-' . $now['mon'] . '-' . $now['mday'] . ' ' . $now['hours'] . ':' . $now['minutes'] . ':' . $now['seconds'];

$saveDB =sprintf("INSERT INTO `TripData`(`DateRecorded`, `User`, `BatteryPercent`, `Gids`, `Latitude`, `Longitude`, `Elevation`, `Sequence`, `Trip`, `Odometer`, `StateOfCharge`, `AmpHour`, `BatteryTemperature`, `AmbientTemperature`, `WiperStatus`, `PlugState`, `ChargeMode`, `ChargePower`, `VIN`, `PowerSwitch`, `TemperatureUnits`, `RPM`) VALUES ('%s','%s',%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,'%s',%s,'%s',%s)",
$recordTime, $user, $DevBat, $Gids, $Lat, $Long, $Elv, $Seq, $Trip, $Odo, $SOC, $AHr, $BatTemp, $Amb, $Wpr, $PlugState, $ChrgMode, $ChrgPwr, $VIN, $PwrSw, $Tunits, $RPM);

#fwrite($fp, "Database insert:\n");
#fwrite($fp, $saveDB . "\n\n");
#fclose($fp);

$mysqli->query($saveDB);

echo ('status:0');
?>
