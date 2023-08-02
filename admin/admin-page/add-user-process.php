<?php
require("../../require/connection.php");
date_default_timezone_set("asia/karachi");

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
			header("location:../admin-page/admin.php?message=$msg&post_id=".$post_id."&blog_id=".$blog_id."");
			die();
		}
	}
}

if (isset($_POST['register'])) {
	extract($_POST);
		header("location:../admin-page/admin.php?message=$msg&post_id=".$post_id."&blog_id=".$blog_id."");

	if (!preg_match($alpha_name_pattern, $first_name)) {
		$msg .= "<li>First Name must be like eg: Sherry...!</li>";
		header("location:../admin-page/admin.php?message=$msg&post_id=".$post_id."&blog_id=".$blog_id."");
	} else if ($first_name == "") {
		$msg .= "<li>Please Enter First Name...!</li>";
		header("location:../admin-page/admin.php?message=$msg&post_id=".$post_id."&blog_id=".$blog_id."");
	}

	if (!preg_match($alpha_name_pattern, $last_name)) {
		$msg .= "<li>Last Name must be like eg: Santos...!</li>";
		header("location:../admin-page/admin.php?message=$msg&post_id=".$post_id."&blog_id=".$blog_id."");
	} else if ($last_name == "") {
		$msg .= "<li>Please Enter Last Name...!</li>";
		header("location:../admin-page/admin.php?message=$msg&post_id=".$post_id."&blog_id=".$blog_id."");
	}

	if (!preg_match($email_pattern, $email)) {
		$msg .= "<li>Email must be like eg: abc7@gmail.com...!</li>";
		header("location:../admin-page/admin.php?message=$msg&post_id=".$post_id."&blog_id=".$blog_id."");
	} else if ($email == "") {
		$msg .= "<li>Please Enter Email...!</li>";
		header("location:../admin-page/admin.php?message=$msg&post_id=".$post_id."&blog_id=".$blog_id."");
	}

	if (!preg_match($password_pattern, $password)) {
		$msg .= "<li>Password must be like eg: Aa@11111...!</li>";
		header("location:../admin-page/admin.php?message=$msg&post_id=".$post_id."&blog_id=".$blog_id."");
	} else if ($password == "") {
		$msg .= "<li>Please Enter Password...!</li>";
		header("location:../admin-page/admin.php?message=$msg&post_id=".$post_id."&blog_id=".$blog_id."");
	}

	if ($gender == "") {
		$msg .= "<li>Please Select Gender...!</li>";
		header("location:../admin-page/admin.php?message=$msg&post_id=".$post_id."&blog_id=".$blog_id."");
	}

	if ($date_of_birth == "") {
		$msg .= "<li>Please Enter Date of Birth..!</li>";
		header("location:../admin-page/admin.php?message=$msg&post_id=".$post_id."&blog_id=".$blog_id."");
	}

	if ($address == "") {
		$msg .= "<li>Please Enter Address...!</li>";
		header("location:../admin-page/admin.php?message=$msg&post_id=".$post_id."&blog_id=".$blog_id."");
	}

	if ($msg == "") {
		$user_image = $_FILES['upload_image']['name'];
		$temp_name = $_FILES['upload_image']['tmp_name'];
		$destination = "images/".$user_image;
		move_uploaded_file($temp_name, $destination);
		$created_at = date("Y-m-d H:i:s");
		$query = "INSERT INTO user (role_id, first_name, last_name, email, password, gender, date_of_birth, user_image, address, created_at) VALUES ('2', '".$first_name."', '".$last_name."', '".$email."', '".$password."', '".$gender."', '".$date_of_birth."', '".$user_image."', '".$address."', '".$created_at."')";
		$result = mysqli_query($connection, $query);
		if ($result) {
			header("location:../".$page."&post_id=".$post_id."&blog_id=".$blog_id."");
		}
	}
}

?>