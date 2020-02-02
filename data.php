<?php 
session_start();

include 'extension.php';

$GWidth = ($_POST['width']-64)/5;
$GHeight = 75;
$helper = array("Hétfo" => 0, "Kedd" => 1, "Szerda" => 2, "Csütörtök" => 3, "Péntek" => 4);
$days = array("Hétfő","Kedd","Szerda","Csütörtök","Péntek");

function getTime($s)
{
	$hour = split(":",$s)[0];
	$min = split(":",$s)[1];
	return (floatval($hour) + (floatval($min)/60));			
}

function getFromTo($time,$day)
{
	global $helper;

	$from = split("-",$time)[0];
	$to = split("-",$time)[1];
	$from = getTime($from) + ($helper[$day] * 100);
	$to = getTime($to) + ($helper[$day] * 100);
	return array("from" => $from,"to" => $to);
}

function getBlock($row)
{
	global $dataTable;

	$code = $row['code'];
	$course = $row['course'];

	$sum = 0;
	$index = -1;

	$base = getFromTo($row['time'],$row['day']);

	foreach ($dataTable as $k => $v) {

		$cur = getFromTo($v['time'],$v['day']);

		if($v['code'] == $code && $v['course'] == $course && $index == -1)
		{
			$index = $sum;
		}

		$test = false;
		$test = $test || ($cur['from'] >= $base['from'] && $cur['from'] < $base['to']);
		$test = $test || ($cur['to'] > $base['from'] && $cur['to'] <= $base['to']);

		$test = $test || ($base['from'] >= $cur['from'] && $base['from'] < $cur['to']);
		$test = $test || ($base['to'] > $cur['from'] && $base['to'] <= $cur['to']);

		if($test) { $sum++; }
	}

	return array("sum" => $sum, "index" => $index);
}

function getSession($row)
{
	global $_SESSION;

	$base = getFromTo($row['time'],$row['day']);

	foreach ($_SESSION as $k => $v) {

		if(!$v['vis']) { continue; }

		$cur = getFromTo($v['time'],$v['day']);

		$test = false;
		$test = $test || ($cur['from'] >= $base['from'] && $cur['from'] < $base['to']);
		$test = $test || ($cur['to'] > $base['from'] && $cur['to'] <= $base['to']);

		$test = $test || ($base['from'] >= $cur['from'] && $base['from'] < $cur['to']);
		$test = $test || ($base['to'] > $cur['from'] && $base['to'] <= $cur['to']);

		if($test) { return true; }
	}

	return false;
}

$data = httpPost("http://to.ttk.elte.hu/test.php",$_POST);
$dataTable = getDataTable($data);
if (isset($_POST['nar']) && $_POST['nar'] != "0") {
	$nar = $_POST['nar'];
	$dataTemp = array();
	foreach ($dataTable as $k => $v) {
		if (strpos($v['subject'], $nar . ")") !== false) {

			array_push($dataTemp, $v);
		}
	}
	$dataTable = $dataTemp;
}

$GFirst = 24;
$GLast = 0;

?>

<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css"> -->
<style type="text/css">
	.btn-mmp
	{
		font-size: 12px;
		padding: 1px 8px;
	}
</style>
<div class="panel-group">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
			<a data-toggle="collapse" href="#collapse1" style="text-shadow: 0 0 2px #3F92D2;">Lista</a>
			</h4>
		</div>
		<div id="collapse1" class="panel-collapse collapse in" style="max-height: 512px;overflow-y: scroll;">
			<div class="panel-body" style="position: relative;">
				<table class="table table-striped">
				    <thead>
				      <tr>
				        <th>Tantárgy</th>
				        <th>Kurzus</th>
				        <th colspan="4">Tanár</th>
				        <th>Terem</th>
				        <th>Nap</th>
				        <th>Idő</th>
				      </tr>
				    </thead>
					<tbody>				    
						<?php
							foreach ($dataTable as $k => $v) {

								$jsfunc = "saveLesson('" . $v['subject'] . "','" . $v['code'] . "','" . $v['course'] . "','" . $v['teacher'] . "','" . $v['room'] . "','" . $v['day'] . "','" . $v['time'] . "','true')";

								$time = $v['time'];
								$from = split("-", $time)[0];
								$hour = intval(split(":",$from)[0]);
								$GFirst = $GFirst > $hour ? $hour : $GFirst;
								$to = split("-", $time)[1];
								$hour = intval(split(":",$to)[0]);
								$GLast = $GLast < $hour ? $hour : $GLast;

								$mmpTeacher = $v['teacher'];
								$mmpTeacher = str_replace("Dr. ","",$mmpTeacher);
								$tmp = explode(" ",$mmpTeacher);
								$tmp = array_slice($tmp, 0,2);								
								$mmpTeacher = implode(" ",$tmp);
								$tkkTeacher = implode(" ",array_slice($tmp, 0,1));

								echo "<tr>";
									echo "<td style='cursor:pointer;text-shadow: 0 0 2px #3F92D2;' onclick=\"$jsfunc\" >" . $v['code'] . " - " . $v['subject'] . "</td>";
									echo "<td>" . $v['course'] . "</td>";
									echo "<td>" . $v['teacher'] . "</td>";
									echo "<td><form method='POST' style='margin:0px;' action='http://www.markmyprofessor.com/tanar/kereses.html' target='_blank'>";
									echo "<input type='hidden' name='word' value='" . $mmpTeacher . "'>";
									echo "<button type='submit' class='btn btn-mmp btn-info' title='MarkMyProfessor'>MMP</button>";
									echo "</form></td>";
									echo "<td><form method='GET' style='margin:0px;' action='https://www.facebook.com/groups/ELTE.IK.TKK/search/' target='_blank'>";
									echo "<input type='hidden' name='query' value='" . $tkkTeacher . "'>";
									echo "<button type='submit' class='btn btn-mmp btn-info' title='Tanár Keres Kínál'>TKK</button>";
									echo "</form></td>";
									echo "<td><form method='GET' style='margin:0px;' action='https://www.facebook.com/groups/elteikbsc/search/' target='_blank'>";
									echo "<input type='hidden' name='query' value='" . $tkkTeacher . "'>";
									echo "<button type='submit' class='btn btn-mmp btn-info' title='ELTE IK BSc'>BSc</button>";
									echo "</form></td>";
									$extra = strlen($v['extra']) > 0 ? "<br><i><b>" . $v['extra'] . "</b></i>" : "";
									echo "<td>" . $v['room'] . $extra . "</td>";
									echo "<td>" . $v['day'] . "</td>";
									echo "<td>" . $v['time'] . "</td>";
								echo "</tr>";
							}
						?>		
					</tbody>
				</table>		
			</div>
		</div>
	</div>
