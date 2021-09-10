<?php
session_start();
$server = 'localhost:3307';
$user = 'root';
$password = 'Karan@25';
$_SESSION["conn"] = new mysqli($server,$user,$password);
?>