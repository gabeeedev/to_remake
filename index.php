<html>
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-105677841-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-105677841-1');
	</script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/fileinput.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">	
	<link rel="stylesheet" type="text/css" href="css/fileinput.css">	
	<link rel="stylesheet" type="text/css" href="css/dark.css" id="theme">	
	<title>TO Lekérdező és órarend szerkesztő</title>
</head>
<body style="margin-top:64px;">

<div class="row" style="margin:17px;">
	<div class="col-md-6 col-sm-6 col-xs-6">
		<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
					<a data-toggle="collapse" href="#desc">Rövid Leírás</a>
					</h4>
				</div>
				<div id="desc" class="panel-collapse collapse" style="max-height: 512px;overflow-y: scroll;">
					<div class="panel-body" style="position: relative;">
						Elsődleges célja a TO-s adatbázis vizuális megjelenítése.<br>
						Írj a mezőbe egy tantárgyat/kódot/oktató nevét (minél pontosabban) és válaszd ki alatta a szükséges mezőt. (sajnálom, így működik a to)<br>
						A keresés kiadja egy órarendben az összes hozzá tartozó órát.<br>
						A Lista részben látható a TO-ból kapott adatbázis kicsit kevesebb információval.<br>
						A listában látható MMP gomb amely egy Mark My Professor-os keresést hajt végre (Továbbá a <a href='https://www.facebook.com/groups/ELTE.IK.TKK/?fref=ts'>TKK csoportban</a> érdeklődjetek bátran!)<br>
						Ha az órarendben vagy a listában rákattintunk egy órára, azt berakja a lejjebb található órarendbe.<br>
						A saját órarendben ha rákattintunk egy órára akkor azt inaktív állapotba teszi, ezt a fölötte lévő listában pirossal láthatjuk, erre rákkatintva ismét aktívvá tehetjük és visszakerül az órarendbe.<br>
						A saját órarend listájában található X gombbal törli a bejegyzést.<br>
						A felső órarendben pirossal látjuk azokat az órákat amelyek ütköznek a jelenlegi órarendünkel (nem mindig frissít jól)<br>
						Az órarend jelenleg nem kerül mentésre (SESSION alapú)<br>
						Az órarendet alul tudod exportálni szövegként amivel ide vissza tudod importálni vagy másnak továbbítani(részletek lent)<br>
						Importálás során egyeztet a kód és kurzusszám alapján a TO-val, ha a kurzus létezik akkor a jelenlegi TO-s adatok alapján berakja<br>
						Az órarendet alul tudod exportálni Google Calendarba(részletek lent)<br>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-5 col-sm-5 col-xs-5">
		<div class="panel-group">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h4 class="panel-title">
					<a data-toggle="collapse" href="#changelog">Changelog</a>
					</h4>
				</div>
				<div id="changelog" class="panel-collapse collapse" style="max-height: 512px;overflow-y: scroll;">
					<div class="panel-body" style="position: relative;">
						<ul>
							<li>08.04.</li>
							<ul>
								<li>TO lekérdezés órarend formátumban</li>
								<li>Párhuzamos órák kezelése</li>
								<li>Órarend összeállító (Session-be tárolás)</li>
							</ul>
							<li>08.05.</li>									
							<ul>
								<li>Nagyítás</li>
								<li>Lista a saját órarendben lévő óráknak</li>
								<li>Inaktív állapotba helyezhetők a saját órarendből az órák(A listában ki-be kapcsolható az állapot)</li>
							</ul>
							<li>08.06.</li>
							<ul>
								<li>Ablak szélességét veszi alapul a megjelenítés(frissítés szükséges)</li>
								<li>A saját órarendbe lévő órák időtartamában lévő órák pirossal vannak jelezve</li>
								<li>Törlés gomb hogy ne csak inaktívvá lehessen tenni a saját órarendben lévő órákat</li>
							</ul>
							<li>08.07</li>
							<ul>
								<li>Tantárgykódra és oktatóra keresés támogatása</li>
								<li>Changelog</li>
							</ul>
							<li>08.08</li>
							<ul>
								<li>Nagyítás animáció</li>
							</ul>
							<li>08.09</li>
							<ul>
								<li>Exportálás/Importálás szövegként</li>
								<li>Automatikus félév váltás (júliustól 1. félév, januártól 2. félév)</li>
								<li>Félév kijelzése tiltott bemenetként</li>
							</ul>
							<li>08.11</li>
							<ul>
								<li>Nagyítás korrigálása</li>
							</ul>
							<li>08.20</li>
							<ul>
								<li>Google Calendar Export</li>
								<li>Automatikus félév beállítás a Google Calendar Export-hoz</li>
							</ul>
							<li>09.05</li>
							<ul>
								<li>Saját kurzus hozzáadásának lehetősége</li>
							</ul>
							<li>09.07</li>
							<ul>
								<li>Az importálás mostmár egyeztet a TO-val</li>
								<li>MarkMyProfessor gomb</li>
							</ul>
							<li>09.10</li>
							<ul>
								<li>Google Export javítva csak aktív órákra</li>
							</ul>
							<li>09.13</li>
							<ul>
								<li>Google Export-nál Déli/Északi Tömb cseréje D/É-re</li>
								<li>MMP keresés mellé TKK és BSc csoportokban keresés (csak vezetéknévvel)</li>
							</ul>
							<li>02.05</li>
							<ul>
								<li>Szakirány szűkítés</li>
								<li>Az órarendben lévő hasonló tárgyak kiemelése ha ráviszed az egeret</li>
							</ul>
							<li>09.06</li>
							<ul>
								<li>Megjegyzés megjelenítése</li>
							</ul>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<style>
		.btn-light, .btn-light:hover, .btn-light:active, .btn-light:focus {
			background-color:#DDD;
			color:#222;
			font-weight:bold;
		}
		.btn-dark, .btn-dark:hover, .btn-dark:active, .btn-dark:focus {
			background-color:#222;
			color:#DDD;
			font-weight:bold;
		}
	</style>
	<div class="col-md-1 col-sm-1 col-xs-1">
		<button type="button" id="themechanger" class="btn btn-light" style="width:100%;height:39px;">Light</button>
	</div>
	<script>
		$("#themechanger").click(function() {
			if ($("#theme").prop("disabled")) {
				$("#theme").prop("disabled",false);
				$(this).html("Light");
				$(this).removeClass("btn-dark");
				$(this).addClass("btn-light");
			} else {
				$("#theme").prop("disabled",true);
				$(this).html("Dark");
				$(this).removeClass("btn-light");
				$(this).addClass("btn-dark");
			}
		});
	</script>
