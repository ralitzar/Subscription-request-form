<?php

class Form {
	static $regexp = Array(
		"not-empty"	=> "/^.{1,}$/",
		"not-empty-textarea" => "/^(?!\s*$).+/",
		"email" => "/^[a-zA-Z0-9]+([_\.\-]+|[a-zA-Z0-9]+)*@[a-zA-Z0-9]+(\.[a-zA-Z0-9]+|\-[a-zA-Z0-9]+)*\.[a-zA-Z]{2,}$/",
		"number"	=> "/^[0-9]*$/",
		"money"	=> "/^\d+([,.]\d{1,2})?$/",
		//"eik"	=> "/^(?:[0-9]{9}|[0-9]{13})$/",
		"eik"	=> "/^[0-9]{9,15}$/",
		"egn"	=> "/^[0-9]{10}$/",
		"egn-ln4-lin"	=> "/^[0-9]{5,15}$/",
		"UniID"	=> "/^[0-9]{4,12}$/",
		"FacultyNo"	=> "/^.{1,15}$/",
		"date" 		=> "/^[0-3]?[0-9].[0-3]?[0-9].(?:[0-9]{2})?[0-9]{2}$/",
		"name"		=> "/(*UTF8)^[а-яА-Я\-]{0,255}$/",
		"fullName"		=> "/(*UTF8)^[а-яА-Я\- ]{0,255}$/",
		//"username" 	=> "/^\w{3,10}$/",
		//"password"	=> "/^.{4,20}$/",
		//"other"		=> "/^[\w- !@.:;\?,]{0,100}$/",
	);
	
	static $err = array(
		'name' => 'Имената могат да съдържат само букви на кирилица',
	);

	function data( $fields = array(), & $errors = false ) {
		$result = get_post_data();
		
		foreach ($fields as $field_key => $field_value)
			foreach ($field_value as $key => $value)
				if ( (self::$regexp[$key] && !preg_match(self::$regexp[$key], $result[$field_key]))
				|| (is_int($key) && mb_strlen($result[$field_key], 'utf8') > $key) )
					$errors[$field_key][] = $value;
		
		return $result;
	}
	
	function errors( $errors ){
		$result = array();
		
		foreach ($errors as $error) {
		
			if (!is_array($error) && !is_object($error))
				$error = array( $error );
			
			foreach ($error as $key => $value)
				$result[] = $value;
		}
		
		return $result;
	}
}

?>