<?php
//Include all required classes
include("../classes/xtea.class.php");
include("config.inc.php");
include("variables.inc.php");

function checkTestMode(){
	if($isTestInstallation == 1){
		return $apiTestKey;
	}
	else{
		return $apiLiveKey;
	}
}

function checkAccountHolder(){
	if(is_null($name) == true){
		if(is_null($holder) == false){
			return $holder;
		}
		else{
			echo("Missing Accountholder");
		}
	}
	else if(is_null($holder) == false){
		return $holder;
	}
}

function checkSourceIsFilledInURL() {
	if(is_null($pament_source) == true){
		return false;
	}
	else {
		return true;
	}
}

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

function getCCDetailsOfSourceID($source){
	$con = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
	$res = mysqli_query($con, "SELECT * FROM cc_sources");
	while($dsatz = mysqli_fetch_assoc($res)) {
		$decryptedName = decryptCustomerData($dsatz["holder"]);
		$decryptedCardNumber = decryptCustomerData($dsatz["cc_number"]);
		$decryptedCardMonth = decryptCustomerData($dsatz["cc_month"]);
		$decryptedCardYear = decryptCustomerData($dsatz["cc_year"]);
		$decryptedCardCVC = decryptCustomerData($dsatz["cc_cvc"]);
		$decryptedEmail = decryptCustomerData($dsatz["email"]);
		$decryptedCusNo = decryptCustomerData($dsatz["customer_no"]);
	}
	mysqli_close($con);
}

function getDDDetailsOfSourceID($source){
	$con = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
	$res = mysqli_query($con, "SELECT * FROM dd_sources");
	while($dsatz = mysqli_fetch_assoc($res)) {
		$decryptedName = decryptCustomerData($dsatz["holder"]);
		$decryptedIBAN = decryptCustomerData($dsatz["dd_iban"]);
		$decryptedBIC = decryptCustomerData($dsatz["dd_bic"]);
		$decryptedEmail = decryptCustomerData($dsatz["email"]);
		$decryptedCusNo = decryptCustomerData($dsatz["customer_no"]);
	}
	mysqli_close($con);
}

function writeCCDetailsToDB($ccholder, $ccnumber, $ccmonth, $ccyear, $cccvc, $customernumber, $source) {
	$con = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
	$sql = "INSERT INTO 'cc_transactions' (cc_holder', 'cc_no', 'cc_month', 'cc_year', 'cc_cvc', 'customer_no', 'source_id', 'creation_time') VALUES ('".$ccholder."', '".$ccnumber."', '".$ccmonth."', '".$ccyear."', '".$cccvc."', '".$customernumber."', '".$source."', CURRENT_TIMESTAMP);";
	mysqli_query($con, $sql);
	mysqli_close($con);
}
?>