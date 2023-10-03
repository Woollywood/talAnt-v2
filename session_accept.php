<?php
	session_start();
	$_SESSION['cookies'] = true;
	echo json_encode($_SESSION);
?>