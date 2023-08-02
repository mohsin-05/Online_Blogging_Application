<?php
session_start();
require ("../../require/connection.php");
date_default_timezone_set("Asia/Karachi");

$query = "SELECT blog_title FROM blog";
$result = mysqli_query($connection, $query);

$msg = "";

if ($result->num_rows > 0) {
	extract($_POST);
	while($rows = mysqli_fetch_assoc($result)) {
		if ($blog_title == $rows['blog_title']) {
			$msg .= "A Blog with this title already exists...!";
			header("location:../".$page."?message=$msg");
			die();
		}
	}
}

if (isset($_FILES['upload_image']) && $_FILES['upload_image']['size'] >= 1048576) {
	$msg .= "<li>File Size Must Not Exceed 1MB...!</li>";
	header("location:../".$page."?message=$msg");
	die;
}

if (isset($_POST['create_blog'])) {
	extract($_POST);

	$blog_background_image = $_FILES['upload_image']['name'];
	$temp_name = $_FILES['upload_image']['tmp_name'];
	$destination = "../../images/".$blog_background_image;
	move_uploaded_file($temp_name, $destination);
	$created_at = date("Y-m-d H:i:s");
	$query = "INSERT INTO blog (user_id, blog_title, post_per_page, blog_background_image, blog_status, created_at) VALUES ('".$_SESSION['user_id']."', '".$blog_title."', '.$post_per_page.', '".$blog_background_image."', 'Active', '".$created_at."')";
	$result = mysqli_query($connection, $query);
	if ($result) {
		header("location:../".$page."");
	}
}

?>