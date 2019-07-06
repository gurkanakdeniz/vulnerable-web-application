<?php
$XVWA_WEBROOT = "";
$host = "localhost";
$dbname = 'vulsite';
$username = "testkullanici";
$pass = "testkullanicisifre";
$conn = new mysqli($host, $username, $pass, $dbname);
$connp = new PDO("mysql:host=$host;dbname=$dbname", $username, $pass);
$connp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
