<?php
// 61 Logout Sytem
session_start();
header("Location: /47_forum_php_codewithharry/index.php"); 

session_destroy();

?>