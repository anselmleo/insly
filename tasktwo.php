<?php

session_start();

require_once 'CalculatorLogic.php';
require_once 'Helper.php';
require_once 'validation_rules.php';
require_once 'validation_errors.php';


try {

  // validate submit button was clicked
  if(!array_key_exists('submit', $_POST))
      throw new Exception("Error with request validation. Refresh broswer");  
  
  // validate csrf
  $helper = new Helper();
  if(!$helper->check_csrf())
    throw new Exception("Error with request validation. Refresh browser");

  $rules = $validation_rules['carInsuranceCalculator'];
  $errors = $validation_errors['carInsuranceCalculator'];

  list($validation_errors, $clean) = $helper->validateFields($rules, $_POST, $errors);

  // validate form fields
  if(!empty($validation_errors))
    throw new Exception("Error with request validation. Incorrect form entry");

  $calculatorLogic = new CalculatorLogic($clean);
  $result = $calculatorLogic->toJson();
} catch (Exception $e) {
  $result = json_encode([ 'message' => $e->getMessage(), 'status' => 'fail' ], http_response_code(400));
}

exit($result);