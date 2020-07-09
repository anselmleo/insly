<?php 

// INSLY TECHNICAL ASSIGNMENT

// TASK 1 - Name
// 01110000 01110010 01101001 01101110 01110100 00100000 01101111 01110101
// 01110100 00100000 01111001 01101111 01110101 01110010 00100000 01101110
// 01100001 01101101 01100101 00100000 01110111 01101001 01110100 01101000
// 00100000 01101111 01101110 01100101 00100000 01101111 01100110 00100000
// 01110000 01101000 01110000 00100000 01101100 01101111 01101111 01110000
// 01110011

// PROBLEM: Convert binaries to human readable form.

// SOLUTION:

// Store string of binaries as binaryString
$binaryString = "01110000 01110010 01101001 01101110 01110100 00100000 01101111 01110101 01110100 00100000 01111001 01101111 01110101 01110010 00100000 01101110 01100001 01101101 01100101 00100000 01110111 01101001 01110100 01101000 00100000 01101111 01101110 01100101 00100000 01101111 01100110 00100000 01110000 01101000 01110000 00100000 01101100 01101111 01101111 01110000 01110011";

// Split binary string into groups that represent one character.
$binaries = explode(" ", $binaryString);

$nameString = null;

// Loop through each group of binary strings, convert and concatenate
foreach( $binaries as $binary) {
  $nameString .= pack('H*', dechex(bindec($binary)));
}

echo $nameString;

// Perform instruction printed in $nameString ==> (Print out your name with one of php loops)

$myName = "Anselm Mba"; // Store my name in variable

$myNameArray = str_split($myName); // Split name into array

$nameChar = null;

// loop using php array loop function "foreach"
foreach ($myNameArray as $char) {
  $nameChar .= $char;
}

// print out name
echo nl2br("\n My name is: " . $nameChar);
