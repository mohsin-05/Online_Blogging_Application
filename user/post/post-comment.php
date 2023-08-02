<?php
session_start();
require("../../require/connection.php");

if (isset($_POST['add_comment'])) {
	extract($_POST);
	
	$created_at = date("Y-m-d H:i:s");
	$query = "INSERT INTO post_comment (post_id, user_id, comment, is_active, created_at) VALUES ('".$post_id."', '".$_SESSION['user_id']."', '".$comment."', 'Active', '".$created_at."')";
	$result = mysqli_query($connection, $query);
	if ($result) {
		if (isset($blog_id)) {
			header("location:../".$page."?post_id=".$post_id."&user_id=".$user_id."&blog_id=".$blog_id."");
		} else {
			header("location:../".$page."?post_id=".$post_id."&user_id=".$user_id."");
		}
	}
}

?>