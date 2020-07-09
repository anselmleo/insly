
<?php

$validation_rules = [
		'carInsuranceCalculator' => [
			'estimatedValue' => 'empty|numeric|min:100|max:100000',
			'tax' => 'numeric|min:0|max:100', 
			'instalments' => 'empty|numeric|min:1|max:12' 
		]
	];