<?php
session_start();
require("../../require/connection.php");
date_default_timezone_set("asia/karachi");

if (isset($_SESSION['user_id'])) {
	extract($_SESSION);
}

$alpha_name_pattern = "/^[A-Z][a-z]{2,10}$/";
$password_pattern = '/^(?=.*\d)(?=.*[A-z])(?=.*\W).{8,}$/';

$msg = "";

if (isset($_POST['register'])) {
	extract($_POST);

	if (!preg_match($alpha_name_pattern, $first_name)) {
		$msg .= "<li>First Name must be like eg: Sherry...!</li>";
		header("location:admin.php?update_msg=$msg&color=danger&post_id=".$post_id."&blog_id=".$blog_id."&category_id=".$category_id."");
	} else if ($first_name == "") {
		$msg .= "<li>Please Enter First Name...!</li>";
		header("location:admin.php?update_msg=$msg&color=danger&post_id=".$post_id."&blog_id=".$blog_id."&category_id=".$category_id."");
	}

	if (!preg_match($alpha_name_pattern, $last_name)) {
		$msg .= "<li>Last Name must be like eg: Santos...!</li>";
		header("location:admin.php?update_msg=$msg&color=danger&post_id=".$post_id."&blog_id=".$blog_id."&category_id=".$category_id."");
	} else if ($last_name == "") {
		$msg .= "<li>Please Enter Last Name...!</li>";
		header("location:admin.php?update_msg=$msg&color=danger&post_id=".$post_id."&blog_id=".$blog_id."&category_id=".$category_id."");
	}

	if (!preg_match($password_pattern, $password)) {
		$msg .= "<li>Password must be like eg: Aa@11111...!</li>";
		header("location:admin.php?update_msg=$msg&color=danger&post_id=".$post_id."&blog_id=".$blog_id."&category_id=".$category_id."");
	} else if ($password == "") {
		$msg .= "<li>Please Enter Password...!</li>";
		header("location:admin.php?update_msg=$msg&color=danger&post_id=".$post_id."&blog_id=".$blog_id."&category_id=".$category_id."");
	}

	if ($gender == "") {
		$msg .= "<li>Please Select Gender...!</li>";
		header("location:admin.php?update_msg=$msg&color=danger&post_id=".$post_id."&blog_id=".$blog_id."&category_id=".$category_id."");
	}

	if ($date_of_birth == "") {
		$msg .= "<li>Please Enter Date of Birth..!</li>";
		header("location:admin.php?update_msg=$msg&color=danger&post_id=".$post_id."&blog_id=".$blog_id."&category_id=".$category_id."");
	}

	if ($address == "") {
		$msg .= "<li>Please Enter Address...!</li>";
		header("location:admin.php?update_msg=$msg&color=danger&post_id=".$post_id."&blog_id=".$blog_id."&category_id=".$category_id."");
	}

	if ($msg == "") {
		$updated_at = date("Y-m-d H:i:s");
		
		if (isset($_FILES['upload_image']) && $_FILES['upload_image']['name'] != NULL) {
			$user_image = $_FILES['upload_image']['name'];
			$temp_name = $_FILES['upload_image']['tmp_name'];
			$destination = "images/".$user_image;
			move_uploaded_file($temp_name, $destination);
			$query = "UPDATE user SET first_name = '".$first_name."', last_name = '".$last_name."', password = '".$password."', gender = '".$gender."', date_of_birth = '".$date_of_birth."', user_image = '".$user_image."', address = '".$address."', updated_at = '".$updated_at."' WHERE user_id = '".$user_id."'";
			$result = mysqli_query($connection, $query);
			if ($result) {
				$query = "SELECT * FROM user WHERE user_id = '".$user_id."'";
				$result = mysqli_query($connection, $query);
				if ($result->num_rows > 0) {
					$row = mysqli_fetch_assoc($result);
					if ($_SESSION['user_id'] == $row['user_id']) {
						$_SESSION = $row;
					}
				}
				header("location:../".$page."?update_msg=Account Update Success&color=success&post_id=".$post_id."&blog_id=".$blog_id."&category_id=".$category_id."");
			}
		} else {
			$query = "UPDATE user SET first_name = '".$first_name."', last_name = '".$last_name."', password = '".$password."', gender = '".$gender."', date_of_birth = '".$date_of_birth."', address = '".$address."', updated_at = '".$updated_at."' WHERE user_id = '".$user_id."'";
			$result = mysqli_query($connection, $query);
			if ($result) {
				$query = "SELECT * FROM user WHERE user_id = '".$user_id."'";
				$result = mysqli_query($connection, $query);
				if ($result->num_rows > 0) {
					$row = mysqli_fetch_assoc($result);
					if ($_SESSION['user_id'] == $row['user_id']) {
						$_SESSION = $row;
					}
				}
				header("location:../".$page."?update_msg=Account Update Success&color=success&post_id=".$post_id."&blog_id=".$blog_id."&category_id=".$category_id."");
			}
		}
	}
}

?>