<?php
session_start();
require ("../../require/connection.php");

$alpha_name_pattern = "/^[A-Z][a-z]{2,10}$/";
$email_pattern = "/^[a-z]{3,15}[0-9]{1,4}[@][a-z]{3,7}[.][a-z]{2,5}$/";

$msg = "";

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

if (isset($_POST['send_feedback'])) {
	extract($_POST);

	if ($page = "../../index.php") {
		if (!preg_match($alpha_name_pattern, $sender_name)) {
			$msg .= "<li>First Name must be like eg: Mohsin...!</li>";
		}
		
		if (!preg_match($email_pattern, $sender_email)) {
			$msg .= "<li>Email must be like eg: abc7@gmail.com...!</li>";
		}
		
		if (!empty($msg)) {
			header("Location: ".$page."?message=".$msg);
			exit;
		}
	}
	else {
		if (!preg_match($alpha_name_pattern, $sender_name)) {
			$msg .= "<li>First Name must be like eg: Mohsin...!</li>";
		}
		
		if (!preg_match($email_pattern, $sender_email)) {
			$msg .= "<li>Email must be like eg: abc7@gmail.com...!</li>";
		}
		
		if (!empty($msg)) {
			header("Location: ../".$page."?message=".$msg."&post_id=".$post_id."&blog_id=".$blog_id."&category_id=".$category_id);
			exit;
		}
	}
	
	
	if ($msg == "") {

		$query = "SELECT email FROM USER WHERE role_id = 1";
		$result = mysqli_query($connection, $query);
		if ($result->num_rows > 0) {
			$mail->setFrom($sender_email);
			while ($rows = mysqli_fetch_assoc($result)) {
				$mail->addAddress($rows['email']);
			}
			$mail->Subject = "Feedback";
			$mail->msgHTML($feedback);
		}

		if ($mail->send()) {
			$created_at = date("Y-m-d H:i:s");
			if (isset($_SESSION['user_id'])) {
				$query = "INSERT INTO user_feedback (user_id, user_name, user_email, feedback, created_at) VALUES ('".$_SESSION['user_id']."', '".$sender_name."', '".$sender_email."', '".$feedback."', '".$created_at."')";
				$result = mysqli_query($connection, $query);
				if ($result) {
					if ($_SESSION['role_id'] == 1) {
						header("location:../".$page."?post_id=".$post_id."&blog_id=".$blog_id."&category_id=".$category_id."");
					} else {
						header("location:../../user/".$page."?post_id=".$post_id."&blog_id=".$blog_id."&category_id=".$category_id."");
					}
				}
			} else {
				$query = "INSERT INTO user_feedback (user_name, user_email, feedback, created_at) VALUES ('".$sender_name."', '".$sender_email."', '".$feedback."', '".$created_at."')";
				$result = mysqli_query($connection, $query);
				if ($result) {
					header("location:../../index.php?post_id=".$post_id."&blog_id=".$blog_id."&category_id=".$category_id."");
				}
			}
		} else {
			header("location:../../index.php?post_id=".$post_id."&blog_id=".$blog_id."&category_id=".$category_id."");
		}
	}
}

?>