</div>
	

	<div style="margin: 32px;">
		<form id="lister">
		  <div class="form-group">
		    <label for="subject">Tantárgy</label>
		    <input class="form-control" id="subject">
		  </div>
		  <div class="form-group">
		    <label for="search">Keresendő</label>
		    <select class="form-control" id="search">
		    	<option value="nevalapjan">Tantárgy neve</option>
		    	<option value="kodalapjan">Tantárgy kódja</option>
		    	<option value="oktnevalapjan">Oktató neve</option>
		    </select>
		  </div>
		  <div class="form-group">
		    <label for="nar">Szakirány szűkítés <span class="label label-primary">TESZT</span> <span class="label label-danger">Előfordul hogy az adatbázisban más szakirányhoz van beírva az óra</span></label>
		    <select class="form-control" id="nar">
		    	<option value="0">Mind</option>
		    	<option value="A">A</option>
		    	<option value="B">B</option>
		    	<option value="C">C</option>
		    	<option value="E">E</option>
		    	<option value="T">T</option>
		    </select>
		  </div>
		  <div class="form-group">
		  	<label for="felev">Félév (Automatikus váltás: Január/Július)</label>
	<?php

		$date = getdate();
		$month = $date['mon'];
		$year = $date['year'];

		if ($month >= 6) {
			$tanrend = $year . "-" . ($year+1) . "-1";
		}
		else
		{
			$tanrend = ($year-1) . "-" . $year . "-2";
		}

		echo '<input class="form-control" id="felev" name="felev" value="' . $tanrend . '" disabled>';

	?>
		</div>
		<input type="hidden" name="darab" id="darab" value="1000">
		  <button type="submit" class="btn btn-default">Keres</button>
		</form>
	</div>
	
	<div id="tar" style="margin: 32px;">
		
	</div>

	<div id="timetable" style="margin: 32px;">
		
	</div>

	<div class="panel-group" style="margin:32px;">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4 class="panel-title">
				<a data-toggle="collapse" href="#eximport">Export/Import</a>
				</h4>
			</div>
			<div id="eximport" class="panel-collapse collapse" style="max-height: 512px;overflow-y: scroll;">
				<div class="panel-body" style="position: relative;">
					<p>
						Az export gombbal kiadja a szükséges szöveget, az importtal pedig beolvassa onnan.<br>
						Kérném szépen, hogy ctrl+A-val mentsétek le a szöveget és azzal is másoljátok vissza, nem lesz egy ideig bugmentesítve, így ha valamit átírtok akkor az valószínűleg ad majd egy valag hibát.<br>
						Az órarend nem kerül felülírásra hanem hozzáadja az exportált órákat.<br>
					</p>
					<div class="form-group">
					  <label for="comment">Adat</label>
					  <textarea class="form-control" rows="10" id="eximdata"></textarea>
					</div>
					<div class="btn-group">
						<button type="button" class="btn btn-primary" id="tt_export">Export</button>
						<button type="button" class="btn btn-primary" id="tt_import">Import</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="panel-group" style="margin:32px;">
		<form method="POST" id="cc_form">	
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="panel-title">
					<a data-toggle="collapse" href="#cc_panel">Saját kurzus hozzáadása</a>
					</h4>
				</div>
				<div id="cc_panel" class="panel-collapse collapse">
					<div class="panel-body" style="position: relative;">
						<p>
							Ezzel a funkcióval berakhattok egyedi órákat (pl tesi), azonban használatát csak a tárgyfelvétel végére ajánlom ugyanis nem lehet módosítani csak újraírni.
						</p>
						<div class="form-group">
						    <label for="cc_subject">Tantárgy neve</label>
						    <input class="form-control" id="cc_subject">
						</div>
						<div class="form-group">
						    <label for="cc_code">Tantárgy kódja</label>
						    <input class="form-control" id="cc_code">
						</div>
						<div class="form-group">
						    <label for="cc_course">Kurzus</label>
						    <input class="form-control" id="cc_course">
						</div>
						<div class="form-group">
						    <label for="cc_day">Nap</label>
						    <select class="form-control" id="cc_day">
						    	<option value="Hétfo">Hétfő</option>
						    	<option value="Kedd">Kedd</option>
						    	<option value="Szerda">Szerda</option>
						    	<option value="Csütörtök">Csütörtök</option>
						    	<option value="Péntek">Péntek</option>
						    </select>
						</div>
						<div class="form-group">
						    <label for="cc_time">Óra (hh:mm-hh:mm) pl: 17:30-19:00</label>
						    <input class="form-control" id="cc_time">
						</div>
						<div class="form-group">
						    <label for="cc_room">Terem (opcionális)</label>
						    <input class="form-control" id="cc_room">
						</div>
						<div class="form-group">
						    <label for="cc_teacher">Tanár (opcionális)</label>
						    <input class="form-control" id="cc_teacher">
						</div>
						<div class="btn-group">
							<button type="submit" class="btn btn-primary">Hozzáadás</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="panel-group" style="margin:32px;">
		<form id="gcexport">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="panel-title">
					<a data-toggle="collapse" href="#gce">Google Calendar Export</a>
					</h4>
				</div>
				<div id="gce" class="panel-collapse collapse" style="max-height: 512px;overflow-y: scroll;">
					<div class="panel-body" style="position: relative;">
						<p>
							A hetek száma alapján készít egy CSV fájlt amely importálható Google Calendarba.<br>
							Ajánlott szám ha egész félévre szeretnéd : 14-15 (nem kezeli le az őszi szünetet)<br>
							Segítség importáláshoz : <a href="https://support.google.com/calendar/answer/37118?hl=hu" target="_blank">Google Calendar</a><br>
						</p>
						<div class="form-group">
						    <label for="weeks">Hetek száma</label>
						    <input class="form-control" pattern="[0-9]{1,2}" title="Maximum 2 jegyű szám" id="weeks" value="4">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Export</button>
						</div>
						
						<?php

							$date = getdate(); $month = $date['mon']; $year = $date['year'];
							$tanev = ($month > 6) ? "tanev" . substr(strval($year),2) . substr(strval($year+1),2) : $tanev = "tanev" . substr(strval($year-1),2) . substr(strval($year),2);
						?>

						<p>
							Az oldal a <?php echo "<a href='https://www.elte.hu/kozerdeku/tanev-rendje'>"; ?> https://www.elte.hu/kozerdeku/tanev-rendje.</a> oldalt használja, hogy beállítsa a szorgalmi időszak kezdetét.<br>
							<strong>Addig működik a Google Calender Export automatikusan ameddig az ELTE tartja magát ehhez a rendszerhez!</strong><br>
						</p>
					</div>
				</div>
			</div>
		</form>
	</div>
</body>

<script type="text/javascript" src="script.js"></script>

</html>