</div>


<?php

echo '<div style="position: relative;height:' . (15*$GHeight) . 'px;">';

if(count($dataTable) > 80)
{
	echo "Túl sok találat órarendhez. Add meg pontosabban a nevét.<br>";
	echo "Példa: Algoritmusok -> Algoritmusok és adatszerkezetek 1.";
	return;
}

foreach ($helper as $key => $value) {
	echo "<div style='position:absolute;left:" . ($value*$GWidth+64) . "px;top:50px;width:" . $GWidth . "px;height:50px;text-align:center;'>";
	echo $days[$value];
	echo "</div>";
}

for ($i=8; $i <= 21; $i++) { 
	echo "<div style='position:absolute;top:" . (($i-8)*$GHeight+100) . "px;width:64px;height:" . $GHeight . "px;text-align:center;'>";
	echo "$i:00";
	echo "</div>";
	echo "<hr style='position:absolute;top:" . (($i-8)*$GHeight+80) . "px;width:" . (($GWidth*5)+64) . "px;border-top:2px solid #CCC;'>";
}

foreach ($dataTable as $k => $v) {

	$day = $v['day'];
	$time = $v['time'];
	$subject = $v['subject'];
	$course = $v['course'];
	$teacher = $v['teacher'];
	$room = $v['room'];
	$code = $v['code'];

	if ($time == "" || $day == "") {
		continue;
	}

	$from = split("-", $time)[0];
	$hour = split(":",$from)[0];
	$min = split(":",$from)[1];
	$fromOffset = floatval($hour) - 8 + (floatval($min)/60);
	$to = split("-", $time)[1];
	$hour = split(":",$to)[0];
	$min = split(":",$to)[1];
	$toOffset = floatval($hour) - 8 + (floatval($min)/60);

	$block = getBlock($v);

	$sizeX = ($GWidth/$block['sum']);
	$sizeY = ($toOffset - $fromOffset)*$GHeight;

	$fontSize = min(min($sizeX / 14,$sizeY / 8),14);
	$paddingSize = min($sizeX / 30,$sizeY / 20);

	$offsetX = ($helper[$day]*$GWidth+64) + ($sizeX * $block['index']);
	$offsetY = ($fromOffset*$GHeight+100);

	$jsfunc = "saveLesson('" . $subject . "','" . $code . "','" . $course . "','" . $teacher . "','" . $room . "','" . $day . "','" . $time . "','true')";

	$args = "gwidth='$sizeX' gfont='$fontSize' gheight='$sizeY' gxpos='$offsetX' gxfix='" . ($helper[$day]*$GWidth+64) . "'";

	$pcol = "panel-primary";
	if(getSession($v)) { $pcol = "panel-danger"; }

	echo "<div $args class='panel $pcol hov' style='cursor:pointer;font-size:" . $fontSize . "px;position:absolute;left:" . $offsetX . "px;top:" . $offsetY . "px;width:" . $sizeX . "px;height:" . $sizeY . "px;' onclick=\"" . $jsfunc . "\">";
	?>

	      <?php 
	      echo '<div class="panel-heading" style="padding:' . $paddingSize . 'px ' . $paddingSize*2 . 'px;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;">#' . $course . ' ' . $subject . '</div>';
	      echo '<div class="panel-body" style="padding:' . $paddingSize . 'px;">';
	      echo $teacher;
	      echo '<br>';
	      echo $time;
	      echo '<br>';
		  echo $room;  
		  $extra = strlen($v['extra']) > 0 ? "<br><i><b>" . $v['extra'] . "</b></i>" : "";
		  echo $extra; 	 	
	      echo "</div></div>";


}

?>

</div>

<script type="text/javascript" src='script.js'></script>
<script type="text/javascript">

	$(".hov").mouseleave(function()
	{
		// $(".hov").show();
		var width = $(this).attr("gwidth");
		var height = $(this).attr("gheight");
		var font = $(this).attr("gfont");
		var xpos = $(this).attr("gxpos");
		
		$(this).css("z-index",0);
		$(this).clearQueue();
		$(this).animate({
			width: width,
			height: height,
			fontSize:font + "px",
			left:xpos + "px",
		},100);
	});

	$(".hov").mouseenter(function()
	{
		// $(".hov").stop();
		// $(".hov").not(this).hide();

		
		<?php echo "var width=" . $GWidth . ";"; ?>
		<?php echo "var height=" . $GHeight*2 . ";"; ?>
		height = Math.max($(this).attr("gheight"),height);

		$(this).css("z-index",1);
		$(this).clearQueue();
		$(this).animate({
			width: width,
			height: height,
			fontSize:"14px",
			left:$(this).attr("gxfix") + "px",
		},100);
	});

</script>