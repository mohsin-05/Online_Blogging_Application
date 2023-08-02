<?php
require ("../../require/connection.php");
date_default_timezone_set("Asia/Karachi");

$msg = "";

if (isset($_FILES['upload_image']) && $_FILES['upload_image']['size'] >= 1048576) {
	$msg .= "<li>File Size Must Not Exceed 1MB...!</li>";
	header("location:../".$page."?message=$msg");
	die;
}

if (isset($_POST['update_post'])) {
	extract($_POST);
	$updated_at = date("Y-m-d H:i:s");
	$post_description = str_replace("'", "", $post_description);

	if (isset($_FILES['upload_image']) && $_FILES['upload_image']['name'] != NULL) {
		$post_image = $_FILES['upload_image']['name'];
		$temp_name = $_FILES['upload_image']['tmp_name'];
		$destination = "images/".$post_image;
		move_uploaded_file($temp_name, $destination);
		$query = "UPDATE post SET blog_id = '".$blog."', post_title = '".$post_title."', post_summary = '".$post_summary."', post_description = '".$post_description."', featured_image = '".$post_image."', is_comment_allowed = '".$comment_allowed."', updated_at = '".$updated_at."' WHERE post_id = '".$post_id."'";
		$result = mysqli_query($connection, $query);

		$query = "UPDATE post_category SET category_id = '".$category."', updated_at = '".$updated_at."' WHERE post_id = '".$post_id."'";
		$result = mysqli_query($connection, $query);

		if (isset($_FILES['upload_attachment']['name']) && $_FILES['upload_attachment']['name'][0] != "") {
			foreach ($_FILES['upload_attachment']['name'] as $key => $value) {
				$attachment_name = $value;
				$temp_name = $_FILES['upload_attachment']['tmp_name'][$key];
				$destination = "../../files/".$attachment_name;
				move_uploaded_file($temp_name, $destination);
				$query_attachment = "INSERT INTO post_atachment (post_id, post_attachment_title, post_attachment_path, is_active, created_at) VALUES ('".$post_id."', 'Attachment-".rand()."', '".$attachment_name."', 'Active', '".$updated_at."')";
				$result_attachment = mysqli_query($connection, $query_attachment);
			}
		}

		if ($result) {
			header("location:../".$page."");
		}
	} else {
		$query = "UPDATE post SET blog_id = '".$blog."', post_title = '".$post_title."', post_summary = '".$post_summary."', post_description = '".$post_description."', is_comment_allowed = '".$comment_allowed."', updated_at = '".$updated_at."' WHERE post_id = '".$post_id."'";
		$result = mysqli_query($connection, $query);

		if (isset($_FILES['upload_attachment']['name']) && $_FILES['upload_attachment']['name'][0] != "") {
			foreach ($_FILES['upload_attachment']['name'] as $key => $value) {
				$attachment_name = $value;
				$temp_name = $_FILES['upload_attachment']['tmp_name'][$key];
				$destination = "../../files/".$attachment_name;
				move_uploaded_file($temp_name, $destination);
				$query_attachment = "INSERT INTO post_atachment (post_id, post_attachment_title, post_attachment_path, is_active, created_at) VALUES ('".$post_id."', 'Attachment-".rand()."', '".$attachment_name."', 'Active', '".$updated_at."')";
				$result_attachment = mysqli_query($connection, $query_attachment);
			}
		}

		if ($result) {
			header("location:../".$page."");
		}

		$query = "UPDATE post_category SET category_id = '".$category."', updated_at = '".$updated_at."' WHERE post_id = '".$post_id."'";
		$result = mysqli_query($connection, $query);
	}
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'active') {
	$query = "UPDATE post SET post_status = 'Active' WHERE post_id = '".$_REQUEST['post_id']."'";
	$result = mysqli_query($connection, $query);
	if ($result) {
		echo "<h4>The post with ID '".$_REQUEST['post_id']."' is Active</h4>";
	}
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'inactive') {
	$query = "UPDATE post SET post_status = 'InActive' WHERE post_id = '".$_REQUEST['post_id']."'";
	$result = mysqli_query($connection, $query);
	if ($result) {
		echo "<h4>The post with ID '".$_REQUEST['post_id']."' is InActive</h4>";
	}
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'active_attachment') {
	$query = "UPDATE post_atachment SET is_active = 'Active' WHERE post_atachment_id = '".$_REQUEST['post_attachment_id']."'";
	$result = mysqli_query($connection, $query);
	if ($result) {
		echo "<h4>The attachment with ID '".$_REQUEST['post_attachment_id']."' is Active</h4>";
	}
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'inactive_attachment') {
	$query = "UPDATE post_atachment SET is_active = 'InActive' WHERE post_atachment_id = '".$_REQUEST['post_attachment_id']."'";
	$result = mysqli_query($connection, $query);
	if ($result) {
		echo "<h4>The attachment with ID '".$_REQUEST['post_attachment_id']."' is InActive</h4>";
	}
}

?>