<?php
session_start();
require("../../require/connection.php");
date_default_timezone_set("asia/karachi");

$alpha_name_pattern = "/^[A-Z][a-z]{2,10}$/";

$msg = "";

if (isset($_FILES['upload_image']) && $_FILES['upload_image']['size'] >= 1048576) {
	$msg .= "<li>File Size Must Not Exceed 1MB...!</li>";
	header("location:../".$page."?message=$msg");
	die;
}

if (isset($_POST['register'])) {
	extract($_POST);

	if (!preg_match($alpha_name_pattern, $first_name)) {
		$msg .= "<li>First Name must be like eg: Mohsin...!</li>";
		header("location:manage-users.php?update_user_message=$msg");
	}

	if (!preg_match($alpha_name_pattern, $last_name)) {
		$msg .= "<li>Last Name must be like eg: Sahito...!</li>";
		header("location:manage-users.php?update_user_message=$msg");
	} 

	if ($msg == "") {
		$updated_at = date("Y-m-d H:i:s");
		
		if (isset($_FILES['upload_image']) && $_FILES['upload_image']['name'] != NULL) {
			$user_image = $_FILES['upload_image']['name'];
			$temp_name = $_FILES['upload_image']['tmp_name'];
			$destination = "../../images/".$user_image;
			move_uploaded_file($temp_name, $destination);
			$query = "UPDATE user SET first_name = '".$first_name."', last_name = '".$last_name."', gender = '".$gender."', date_of_birth = '".$date_of_birth."', user_image = '".$user_image."', address = '".$address."', updated_at = '".$updated_at."' WHERE user_id = '".$user_id."'";
			$result = mysqli_query($connection, $query);
			if ($result) {
				header("location:manage-users.php?update_message=Account With User ID $user_id has been Updated");
			}
		} else {
			$query = "UPDATE user SET first_name = '".$first_name."', last_name = '".$last_name."', gender = '".$gender."', date_of_birth = '".$date_of_birth."', address = '".$address."', updated_at = '".$updated_at."' WHERE user_id = '".$user_id."'";
			$result = mysqli_query($connection, $query);
			if ($result) {
				header("location:manage-users.php?update_message=Account With User ID $user_id has been Updated");
			}
		}
	}
}

if (isset($_POST['change_role'])) {
	extract($_POST);

	$query = "UPDATE user SET role_id = '".$role."' WHERE user_id = '".$user_id."'";
	$result = mysqli_query($connection, $query);

	if ($result) {
		header("location:manage-users.php?update_message=Account With User ID $user_id has been Updated");
	}
}

?>