<?php

session_start();

$weeks = 3;

if (isset($_GET['weeks'])) {
	$weeks = intval($_GET['weeks']);
}



$date = getdate();
$month = $date['mon'];
$year = $date['year'];
$helper = array("Hétfo" => 0, "Kedd" => 1, "Szerda" => 2, "Csütörtök" => 3, "Péntek" => 4);

$felev = true;

if ($month > 6) {
	$tanev = "tanev" . substr(strval($year),2) . substr(strval($year+1),2);
}
else
{
	$tanev = "tanev" . substr(strval($year-1),2) . substr(strval($year),2);
	$felev = false;
}

$data = file_get_contents('https://www.elte.hu/kozerdeku/tanev-rendje');

if ($felev) {
	$f = strpos($data,"Első nap");
	// echo $f;
	$t = strpos($data,"szeptember",$f);
	$day = intval(substr($data, $t+10,3));

	$date = date_create($year . "-09-" . $day);
}
else
{
	$f = strpos($data,"II.");
	$f = strpos($data,"Első nap",$f+10);
	$t = strpos($data,"február",$f);
	$day = intval(substr($data, $t+8,3));
	$date = date_create($year . "-02-" . $day);
}

// print_r($date);

// echo date_format($date,"Y/m/d");

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="export.csv"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');

echo "Subject,Start Date,Start Time,End Date,End Time,Description,Location\n";

foreach ($_SESSION as $rk => $row) 
{

	if(!$row['vis'])
	{
		continue;
	}

	$curDate = clone $date;

	$offset = $helper[$row['day']];

	$curDate->modify("+" . $offset . " day");
	$time = $row['time'];

	$from = split("-", $time)[0];
	$hour = intval(split(":",$from)[0]);
	$min = split(":",$from)[1];
	$from = ($hour >= 12) ? ($hour % 12) . ":" . $min . " PM" : $hour . ":" . $min . " AM";
	$to = split("-", $time)[1];
	$hour = intval(split(":",$to)[0]);
	$min = split(":",$to)[1];
	$to = ($hour >= 12) ? ($hour % 12) . ":" . $min . " PM" : $hour . ":" . $min . " AM";

	$room = $row['room'];

	$room = str_replace("Déli Tömb", "D", $room);
	$room = str_replace("Északi Tömb", "É", $room);

	for ($i=0; $i < $weeks; $i++) 
	{ 
		echo str_replace(",", " ", $row['subject']);
		echo ",";
		echo date_format($curDate,"m/d/Y");
		echo ",";
		echo $from;
		echo ",";
		echo date_format($curDate,"m/d/Y");
		echo ",";
		echo $to;
		echo ",";
		echo $row['teacher'];
		echo ",";
		echo $room;
		echo "\n";
		$curDate->modify("+7 day");
	}
}


?>