<?php
session_start();
require("../../require/connection.php");
date_default_timezone_set("Asia/Karachi");
$flag = false;
$created_at = date("Y-m-d H:i:s");
$updated_at = date("Y-m-d H:i:s");
$follow_id = "";

if (isset($_REQUEST['action'])) { 
	$query = "SELECT * FROM following_blog";
	$result = mysqli_query($connection, $query);
	if ($result->num_rows > 0) {
		while ($rows = mysqli_fetch_assoc($result)) {
			if ($rows['follower_id'] == $_SESSION['user_id'] && $rows['blog_following_id'] == $_REQUEST['blog_id']) {
				$flag = true;
				$follow_id .= $rows['follow_id'];
			}
		}
	}

	if ($flag == true && $_REQUEST['action'] == 'follow') {
		$query = "UPDATE following_blog SET status = 'Followed', updated_at = '".$updated_at."' WHERE follow_id = '".$follow_id."'";
		$result = mysqli_query($connection, $query);
		if ($result) {
			?>
			<button class="btn btn-dark rounded-pill float-end" onclick="follow('unfollow', <?php echo $_REQUEST['blog_id']; ?>)">Followed</button>
			<?php
		}

	} else if ( $flag == false && $_REQUEST['action'] == 'follow' ) {
		$query = "INSERT INTO following_blog (follower_id, blog_following_id, status, created_at) VALUES ('".$_SESSION['user_id']."', '".$_REQUEST['blog_id']."', 'Followed', '".$created_at."')";
		$result = mysqli_query($connection, $query);
		if ($result) {
			?>
			<button class="btn btn-dark rounded-pill float-end" onclick="follow('unfollow', <?php echo $_REQUEST['blog_id']; ?>)">Followed</button>
			<?php
		}

	} else if ( $flag == true && $_REQUEST['action'] == 'unfollow' ) {
		$query = "UPDATE following_blog SET status = 'Unfollowed', updated_at = '".$updated_at."' WHERE follow_id = '".$follow_id."'";
		$result = mysqli_query($connection, $query);
		if ($result) {
			?>
			<button class="btn btn-dark rounded-pill float-end" onclick="follow('follow', <?php echo $_REQUEST['blog_id']; ?>)">Follow</button>
			<?php
		}

	} else if ( $flag == false && $_REQUEST['action'] == 'unfollow' ) {
		$query = "INSERT INTO following_blog (follower_id, blog_following_id, status, created_at) VALUES ('".$_SESSION['user_id']."', '".$_REQUEST['blog_id']."', 'Unfollowed', '".$created_at."')";
		$result = mysqli_query($connection, $query);
		if ($result) {
			?>
			<button class="btn btn-dark rounded-pill float-end" onclick="follow('follow', <?php echo $_REQUEST['blog_id']; ?>)">Follow</button>
			<?php
		}
	}
}

?>