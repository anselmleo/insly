<?php

class Helper
{

	/**
	 * create csrf_token
	 * @return token string
	 */
  public function csrf_token() 
  {
		if(empty($_SESSION['token'])) {
			$_SESSION['token'] = bin2hex(md5(rand()));
		}

		if(empty($_SESSION['token_expires'])) {
			$_SESSION['token_expires'] = time() + 3600;
		}

		$token = $_SESSION['token'];
		return $token;		
  }
  

	/**
	 * validate csrf
	 * @return boolean
	 */
  public function check_csrf() 
  {
		if(time() > $_SESSION['token_expires']) {
			unset($_SESSION['token_expires']);
			return false;
			// redirect("index.php", '');
		}

		if(!hash_equals($_SESSION['token'], $_POST['csrf_token'])) {
			return false;
			// 	redirect("index.php", '');
			// exit();
		}

		return true;

	}

	/**
	 * validate fields
	 * @return array
	 */
	public function validateFields($rules, $post, $errors)
	{
		$validation_errors = [];
		$_trimmed = array_map('trim', $post);

		foreach ($rules as $key => $ruleset) {
			//$field = $_trimmed[$key];
			$validate_rules = explode('|', $ruleset);
			$is_error_msg = $this->validate($key, $_trimmed, $validate_rules, $errors);

			if($is_error_msg)
				$validation_errors[$key] = $is_error_msg;
		}
		return [$validation_errors, $_trimmed];
	}

	/**
	 * help the helper function => validate fields
	 */
	public function validate($key, $formdata, $validationrules, $error)
	{
		$_isError = false;
		$_errMsg = "";

		$field = $formdata[$key];

		foreach ($validationrules as $rule) {

			$rule = explode(':', $rule);

			switch ($rule[0]) {
				case 'empty':
					if(empty($field)){
						$_errMsg = $error[$key]['empty'];
						$_isError = true;
					}
					break;

				case 'min':
					if($field < $rule[1]) {
						$_errMsg = $error[$key]['min'];
						$_isError = true;
					}
					break;

				case 'max':
					if($field > $rule[1]) {
						$_errMsg = $error[$key]['max'];
						$_isError = true;
					}
					break;

				case 'numeric':
					if(!is_numeric($field)) {
						$_errMsg = $error[$key]['numeric'];
						$_isError = true;
					}
					break;

				default:
					# code...
					break;
			}

			if($_isError) break;
		}
		
		return $_errMsg;
	}




}