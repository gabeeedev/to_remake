<?php

	session_start();

	$_POST['custom'] = "true";
	$_SESSION[$_POST['code'] . "_" . $_POST['course'] . "_" . $_POST['day'] . "_" . $_POST['time']] = $_POST;

?>