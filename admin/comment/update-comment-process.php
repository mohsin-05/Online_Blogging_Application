<?php
require("../../require/connection.php");

if (isset($_POST['update_comment'])) {
	extract($_POST);

	$query = "UPDATE post_comment SET comment = '".$comment."' WHERE post_comment_id = '".$post_comment_id."'";
	$result = mysqli_query($connection, $query);
	if ($result) {
		header("location:manage-comments.php");
	}
}

?>