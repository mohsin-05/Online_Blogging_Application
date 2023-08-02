<?php
require("require/connection.php");
date_default_timezone_set("Asia/Karachi");
require_once("FPDF/fpdf.php");

$created_at = date("Y-m-d H:i:s");

$alpha_name_pattern = "/^[A-Z][a-z]{2,10}$/";
$email_pattern = "/^[a-z]{3,15}[0-9]{1,3}[@][a-z]{3,7}[.][a-z]{2,5}$/";
$password_pattern = '/^(?=.*\d)(?=.*[A-z])(?=.*\W).{8,}$/';

$msg = "";

$query = "SELECT email FROM user";
$result = mysqli_query($connection, $query);

if ($result->num_rows > 0) {
	extract($_POST);
	while($rows = mysqli_fetch_assoc($result)) {
		if ($email == $rows['email']) {
			$msg .= "Email Already Registered";
			header("location:index.php?register_msg=$msg");
			die();
		}
	}
}

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

if (isset($_POST['register'])) {
	extract($_POST);

	if (isset($_FILES['upload_image']) && $_FILES['upload_image']['size'] >= 1048576) {
		$msg .= "<li>File Size Must Not Exceed 1MB...!</li>";
		header("location:index.php?register_msg=$msg&color=danger");
	}

	if (!preg_match($alpha_name_pattern, $first_name)) {
		$msg .= "<li>First Name must be like eg: Sherry...!</li>";
		header("location:index.php?register_msg=$msg&color=danger");
	} else if ($first_name == "") {
		$msg .= "<li>Please Enter First Name...!</li>";
		header("location:index.php?register_msg=$msg&color=danger");
	}

	if (!preg_match($alpha_name_pattern, $last_name)) {
		$msg .= "<li>Last Name must be like eg: Santos...!</li>";
		header("location:index.php?register_msg=$msg&color=danger");
	} else if ($last_name == "") {
		$msg .= "<li>Please Enter Last Name...!</li>";
		header("location:index.php?register_msg=$msg&color=danger");
	}

	if (!preg_match($email_pattern, $email)) {
		$msg .= "<li>Email must be like eg: abc7@gmail.com...!</li>";
		header("location:index.php?register_msg=$msg&color=danger");
	} else if ($email == "") {
		$msg .= "<li>Please Enter Email...!</li>";
		header("location:index.php?register_msg=$msg&color=danger");
	}

	if (!preg_match($password_pattern, $password)) {
		$msg .= "<li>Password must be like eg: Aa@11111...!</li>";
		header("location:index.php?register_msg=$msg&color=danger");
	} else if ($password == "") {
		$msg .= "<li>Please Enter Password...!</li>";
		header("location:index.php?register_msg=$msg&color=danger");
	}

	if ($gender == "") {
		$msg .= "<li>Please Select Gender...!</li>";
		header("location:index.php?register_msg=$msg&color=danger");
	}

	if ($date_of_birth == "") {
		$msg .= "<li>Please Enter Date of Birth..!</li>";
		header("location:index.php?register_msg=$msg&color=danger");
	}

	if ($address == "") {
		$msg .= "<li>Please Enter Address...!</li>";
		header("location:index.php?register_msg=$msg&color=danger");
	}

	if ($msg == "") {

		$query = "SELECT email FROM USER WHERE role_id = 1";
		$result = mysqli_query($connection, $query);
		if ($result->num_rows > 0) {
			$mail->setFrom($email);
			while ($rows = mysqli_fetch_assoc($result)) {
				$mail->addAddress($rows['email']);
			}
			$mail->Subject = "Account Request";
			$mail->msgHTML($email);
		}

		if ($mail->send()) {

			$user_image = $_FILES['upload_image']['name'];
			$temp_name = $_FILES['upload_image']['tmp_name'];
			$destination = "images/".$user_image;
			move_uploaded_file($temp_name, $destination);

			$pdf = new FPDF();
			$pdf->AddPage("P", "letter");
			$pdf->setFont("Times", "B", 30);
			$pdf->Cell(0,20,"MY ACCOUNT INFORMATION",0,1,"C");
			$pdf->setLineWidth(2);
			$pdf->setDrawColor(255, 153, 0);
			$pdf->Line(0, 30, 500, 30);
			$pdf->ln();
			$pdf->setFont("Times", "B", 10);
			$pdf->setLineWidth(0);
			$pdf->setDrawColor(0, 0, 0);
			$pdf->Cell(100,10,"First Name: ",1,0,"C");
			$pdf->Cell(100,10,$first_name,1,1,'C');
			$pdf->Cell(100,10,"Last Name: ",1,0,"C");
			$pdf->Cell(100,10,$last_name,1,1,"C");
			$pdf->Cell(100,10,"Email: ",1,0,"C");
			$pdf->Cell(100,10,$email,1,1,"C");
			$pdf->Cell(100,10,"Password: ",1,0,"C");
			$pdf->Cell(100,10,$password,1,1,"C");
			$pdf->Cell(100,10,"Gender: ",1,0,"C");
			$pdf->Cell(100,10,$gender,1,1,"C");
			$pdf->Cell(100,10,"Date Of Birth: ",1,0,"C");
			$pdf->Cell(100,10,$date_of_birth,1,1,"C");
			$pdf->Cell(100,10,"Address: ",1,0,"C");
			$pdf->Cell(100,10,$address,1,1,"C");
			$pdf->Cell(100,10,"Created On: ",1,0,"C");
			$pdf->Cell(100,10,date("F dS"),1,1,"C");
			$pdf->Output("F", "MyAccount.pdf");

			$query = "INSERT INTO user (role_id, first_name, last_name, email, password, gender, date_of_birth, user_image, address, created_at) VALUES ('2', '".$first_name."', '".$last_name."', '".$email."', '".$password."', '".$gender."', '".$date_of_birth."', '".$user_image."', '".$address."', '".$created_at."')";
			$result = mysqli_query($connection, $query);
			if ($result) {
				header("location:index.php?register_msg=Registered Successfully...!&color=success&pdf=pdf&first_name=".$first_name."&last_name=".$last_name."&email=".$email."&password=".$password."&gender=".$gender."&date_of_birth=".$date_of_birth."&address=".$address."&created_at=".$created_at."");
			} else {
				header("location:index.php?register_msg=Registration Failed...!&color=danger");
			}
		}
	}
}

?>