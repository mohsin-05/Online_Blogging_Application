<?php
require ("../../require/connection.php");
date_default_timezone_set("Asia/Karachi");

$msg = "";

if (isset($_FILES['upload_image']) && $_FILES['upload_image']['size'] >= 1048576) {
	$msg .= "<li>File Size Must Not Exceed 1MB...!</li>";
	header("location:../".$page."?message=$msg");
	die;
}

if (isset($_POST['update_blog'])) {
	extract($_POST);
	$updated_at = date("Y-m-d H:i:s");

	if (isset($_FILES['upload_image']) && $_FILES['upload_image']['name'] != NULL) {
		$blog_image = $_FILES['upload_image']['name'];
		$temp_name = $_FILES['upload_image']['tmp_name'];
		$destination = "../../images/".$blog_image;
		move_uploaded_file($temp_name, $destination);
		$query = "UPDATE blog SET blog_title = '".$blog_title."', blog_background_image = '".$blog_image."', post_per_page = '".$post_per_page."', updated_at = '".$updated_at."' WHERE blog_id = '".$blog_id."'";
		$result = mysqli_query($connection, $query);
		if ($result) {
			header("location:../".$page."");
		}
	} else {
		$query = "UPDATE blog SET blog_title = '".$blog_title."', post_per_page = '".$post_per_page."', updated_at = '".$updated_at."' WHERE blog_id = '".$blog_id."'";
		$result = mysqli_query($connection, $query);
		if ($result) {
			header("location:../".$page."");
		}
	}
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'active') {
	$query = "UPDATE blog SET blog_status = 'Active' WHERE blog_id = '".$_REQUEST['blog_id']."'";
	$result = mysqli_query($connection, $query);
	if ($result) {
		echo "<h4>The Blog with ID '".$_REQUEST['blog_id']."' is Active</h4>";
	}
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'inactive') {
	$query = "UPDATE blog SET blog_status = 'InActive' WHERE blog_id = '".$_REQUEST['blog_id']."'";
	$result = mysqli_query($connection, $query);
	if ($result) {
		echo "<h4>The Blog with ID '".$_REQUEST['blog_id']."' is InActive</h4>";
	}
}

?>