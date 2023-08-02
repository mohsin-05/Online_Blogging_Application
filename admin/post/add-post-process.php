<?php
require ("../../require/connection.php");
date_default_timezone_set("Asia/Karachi");
$created_at = date("Y-m-d H:i:s");

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

if (isset($_FILES['upload_image']) && $_FILES['upload_image']['size'] >= 1048576) {
	extract($_POST);
	$msg .= "<li>File Size Must Not Exceed 1MB...!</li>";
	header("location:../".$page."?message=$msg&post_id=".$post_id."&blog_id=".$blog_id."");
	die;
}

if (isset($_POST['add_post'])) {
	extract($_POST);
	$post_description = str_replace("'", "", $post_description);

	$query_notification = "SELECT email, blog_title FROM USER u INNER JOIN following_blog f ON u.user_id = f.follower_id 
	INNER JOIN blog b ON f.blog_following_id = b.blog_id WHERE blog_id = '".$blog."'";
	$result_notification = mysqli_query($connection, $query_notification);
	if ($result_notification->num_rows > 0) {
		$mail->setFrom('hist6782@gmail.com');
		while ($rows_notification = mysqli_fetch_assoc($result_notification)) {
			$mail->addAddress($rows_notification['email']);
		}
		$mail->Subject = "New Post Added";
		$mail->msgHTML($post_summary);
		$mail->send(); 
	}
		
	$post_image = $_FILES['upload_image']['name'];
	$temp_name = $_FILES['upload_image']['tmp_name'];
	$destination = "../../images/".$post_image;
	move_uploaded_file($temp_name, $destination);
	$query = "INSERT INTO post (blog_id, post_title, post_summary, post_description, featured_image, post_status, is_comment_allowed, created_at) VALUES ('".$blog."', '".$post_title."', '".$post_summary."', '".$post_description."', '".$post_image."', 'Active', '".$comment_allowed."', '".$created_at."')";
	$result = mysqli_query($connection, $query);

	$query = "SELECT post_id FROM post WHERE created_at = '".$created_at."'";
	$result = mysqli_query($connection, $query);
	$row = mysqli_fetch_assoc($result);

	$query = "INSERT INTO post_category (post_id, category_id, created_at) VALUES ('".$row['post_id']."', '".$category."', '".$created_at."')";
	$result = mysqli_query($connection, $query);
	if (isset($_FILES['upload_attachment']['name']) && $_FILES['upload_attachment']['name'][0] != "") {
		foreach ($_FILES['upload_attachment']['name'] as $key => $value) {
			$attachment_name = $value;
			$temp_name = $_FILES['upload_attachment']['tmp_name'][$key];
			$destination = "../../files/".$attachment_name;
			move_uploaded_file($temp_name, $destination);
			$query_attachment = "INSERT INTO post_atachment (post_id, post_attachment_title, post_attachment_path, is_active, created_at) VALUES ('".$row['post_id']."', 'Attachment-".rand()."', '".$attachment_name."', 'Active', '".$created_at."')";
			$result_attachment = mysqli_query($connection, $query_attachment);
		}
	}
	if ($result) {
		header("location:../".$page."?post_id=".$post_id."&blog_id=".$blog_id."");
	} else {
		header("location:../".$page."?post_id=".$post_id."&blog_id=".$blog_id."");
	}
}

?>