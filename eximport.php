<?php

session_start();

include 'extension.php';


if (isset($_POST['action'])) {
	if ($_POST['action'] == 'export') {
		$data = "";
		foreach ($_SESSION as $rk => $row) {
			$s = "";
			foreach ($row as $k => $v) {
				$s = $s . $k . "=" . $v . "<kb>";
			}
			$s = substr($s,0,-4);
			$s = $s . "<lb>";
			$data = $data . $s;
		}

		$data = substr($data,0,-4);
		echo $data;
	}
	if ($_POST['action'] == "import") {

		$tanrend = getSemester();
		$postData = array('felev' => $tanrend, 'limit' => 1000, 'melyik' => 'kodalapjan');

		$s = $_POST['data'];
		$arr = explode("<lb>",$s);
		foreach ($arr as $rk => $row) {

			$dataRow = array();
			$temp = explode("<kb>",$row);
			foreach ($temp as $k => $v) {
				$key = explode("=", $v)[0];
				$val = explode("=", $v)[1];
				$dataRow[$key] = $val;
			}

			$postData['targykod'] = $dataRow['code'];

			if(isset($dataRow['custom']))
			{
				$_SESSION[$dataRow['code'] . "_" . $dataRow['course'] . "_" . $dataRow['day'] . "_" . $dataRow['time']] = $dataRow;
				continue;
			}

			$data = httpPost("http://to.ttk.elte.hu/test.php",$postData);
			$dataTable = getDataTable($data);

			foreach ($dataTable as $k => $v) {
				if($dataRow['course'] == $v['course'])
				{
					$v['vis'] = $dataRow['vis'];
					$_SESSION[$v['code'] . "_" . $v['course'] . "_" . $v['day'] . "_" . $v['time']] = $v;
				}				
			}
		}		

		echo "Sikeres importálás!";
	}
}


?>