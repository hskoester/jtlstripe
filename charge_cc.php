<?php
require("includes/variables.inc.php");
require("includes/functions.inc.php");
require("includes/config.inc.php");
//Check if Encryption Key exists in system
$encKey = 'includes/blowfishkey.inc.php';
if (file_exists($encKey) == false) {
    exit(1);
}

$activeAPIKey = checkTestMode();
//Check if Customer Name is same as Card Holder
$activeHolder = checkAccountHolder();
$activeHolder = removeSpecialChars($activeHolder);
$activeHolder = fixStringSpace($activeHolder);

//Convert decimal amount to cents amount
$amount_fixed = makeAmountCents($amount);
//Adding Source (Card) to Stripe
$json=trim(shell_exec('curl https://api.stripe.com/v1/customers -u '.$activeAPIKey.': -d card[number]="'.$cc_number.'" -d card[exp_month]="'.$cc_month.'" -d card[exp_year]="'.$cc_year.'" -d card[cvc]="'.$cc_cvc.'" -d usage=reusable -d owner[name]="'.$activeHolder.'" -d owner[email]="'.$email.'"'));
$data=json_decode($json,true);
$customer=$data['id'];
$source=$data['sources']['data'][0]['id'];
//Charge Source and Customer
shell_exec('curl https://api.stripe.com/v1/charges -u '.$activeAPIKey.': -d amount="'.$amount_fixed.'" -d currency=eur -d description="Auftrag '.$order.' - Kunde '.$cus_no.' - vom '.date("m.d.Y").'" -d source="'.$source.'"');

/* Encrypt Customer Data to write in Database after */
$encryptName = encryptCustomerData($activeHolder);
$encryptCardNumber = encryptCustomerData($cc_number);
$encryptExpMonth = encryptCustomerData($cc_month);
$encryptExpYear = encryptCustomerData($cc_year);
$encryptCardCVC = encryptCustomerData($cc_cvc);
$encryptEmail = encryptCustomerData($email);
$encryptCusNo = encryptCustomerData($cus_no);
$encryptSource = encryptCustomerData($source);

writeCCDetailsToDB($encryptName, $encryptCardNumber, $encryptCardNumber, $encryptExpMonth, $encryptExpYear, $encryptCardCVC, $encryptCusNo, $encryptSource);
return $encryptSource;
?>