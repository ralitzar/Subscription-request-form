<?php

if (!$redirect) {

	if ($_SESSION['_MESSAGE']) {

		$message = $_SESSION['_MESSAGE'];
		unset ($_SESSION['_MESSAGE']);
	}

	if ($_SESSION['_ERRORS']) {

		$errors = $_SESSION['_ERRORS'];
		unset ($_SESSION['_ERRORS']);
	}
}

include ("templates/messages.html");

?>