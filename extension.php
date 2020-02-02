<?php

function httpPost($url, $data)
{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

function getDataTable($data)
{

	$data = str_replace("<table>", "", $data);
	$data = str_replace("</table>", "", $data);
	$data = str_replace("<tr>", "", $data);
	$data = str_replace("<td>", "", $data);
	$data = str_replace("</tr>", "<br>", $data);
	$data = str_replace("</td>", "@", $data);

	$arr = split("<br>",$data);
	$arr = array_splice($arr, 1);

	$dataTable = array();

	foreach ($arr as $key => $value) {
		$params = split("@", $value);
		// echo "$value";
		// echo "<br>";
		if(count($params) < 10) { continue; }
		$subject = $params[0];
		$code = $params[1];
		$day = split(" ",$params[2])[0];
		$time = substr($params[2],strlen($day)+1);
		$room = $params[3];
		// echo "<br>";
		// echo $params[2];
		// echo "<br>";
		// echo $params[3];
		// echo "<br>";
		$teacher = $params[count($params)-2];
		// echo "<br>";
		$extra = $params[count($params)-8];
		$course = $params[count($params)-6];
		// echo "<br>";

		$row = array("subject" => $subject,"day" => $day,"time" => $time,"teacher" => $teacher, "course" => $course, "code" => $code, "room" => $room, "extra" => $extra);
		array_push($dataTable, $row);
	}

	return $dataTable;
}

function getSemester()
{
	$date = getdate();
	$month = $date['mon'];
	$year = $date['year'];

	if ($month > 6) {
		$tanrend = $year . "-" . ($year+1) . "-1";
	}
	else
	{
		$tanrend = ($year-1) . "-" . $year . "-2";
	}

	return $tanrend;
}

?>

