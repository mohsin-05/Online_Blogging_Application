<?php
require ("../../require/connection.php");
date_default_timezone_set("Asia/Karachi");

$query = "SELECT category_title FROM category";
$result = mysqli_query($connection, $query);

if ($result->num_rows > 0) {
	extract($_POST);
	while($rows = mysqli_fetch_assoc($result)) {
		if ($category_title == $rows['category_title']) {
			$msg .= "Category Exists";
			header("location:../".$page."?message=$msg");
			die();
		}
	}
}

if (isset($_POST['create_category'])) {
	extract($_POST);

	$created_at = date("Y-m-d H:i:s");
	$query = "INSERT INTO category (category_title, category_description, category_status, created_at) VALUES ('".$category_title."', '".$category_description."', 'Active', '".$created_at."')";
	$result = mysqli_query($connection, $query);
	if ($result) {
		header("location:../".$page."");
	}
}

?>