<?php
require ("require/connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

$mail = new PHPMailer();
$mail->isSMTP();

$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->SMTPAuth = true;
$mail->Username = 'hist6782@gmail.com';
$mail->Password = 'cfyapyrqekhngjod';

$password = "";

for ($i = 0; $i < 8; $i++) {
    $num = rand(0, 9);
    $password .= $num;
}

if (isset($_POST['send'])) {
	$query = "SELECT * FROM user WHERE email = '".$_POST['email']."'";
	$result = mysqli_query($connection, $query);

	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$mail->setFrom('hist6782@gmail.com');
		$mail->addAddress($_POST['email']);
		$mail->Subject = "Forgot Password";
		$mail->msgHTML($password);

		if ($mail->send()) {
		    $query = "UPDATE user SET password = '".$password."' WHERE user_id = '".$row['user_id']."'";
			$result = mysqli_query($connection, $query);
			if ($result) {
				header("location:index.php?login_msg=Your New Password Has Been Sent To You In Mail...!");
			} else {
				header("location:index.php?login_msg=Try Again...!");
			}
		} 
	}
}
	
?>