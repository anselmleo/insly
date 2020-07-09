
<?php

$validation_errors = [
	'carInsuranceCalculator' => [
		'estimatedValue' => [
			'empty' => 'Please enter estimatedValue!',
			'min'=> 'Please enter a minimum of 100!',
			'max' => 'Please enter a maximum of 100000',
			'numeric' => 'Invalid characters, only digits allowed'
		],
		'tax' => [
			'empty' => 'Please enter tax!',
			'min'=> 'Please enter a minimum of 0!',
			'max' => 'Please enter a maximum of 100',
			'numeric' => 'Invalid characters, only digits allowed'
		],
		'instalments' => [
			'empty' => 'Please enter instalments!',
			'min'=> 'Please enter a minimum of 1!',
			'max' => 'Please enter a maximum of 12',
			'numeric' => 'Invalid characters, only digits allowed'
		]
	]
];