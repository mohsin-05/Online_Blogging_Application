<?php
session_start();
require("../../require/connection.php");
date_default_timezone_set("Asia/Karachi");

$created_at = date("Y-m-d H:i:s");
if (isset($_POST['add_setting'])) {
	extract($_POST);
	$query = "SELECT * FROM setting WHERE user_id = '".$_SESSION['user_id']."'";
	$result = mysqli_query($connection, $query);
	if ($result->num_rows > 0) {
		while ($rows = mysqli_fetch_assoc($result)) {
			if ($_POST['setting_key'] == $rows['setting_key']) {
				header("location:../".$page."?setting_msg=Setting already exits&color=danger&post_id=".$post_id."&blog_id=".$blog_id."&category_id=".$category_id."");
				die();
			} 
		}
	}

	$query = "INSERT INTO setting (user_id, setting_key, setting_value, setting_status, created_at) 
	VALUES ('".$_SESSION['user_id']."', '".$setting_key."', '".$setting_value."', 'Active', '".$created_at."')";
	$result = mysqli_query($connection, $query);
	if ($result) {
		header("location:../".$page."?setting_msg=Setting Added Successfully&post_id=".$post_id."&blog_id=".$blog_id."&category_id=".$category_id."");
	} else {
		header("location:../".$page."?setting_msg=Setting was not added&color=danger&post_id=".$post_id."&blog_id=".$blog_id."&category_id=".$category_id."");
	}
}

?>