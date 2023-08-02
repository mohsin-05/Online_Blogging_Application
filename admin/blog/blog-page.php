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
		if (isset($_SESSION['user_id']) && $rows['follower_id'] == $_SESSION['user_id'] && $rows['blog_following_id'] == $_REQUEST['blog_id'] && $rows['status'] == 'Followed') { 
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
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/></svg>
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
?>



<?php
include("../../user/user-require/user-sidebar.php");
?>


<?php	
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

		obj.open("GET", "follow-blog-process.php?action="+follow_unfollow+"&blog_id="+blog_id);
		obj.send();
	}
</script>

<br><br><br>

<div class="container-fluid">
	<div class="row ps-5">
		<div class="col-md-3 col">
			<form class="d-flex my-5" role="search" action="blog-page.php" method="GET">
				<input class="form-control me-2" name="search_value" type="search" placeholder="Search" aria-label="Search">
				<input type="hidden" name="blog_id" value="<?php echo $blog_id; ?>">
				<input class="btn btn-outline-danger" type="submit" name="search" value="Search">
			</form>
		</div>
	</div>
</div>

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

		<?php if (isset($_SESSION['user_id'])) { ?>

		<div class="col" id="follow_button">
		<?php 
		if ($flag == true && isset($row_blog['blog_id'])) { 
		?>
			<button class="btn btn-dark rounded-pill float-end" onclick="follow('unfollow', <?php echo $row_blog['blog_id']; ?>)">Followed</button>
		<?php 
		} else if ( isset($row_blog['blog_id']) ) { ?>
			<button class="btn btn-dark rounded-pill float-end" onclick="follow('follow', <?php echo $row_blog['blog_id']; ?>)">Follow</button>
		<?php
		}
		?>
		</div>
	<?php } ?>
	</div>
</div>

<?php
if (isset($row_blog['post_per_page'])) {
	$per_page = $row_blog['post_per_page'];
}

if (isset($_GET['page'])) {
	$start = (($_GET['page'])*$per_page);
} else {
	$start = 0;
}

if (isset($_GET['search_value'])) {
	$count_query = "SELECT COUNT(post.post_id) AS 'Total' FROM USER INNER JOIN blog ON user.user_id = blog.user_id 
	INNER JOIN post ON blog.blog_id = post.blog_id WHERE blog.blog_id = '".$blog_id."' AND blog.`blog_status` = 'Active' 
	AND user.`is_active` = 'Active' AND post.`post_status` = 'Active' 
	AND post_title RLIKE '".$_GET['search_value']."'";

	$query = "SELECT * FROM USER INNER JOIN blog ON user.user_id = blog.user_id 
	INNER JOIN post ON blog.blog_id = post.blog_id 
	INNER JOIN post_category ON post.`post_id` = post_category.`post_id` 
	INNER JOIN category ON post_category.`category_id` = category.`category_id` 
	WHERE blog.`blog_id` = '".$blog_id."' AND blog.`blog_status` = 'Active' 
	AND user.`is_active` = 'Active' AND post.`post_status` = 'Active' 
	AND post_title RLIKE '".$_GET['search_value']."'
	AND category.`category_status` = 'Active' ORDER BY post.post_id DESC LIMIT $start, $per_page";
} else if (isset($per_page)) {
	$count_query = "SELECT COUNT(post.post_id) AS 'Total' FROM USER INNER JOIN blog ON user.user_id = blog.user_id 
	INNER JOIN post ON blog.blog_id = post.blog_id WHERE blog.blog_id = '".$blog_id."' AND blog.`blog_status` = 'Active' 
	AND user.`is_active` = 'Active' AND post.`post_status` = 'Active'";

	$query = "SELECT * FROM USER INNER JOIN blog ON user.user_id = blog.user_id 
	INNER JOIN post ON blog.blog_id = post.blog_id 
	INNER JOIN post_category ON post.`post_id` = post_category.`post_id` 
	INNER JOIN category ON post_category.`category_id` = category.`category_id` 
	WHERE blog.`blog_id` = '".$blog_id."' AND blog.`blog_status` = 'Active' 
	AND user.`is_active` = 'Active' AND post.`post_status` = 'Active' 
	AND category.`category_status` = 'Active' ORDER BY post.post_id DESC LIMIT $start, $per_page";
}

if (isset($count_query)) {
	$count_result = mysqli_query($connection, $count_query);
	$t = mysqli_fetch_assoc($count_result);
	$total = $t['Total'];
	$total_links = ceil($total/$per_page);

	$result = mysqli_query($connection, $query);
}

if ($result->num_rows > 0) { ?>
	<div class="row row-cols-1 row-cols-md-2 g-5 p-5"><?php
	while ($rows = mysqli_fetch_assoc($result)) { ?>
		<div class="col m-">
			<div class="card">
				<img src="../../images/<?php echo $rows['featured_image']; ?>" class="card-img-top" alt="No Image" style="height: 550px;">
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
	} ?>
	</div>
<?php
} else {
	echo "<h4 class='text-center'>No Posts</h4>";
}

if (isset($total_links)) {
?>
	<nav aria-label="Page navigation example">
		<ul class="pagination justify-content-center">
		<?php
		if (isset($_GET['page']) && $_GET['page'] > 0) { ?>
		    <li class="page-item">
		    	<a class="page-link" href="blog-page.php?page=<?php echo ($_GET['page']) - 1; echo (isset($_GET['search_value'])) ? "&search_value=".$_GET['search_value']."" : ""; ?>&blog_id=<?php echo $blog_id; ?>">
		    		Previous
		    	</a>
		    </li>
		<?php }

		for ($i = 1; $i <= $total_links; $i++) { ?>
		    <li class="page-item"><a class="page-link" href="blog-page.php?page=<?php echo $i - 1; echo (isset($_GET['search_value'])) ? "&search_value=".$_GET['search_value']."" : ""; ?>&blog_id=<?php echo $blog_id; ?>"><?php echo $i; ?></a></li>
		<?php }

		if (isset($_GET['page']) && $_GET['page'] + 1 != $total_links) { ?>
		    <li class="page-item"><a class="page-link" href="blog-page.php?page=<?php echo ($_GET['page']) + 1; echo (isset($_GET['search_value'])) ? "&search_value=".$_GET['search_value']."" : ""; ?>&blog_id=<?php echo $blog_id; ?>">Next</a></li>
		<?php } 
		?>
		</ul>
	</nav>
<?php
}
include ("../../require/footer.php");
?>