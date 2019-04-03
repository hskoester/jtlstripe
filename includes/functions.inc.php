<?php
//Include all required classes
include("../classes/xtea.class.php");
include("config.inc.php");

function makeAmountCents($string) {
	// characters to remove
	$remove = array('*', '+', '!',  ',', '#', '@', '.');
	// remove to ugly chars
	$string = str_replace($remove, " ", $string);
	// remove all double white-spaces
	while (strpos($string, "  ") !== false) $string = str_replace("  ", " ", $string);
		return trim($string);
}

function removeSpecialChars($string) {
	$search = array("Ä", "Ö", "Ü", "ä", "ö", "ü", "ß", "´");
	$replace = array("Ae", "Oe", "Ue", "ae", "oe", "ue", "ss", "");
	return str_replace($search, $replace, $string);
}

function fixStringSpace($string) {
	$search = "%20";
	$replace = " ";
	return str_replace($search, $replace, $string);
}

function encryptCustomerData($customerdata) {
	$xtea = new XTEA($encryptionKey); // Get Encryption Key of config.inc.php
	$cipher = $xtea->Encrypt($customerdata); //Encrypts value of customerdata
	return $cipher;
}

function decryptCustomerData($cipher) {
	$xtea = new XTEA($encryptionKey); // Get Encryption Key of config.inc.php
	$plain = $xtea->Decrypt($cipher); //Decrypts the cipher text
	return $plain;
}
?>