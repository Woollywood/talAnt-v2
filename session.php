<?php
	session_start();

	if ($_SESSION['cookies'] == true) {
		$response = ['cookies' => true];
		echo json_encode($response);
	} else {
		$response = ['cookies' => false];
		echo json_encode($response);
	}
?>