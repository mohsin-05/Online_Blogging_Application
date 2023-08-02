<?php
require ("../../require/connection.php");
date_default_timezone_set("Asia/Karachi");

if (isset($_POST['update_category'])) {
	extract($_POST);

	$updated_at = date("Y-m-d H:i:s");
	$query = "UPDATE category SET category_title = '".$category_title."', category_description = '".$category_description."', updated_at = '".$updated_at."' WHERE category_id = '".$category_id."'";
	$result = mysqli_query($connection, $query);
	if ($result) {
		header("location:../".$page."");
	}
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'active') {
	$query = "UPDATE category SET category_status = 'Active' WHERE category_id = '".$_REQUEST['category_id']."'";
	$result = mysqli_query($connection, $query);
	if ($result) {
		echo "<h4>The Category with ID '".$_REQUEST['category_id']."' is Active</h4>";
	}
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'inactive') {
	$query = "UPDATE category SET category_status = 'InActive' WHERE category_id = '".$_REQUEST['category_id']."'";
	$result = mysqli_query($connection, $query);
	if ($result) {
		echo "<h4>The Category with ID '".$_REQUEST['category_id']."' is InActive</h4>";
	}
}

?>