<?php
$expire=time()-1; 
$expire = 0;

setcookie ("KioskBanking", $expire);
header("Location:index.php");

?>