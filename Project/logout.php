<?php
include 'config.php';
session_start(); 
session_unset();
session_destroy();
//session handle kora hoyeche
header("Location: signIn_signOut.php"); 
//log out korle signIn_signOut.php file e chole ashbe

?>