<?php
session_start();
require("../../require/connection.php");

$page = "blog/blog-page.php";
$blog_id = $_REQUEST['blog_id'];
$flag = false;
$followers = 0;

$query = "SELECT * FROM user INNER JOIN blog ON user.user_id = blog.user_id WHERE blog.blog_id = '".$_REQUEST['blog_id']."' AND blog_status = 'Active'";
$result = mysqli_query($connection, $query);
$row_blog = mysqli_fetch_assoc($result);

$query = "SELECT * FROM following_blog";
$result = mysqli_query($connection, $query);
if ($result->num_rows > 0) {
	while ($rows = mysqli_fetch_assoc($result)) {
		if ($rows['follower_id'] == $_SESSION['user_id'] && $rows['blog_following_id'] == $_REQUEST['blog_id'] && $rows['status'] == 'Followed') { 
			$flag = true;
		}
	}
}

$query = "SELECT COUNT(follower_id) AS 'followers' FROM following_blog 
WHERE blog_following_id = '".$_REQUEST['blog_id']."' AND status = 'Followed'";
$result = mysqli_query($connection, $query);
if ($result->num_rows > 0) {
	$row = mysqli_fetch_assoc($result);
	$followers = $row['followers'];
}

include("../../require/forms.php");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blog Page</title>
	<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
	<style>
		.navbar{
			background-color: #2D2727;
		}
		body{
			background-image: url("../../images/<?php echo $row_blog['blog_background_image']; ?>");
		}
	</style>
</head>
<body>

<!-- Navbar -->

<?php
include("../user-require/user-navbar.php");
?>

<!-- Navbar End -->


<!-- Sidebar -->

<?php
include("../user-require/user-sidebar.php");
?>

<!-- Sidebar End -->

<script>
	function follow(follow_unfollow, blog_id) {
		var obj;
		if (window.ActiveXObject) {
			obj = new ActiveXObject("Microsoft.XMLHTTP");
		} else {
			obj = new XMLHttpRequest();
		}

		obj.onreadystatechange = function () {
			if (obj.readyState == 4 && obj.status == 200) {
				document.getElementById('follow_button').innerHTML = obj.responseText;
			}
		}

		obj.open("GET", "follow-blog-process.php?action="+follow_unfollow+"&blog_id="+blog_id);
		obj.send();
	}
</script>

<div class="container-fluid my-5 px-5">
	<div class="row">
		<div class="col">
			<?php if (isset($row_blog['blog_title'])) {
				echo "<h2 class='text-primary fw-bold'>".$row_blog['blog_title']."</h2>";
				echo "<h4 class='text-danger'><img class='image-fluid rounded-circle mx-2' style='height: 40px;' src='../../images/".$row_blog['user_image']."'>".$row_blog['first_name']."</h4>"; 
				?>
				<button type="button" class="btn btn-primary">
					Followers <span class="badge text-bg-dark"><?php echo $followers; ?></span>
				</button>
				<?php
			} ?>
		</div>

		<div class="col" id="follow_button">
			<?php if ($flag == true && isset($row_blog['blog_id'])) { ?>
				<button class="btn btn-dark rounded-pill float-end" onclick="follow('unfollow', <?php echo $row_blog['blog_id']; ?>)">Followed</button>
				<?php 
			} else if ( isset($row_blog['blog_id']) ) { ?>
				<button class="btn btn-dark rounded-pill float-end" onclick="follow('follow', <?php echo $row_blog['blog_id']; ?>)">Follow</button>
				<?php
			} ?>
		</div>
	</div>
</div>

<?php
$query = "SELECT * FROM USER INNER JOIN blog ON user.user_id = blog.user_id 
INNER JOIN post ON blog.blog_id = post.blog_id 
INNER JOIN post_category ON post.`post_id` = post_category.`post_id` 
INNER JOIN category ON post_category.`category_id` = category.`category_id` 
WHERE blog.`blog_id` = '".$_REQUEST['blog_id']."' AND blog.`blog_status` = 'Active' AND user.`is_active` = 'Active' AND post.`post_status` = 'Active' AND category.`category_status` = 'Active'
ORDER BY post.post_id DESC LIMIT 5";
$result = mysqli_query($connection, $query);

if ($result->num_rows > 0) { ?>
	<div class="row row-cols-1 row-cols-md-2 g-4 p-3"><?php
	while ($rows = mysqli_fetch_assoc($result)) { ?>
		<div class="col">
			<div class="card">
				<img src="../../images/<?php echo $rows['featured_image']; ?>" class="card-img-top" alt="..." style="height: 480px;">
				<div class="card-body">
					<h5 class="card-title"><?php echo $rows['post_title']; ?></h5>
					<hr>
			        <p class="card-text"><span class="d-inline-block text-truncate" style="max-width: 300px;"><?php echo $rows['post_summary']; ?></span></p>
			        <p class="card-text"><small class="text-body-secondary">Created On <?php echo date("F dS", strtotime($rows['created_at'])); ?></small></p>
			        <p class="card-text text-center"><button type="button" class="btn mb-2" style="background-color: white; color: #2D2727; width: 120px;"><a class="page-link" href="../post/post-page.php?post_id=<?php echo $rows['post_id']; ?>&user_id=<?php echo $rows['user_id']; ?>">See More</a></button></p>
			    </div>
			</div>
		</div>
	<?php 
	} ?></div><?php
} else {
	echo "<h4 class='text-center'>No Posts in this Blog</h4>";
}



include ("../../require/footer.php");
?>