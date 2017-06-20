<?php

include("system/functions.php");
include("modules/form.php");
include("modules/class.phpmailer.php");
include("modules/class.smtp.php");
include("modules/nom.php");

$errors = false;

// Обработка на данните от формата при Submit

if ( $_POST ) {

	$fields = array (
		"childId" => array (
			'egn' => "Въведете валидно ЕГН"),

		"childBirdPlace" => array (
			'not-empty' => "Моля, въведете място на раждане"),

		"childName" => array (
			'not-empty' => "Името на детето е задължително"),
		
		"childFamily" => array (
			'not-empty' => "Попълнете фамилията на детето"),

		"childBirdDate" => array (
			'date' => "Рожденната дата е невалидна",),

		"parentName" => array (
			'not-empty' =>"Името на родителя е задължително"),

		"parentFamily" => array (
			'not-empty' => "Фамилията на родителя е задължително"),

		"mobile" => array (
			'not-empty' => "Моля, въведете телефон за връзка"),

		"email" => array (
			'not-empty' => "Полето е задължително")
	);

	$data = Form::data( $fields, $errors );
	
	/*
	if ( $data['docdate'] && strtotime( cDate( $data['docdate'] ) ) <= strtotime( cDate( $data['docdate'] ) ) ) {
		
		$errors['docdate'] = "Грешна дата";
	}
	*/

	if ( !$errors ) {

		$formId = @file_get_contents("db/formId.txt");

		if ( $formId > 0 ) {

			$formId++;

		} else {

			$formId = 1;
		}

		ob_start();

		include("templates/emailBody.html");

		$content = ob_get_clean();

		$r = send_mail( $data['email'], "Регистрация училище Боянъ Мага - Лондон", $content );

		if ( !$r ) {

			$errors[] = "Грешка при изпращането";

		} else {

			file_put_contents("db/formId.txt", $formId);
			file_put_contents("db/form".$formId."_".date("dmY").".html", $content);

			header("location:regSuccess.php?formId=".$formId);
			exit;
		}

	}
}
	


// Добавяне на View

include('templates/formRegistration.html');

?>