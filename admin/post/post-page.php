<?php
session_start();
require("../../require/connection.php");

$query = "SELECT * FROM blog INNER JOIN post ON blog.blog_id = post.blog_id WHERE post.post_id = '".$_REQUEST['post_id']."' AND post.post_status = 'Active' AND blog.blog_status = 'Active'";
$post_id = $_REQUEST['post_id'];
if (isset($_REQUEST['user_id'])) {
	$user_id = $_REQUEST['user_id'];
}
$result = mysqli_query($connection, $query);
$row_post = mysqli_fetch_assoc($result);

$page = "post/post-page.php";
$flag = false;
$followers = 0;

if (isset($row_post)) {

	$query = "SELECT * FROM following_blog";
	$result = mysqli_query($connection, $query);
	if ($result->num_rows > 0) {
		while ($rows = mysqli_fetch_assoc($result)) {
			if (isset($_SESSION['user_id']) && $rows['follower_id'] == $_SESSION['user_id'] && $rows['blog_following_id'] == $row_post['blog_id'] && $rows['status'] == 'Followed') { 
				$flag = true;
			}
		}
	}

	$query = "SELECT COUNT(follower_id) AS 'followers' FROM following_blog WHERE blog_following_id = '".$row_post['blog_id']."' AND status = 'Followed'";
	$result = mysqli_query($connection, $query);
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$followers = $row['followers'];
	}
}

$query = "SELECT * FROM setting WHERE user_id = '".$_SESSION['user_id']."' AND setting_status = 'Active'";
$result_setting = mysqli_query($connection, $query);

include("../../require/forms.php");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Post Page</title>
	<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
	<style>
		.navbar{
			background-color: #2D2727;
		}
		td{
			text-align: center;
  			vertical-align: middle;
		}
		th{
			text-align: center;
  			vertical-align: middle;
		}
		#post_description{
			text-align: justify;
			<?php if ($result_setting->num_rows > 0) {
				while ($rows = mysqli_fetch_assoc($result_setting)) {
					echo $rows['setting_key'].":".$rows['setting_value'].";";
				}
			} ?>
		}
		body{
			background-image: url("../../images/<?php echo $row_post['blog_background_image']; ?>");
		}
	</style>
</head>
<body>


<?php if (isset($_SESSION['user_id'])) {
	
 ?>
<!-- Navbar -->

<?php
include("../admin-require/admin-navbar.php");
?>

<!-- Navbar End -->

<?php
} else { ?>

<?php
$query = "SELECT * FROM category WHERE category_status = 'Active'";
$result_category = mysqli_query($connection, $query);
if ($result_category->num_rows > 0) {
	while ($row_category = mysqli_fetch_assoc($result_category)) {
		$category_title[] = $row_category['category_title'];
		$row_category_id[] = $row_category['category_id'];
	}
}
?>

<!-- Navbar -->

	<nav class="navbar navbar-expand-lg fixed-top mb-5" data-bs-theme="dark">
		<div class="container-fluid">
			<button class="btn text-white" style="background-color: #2D2727;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list mx-2" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/></svg>
				Menu
			</button>
			<img class="rounded-circle px-2 my-1" src="../../images/logo3.jpg" alt="logo" style="height: 60px;">
			<a class="navbar-brand my-2" href="#">Online Blogging Application</a>
			<a class="page-link text-white my-2" href="../../index.php">Home</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
				<button class="btn text-white mx-2" type="submit" data-bs-toggle="modal" data-bs-target="#staticBackdropLogin">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right mx-2" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/><path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/></svg>
					Login
				</button>
				<button class="btn rounded-pill" type="submit" data-bs-toggle="modal" data-bs-target="#staticBackdropRegister" style="background-color: white; color: #2D2727">Register</button>
			</div>
		</div>
	</nav>

<!-- Navbar End -->

<?php
}

if (isset($_SESSION['user_id']) && $_SESSION['role_id'] == 1) {

?>

<!-- Sidebar -->

<?php
include("../admin-require/admin-sidebar.php");
?>

<!-- Sidebar End -->


<?php
} else if (isset($_SESSION['user_id']) && $_SESSION['role_id'] == 2) {
	include("../../user/user-require/user-sidebar.php");
} else { 
?>


<!-- Sidebar -->

	<div class="offcanvas offcanvas-start text-white opacity-75" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" style="background-color: #2D2727">
		<div class="offcanvas-header" data-bs-theme="dark">
			<h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>
		<div class="offcanvas-body">
			<li class="list-group-item text-white fw-bolder" style="background-color: #2D2727;">Categories</li>
			<ul class="list-group list-group-flush">
				<?php foreach ($category_title as $key => $value) { ?>
					<li class="list-group-item text-white" style="background-color: #2D2727;"><a class="page-link" href="../category/category-page.php?category_id=<?php echo $row_category_id[$key]; ?>"><?php echo $value; ?></a></li>
					<?php
				} ?>
			</ul>
			<br>
			<li class="list-group-item text-white fw-bolder" style="background-color: #2D2727;"><a class="page-link" href="../about-us/about-us.php">About Us</a></li>
		</div>
	</div>

<!-- Sidebar End -->


<?php	
} 
?>

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

		obj.open("GET", "../blog/follow-blog-process.php?action="+follow_unfollow+"&blog_id="+blog_id);
		obj.send();
	}
