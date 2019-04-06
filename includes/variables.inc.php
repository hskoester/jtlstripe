<?php
/*General Parameter*/
$name = $_GET['name'];
$email = $_GET['email'];
$order = $_GET['order'];
$amount = $_GET['amount'];
$cus_no = $_GET['cus_no'];
$payment_source = $_GET['pay_source'];
$holder = $_GET['account_holder'];

/*CreditCard Parameter*/
$cc_number = $_GET['cc_number'];
$cc_cvc = $_GET['cc_cvc'];
$cc_month = $_GET['cc_month'];
$cc_year = $_GET['cc_year'];
$cc_holder = $_GET['cc_holder'];

/*DirectDebit Parameter*/
$dd_iban = $_GET['iban'];
$dd_bic = $_GET['bic'];
$dd_holder = $_GET['dd_holder'];

/*Encrypted Stuff*/
$encryptName = "";
$encryptCardNumber = "";
$encryptExpMonth = "";
$encryptExpYear = "";
$encryptCardCVC = "";
$encryptEmail = "";
$encryptCusNo = "";

/*Decrypted Stuff*/
$decryptedName = "";
$decryptedCardNumber = "";
$decryptedExpMonth = "";
$decryptedExpYear = "";
$decryptedCardCVC = "";
$decryptedEmail = "";
$decryptedCusNo = "";
?>