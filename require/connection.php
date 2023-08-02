<?php
mysqli_report(MYSQLI_REPORT_OFF);

define("hostname", "localhost");
define("username", "root");
define("password", "");
define("database", "19696_MOHSIN_ALI_SAHITO");

$connection = mysqli_connect(hostname, username, password, database);

if (mysqli_connect_errno()) {
	echo "Error No: ".mysqli_connect_errno()."<br />";
	echo "Error Message: ".mysqli_connect_error()."<br />";
	die("<h2 style='color: red;'>Database Connection Failed...!<h2/>");
}

?>