</script>

<div class="container-fluid mb-5 p-5" id="blog_heading">
	<div class="row">
		<div class="col">
			<?php if (isset($row_post['blog_title'])) {
			 echo "<h2 class='text-primary fw-bold'>".$row_post['blog_title']."</h2>";
			 ?>
			<button type="button" class="btn btn-primary">
				Followers <span class="badge text-bg-dark"><?php echo $followers; ?></span>
			</button>
			<button type="button" class="btn btn-info">
				<a class="page-link" href="../blog/blog-page.php?blog_id=<?php echo $row_post['blog_id']; ?>">Go to Page</a>
			</button>
			 <?php
			} 
			 ?>
		</div>
		<div class="col" id="follow_button">
			<?php 
			if ($flag == true && isset($row_post['blog_id']) && isset($_SESSION['user_id'])) { 
			?>
				<button class="btn btn-dark rounded-pill float-end" onclick="follow('unfollow', <?php echo $row_post['blog_id']; ?>)">Followed</button>
			<?php 
			} else if ( isset($row_post['blog_id']) && isset($_SESSION['user_id']) ) { ?>
				<button class="btn btn-dark rounded-pill float-end" onclick="follow('follow', <?php echo $row_post['blog_id']; ?>)">Follow</button>
			<?php
			}
			?>
		</div>
	</div>
</div>

<?php
if (isset($row_post)) { ?>
	<div class="container-fluid my-5" style="width: 70%;">
		<div class="row">
			<div class="col">
				<div class="card mb-3" style="border-style: none;">
					<img src="../../images/<?php echo $row_post['featured_image']; ?>" class="card-img-top" alt="...">
					<div class="card-body">
						<h4 class="card-title fw-bold"><?php echo $row_post['post_title']; ?></h4>
						<h5 class="card-text"><?php echo $row_post['post_summary']; ?></h5>
						<p class="card-text" id="post_description"><?php echo $row_post['post_description']; ?></p>
						<div class="container-fluid p-3 text-center">
							<?php
							$query_attachment = "SELECT * FROM post_atachment WHERE post_id = '".$post_id."' AND is_active = 'Active'";
						    $result_attachment = mysqli_query($connection, $query_attachment);
						    if ($result_attachment->num_rows > 0) {
						    	while ($row_attachment = mysqli_fetch_assoc($result_attachment)) {
						    		echo "<p>".$row_attachment['post_attachment_title']." <a class='text-danger fw-bold' href='../../files/".$row_attachment['post_attachment_path']."' download>Download</a></p>";
						    	}
						    }
						    ?>
						</div>

						<p class="card-text"><small class="text-body-secondary">Created on <?php echo date("F dS", strtotime($row_post['created_at'])); ?></small></p>

						<?php if (isset($_SESSION['user_id']) && $row_post['is_comment_allowed'] == 1) { ?>
							<hr>
							<div class="text-center">
								<button class="btn btn-dark rounded-pill" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
									<svg class="m-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-square-text" viewBox="0 0 16 16"><path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/><path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/></svg>
								</button>
							</div>
							<div class="collapse" id="collapseExample">
								<div class="card card-body">
									<?php
									$query = "SELECT * FROM post INNER JOIN post_comment ON post.post_id = post_comment.post_id 
								  	INNER JOIN USER ON post_comment.`user_id` = user.`user_id` 
								  	WHERE post.post_id = '".$_REQUEST['post_id']."' AND post_comment.`is_active` = 'Active'";
									$result = mysqli_query($connection, $query);
								  	if ($result->num_rows > 0) {
								  		while ($row_comment = mysqli_fetch_assoc($result)) { ?>
								  			<p class="border border-2 bg-light rounded" style="width: 70%;"> 
								  				<img class="image-fluid rounded-circle" src="../../images/<?php echo $row_comment['user_image']; ?>" alt="" style="height: 40px;">
								  				<strong <?php echo ($_SESSION['first_name'] == $row_comment['first_name']) ? "class='text-success'" : ""; ?>><?php echo $row_comment['first_name']; ?>: </strong><?php echo $row_comment['comment']; ?>
								  				<span class="float-end m-2"><?php echo date("F dS", strtotime($row_comment['created_at'])); ?></span>
								  			</p>
								  	<?php }
								  	} ?>
								</div>
								<button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropAddComment">Add Comment</button>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
} else {
	echo "<h4 class='text-center'>This Post is no longer Active</h4>";
}

include ("../../require/footer.php");
?>