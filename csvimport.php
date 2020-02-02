<?php

	print_r($_FILES);
	echo $_FILES['file']['tmp_name'];
	echo file_get_contents($_FILES['file']['tmp_name']);

?>