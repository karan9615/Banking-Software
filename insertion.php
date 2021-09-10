<?php
error_reporting(0);
session_start();
include 'navbar.php';

$conn = $_SESSION["conn"];
$_SESSION["ba"]=$_GET["ba"];
$_SESSION["aa"]=$_GET["aa"];
header("Location: transfer_font.php");
?>