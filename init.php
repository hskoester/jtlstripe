<?php
include("includes/functions.php");

file_put_contents("includes/blowfishkey.inc.php", "<?php\n$encryptionKey='.generateRandomEncryptionKey().';\n?>");

?>