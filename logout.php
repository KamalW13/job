<?php 
session_start();  // ============> SESSION
$_SESSION['login'] = '';
session_destroy();
header("Location: index.php");
 ?>