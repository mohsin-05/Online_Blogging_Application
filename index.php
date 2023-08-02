<?php
session_start();
require("require/connection.php");
date_default_timezone_set("Asia/Karachi");
require_once("FPDF/fpdf.php");

if (!isset($_SESSION['first_name'])) {

$per_page = 5;

if (isset($_GET['page'])) {
	$start = (($_GET['page']) * $per_page);
} else {
	$start = 0;
}

if (isset($_GET['search_value'])) {

	$count_query = "SELECT COUNT(post.post_id) AS 'Total' FROM USER INNER JOIN blog ON user.user_id = blog.user_id 
	INNER JOIN post ON blog.blog_id = post.blog_id WHERE blog.`blog_status` = 'Active' 
	AND user.`is_active` = 'Active' AND post.`post_status` = 'Active' 
	AND (post_title RLIKE '".$_GET['search_value']."' OR first_name RLIKE '".$_GET['search_value']."')";

	$query = "SELECT * FROM USER INNER JOIN blog ON user.user_id = blog.user_id 
	INNER JOIN post ON blog.blog_id = post.blog_id  
	WHERE blog.`blog_status` = 'Active' AND user.`is_active` = 'Active' AND post.`post_status` = 'Active' 
	AND (post_title RLIKE '".$_GET['search_value']."' OR first_name RLIKE '".$_GET['search_value']."')
	ORDER BY post.post_id DESC LIMIT $start, $per_page";

} else {

	$count_query = "SELECT COUNT(post.post_id) AS 'Total' FROM USER INNER JOIN blog ON user.user_id = blog.user_id 
	INNER JOIN post ON blog.blog_id = post.blog_id WHERE blog.`blog_status` = 'Active' 
	AND user.`is_active` = 'Active' AND post.`post_status` = 'Active'";

	$query = "SELECT * FROM USER INNER JOIN blog ON user.user_id = blog.user_id 
	INNER JOIN post ON blog.blog_id = post.blog_id  
	WHERE blog.`blog_status` = 'Active' AND user.`is_active` = 'Active' AND post.`post_status` = 'Active'
	ORDER BY post.post_id DESC LIMIT $start, $per_page";

}

$count_result = mysqli_query($connection, $count_query);
$t = mysqli_fetch_assoc($count_result);
$total = $t['Total'];
$total_links = ceil($total / $per_page);

$result = mysqli_query($connection, $query);

$page = "index.php";

$query = "SELECT * FROM category WHERE category_status = 'Active'";
$result_category = mysqli_query($connection, $query);
if ($result_category->num_rows > 0) {
	while ($row_category = mysqli_fetch_assoc($result_category)) {
		$category_title[] = $row_category['category_title'];
		$category_id[] = $row_category['category_id'];
	}
}

if (isset($_REQUEST['pdf'])) {
	extract($_REQUEST);

	$pdf = new FPDF();
	$pdf->AddPage("P", "letter");
	$pdf->setFont("Times", "B", 30);
	$pdf->Cell(0,20,"MY ACCOUNT INFORMATION",0,1,"C");
	$pdf->setLineWidth(2);
	$pdf->setDrawColor(255, 153, 0);
	$pdf->Line(0, 30, 500, 30);
	$pdf->ln();
	$pdf->setFont("Times", "B", 10);
	$pdf->setLineWidth(0);
	$pdf->setDrawColor(0, 0, 0);
	$pdf->Cell(100,10,"First Name: ",1,0,"C");
	$pdf->Cell(100,10,$first_name,1,1,'C');
	$pdf->Cell(100,10,"Last Name: ",1,0,"C");
	$pdf->Cell(100,10,$last_name,1,1,"C");
	$pdf->Cell(100,10,"Email: ",1,0,"C");
	$pdf->Cell(100,10,$email,1,1,"C");
	$pdf->Cell(100,10,"Password: ",1,0,"C");
	$pdf->Cell(100,10,$password,1,1,"C");
	$pdf->Cell(100,10,"Gender: ",1,0,"C");
	$pdf->Cell(100,10,$gender,1,1,"C");
	$pdf->Cell(100,10,"Date Of Birth: ",1,0,"C");
	$pdf->Cell(100,10,$date_of_birth,1,1,"C");
	$pdf->Cell(100,10,"Address: ",1,0,"C");
	$pdf->Cell(100,10,$address,1,1,"C");
	$pdf->Cell(100,10,"Created On: ",1,0,"C");
	$pdf->Cell(100,10,date("F dS"),1,1,"C");
	$pdf->Output("D", "MyAccount.pdf");
}

require("require/forms.php");

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Page</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script>
	<style>
		.navbar{
			background-color: #2D2727;
		}
	</style>
</head>
<body>

<!-- Navbar -->

	<nav class="navbar navbar-expand-lg fixed-top" data-bs-theme="dark">
		<div class="container-fluid">
			<button class="btn text-white" style="background-color: #2D2727;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/></svg>
			Menu</button>
			<img class="rounded-circle px-2 my-1" src="images/logo3.jpg" alt="logo" style="height: 60px;">
			<a class="navbar-brand my-2" href="#">Online Blogging Application</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
				<button class="btn text-white mx-2" type="submit" data-bs-toggle="modal" data-bs-target="#staticBackdropLogin">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/><path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/></svg>
				Login</button>
				<button class="btn rounded-pill" type="submit" data-bs-toggle="modal" data-bs-target="#staticBackdropRegister" style="background-color: white; color: #2D2727">Register</button>
			</div>
		</div>
	</nav>

<!-- Navbar End -->



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
				<li class="list-group-item text-white" style="background-color: #2D2727;"><a class="page-link" href="admin/category/category-page.php?category_id=<?php echo $category_id[$key]; ?>"><?php echo $value; ?></a></li>
			<?php } ?>
		</ul>
		<br>
			<li class="list-group-item text-white fw-bolder" style="background-color: #2D2727;">
				<a class="page-link" href="admin/about-us/about-us.php">About Us</a>
			</li>
		</ul>
	</div>
</div>

<!-- Sidebar End -->




<!-- Slider -->

<?php include("require/slider.php"); ?>

<!-- Slider End -->



<script>
	setInterval(function() { document.getElementById('show_msg').innerHTML = "" }, 5000);
</script>


<div id="show_msg">
	<?php
	if (isset($_REQUEST['register_msg'])) { ?>
		<div class="alert alert-<?php echo $_REQUEST['color']; ?> alert-dismissible fade show text-center" role="alert">
			<?php echo "<h6>".$_REQUEST['register_msg']."</h6>"; ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		<?php
	} else if (isset($_REQUEST['login_msg'])) { ?>
		<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
			<?php echo "<h6>".$_REQUEST['login_msg']."</h6>"; ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		<?php
	} ?>
</div>


<div class="container-fluid position-relative">
	<div class="row my-5 ps-5">
		<div class="col rounded col-md-8" style="background-color: white; margin: 5px;" align="center">
			<h3 class="col m-4">Recent Posts</h3>

			<div class="container-fluid">
				<div class="row ps-5">
					<div class="col-md-4 col">
						<form class="d-flex my-5" role="search" action="index.php" method="GET">
					        <input class="form-control me-2" name="search_value" type="search" placeholder="Search" aria-label="Search">
					        <input class="btn btn-outline-danger" type="submit" name="search" value="Search">
					    </form>
					</div>
				</div>
			</div>

			<?php
			if ($result->num_rows > 0) {
				while ($rows = mysqli_fetch_assoc($result)) {?>
					<div class="card mb-3" style="max-width: 680px; border-style: none;">
						<div class="row g-0">
							<div class="col">
								<img src="images/<?php echo $rows['featured_image']; ?>" class="mt-3 img-fluid rounded" alt="No Image">
							</div>
							<div class="col-md-8 ms-3">
								<div class="card-body" align="left">
									<p class="card-text"><img class="rounded-5" src="images/<?php echo $rows['user_image']; ?>" alt="" style="height: 20px;"><small class="text-body-secondary"> <?php echo $rows['first_name']; ?></small></p>
									<h5 class="card-title"><?php echo $rows['post_title']; ?></h5>
									<p class="card-text d-inline-block text-truncate" style="max-width: 200px;"><?php echo $rows['post_summary']; ?></p>
									<p class="card-text"><small class="text-body-secondary">Created on <?php echo date("F dS", strtotime($rows['created_at'])); ?> </small></p>
								</div>
								<button type="button" class="btn mb-2" style="background-color: white; color: #2D2727; width: 120px;"><a class="page-link" href="admin/post/post-page.php?post_id=<?php echo $rows['post_id']; ?>&user_id=<?php echo $rows['user_id']; ?>">See More</a></button>
							</div>
						</div>
					</div>
					<hr class="mx-5">
				<?php }
			} else {
				echo "No Posts";
			} ?>

			<nav aria-label="Page navigation example">
			 <ul class="pagination justify-content-center">
			 	<?php
			 	if (isset($_GET['page']) && $_GET['page'] > 0) { ?>
			 		<li class="page-item">
			 			<a class="page-link" href="index.php?page=<?php echo ($_GET['page']) - 1; echo (isset($_GET['search_value'])) ? "&search_value=".$_GET['search_value']."" : ""; ?>">Previous</a>
			 		</li>
			 	<?php }

			 	for ($i = 1; $i <= $total_links; $i++) { ?>
			 		<li class="page-item"><a class="page-link" href="index.php?page=<?php echo $i - 1; echo (isset($_GET['search_value'])) ? "&search_value=".$_GET['search_value']."" : ""; ?>"><?php echo $i; ?></a></li>
			 	<?php }

			 	if (isset($_GET['page']) && $_GET['page'] + 1 != $total_links) { ?>
			 		<li class="page-item"><a class="page-link" href="index.php?page=<?php echo ($_GET['page']) + 1; echo (isset($_GET['search_value'])) ? "&search_value=".$_GET['search_value']."" : ""; ?>">Next</a></li>
			 	<?php } ?>
			 </ul>
			</nav>
		</div>

		<div class="col rounded" style=" background-color: white; margin: 5px;">
			<h3 class="m-4 text-center">Popular Blogs</h3>
			<div class="row justify-content-center">
				<?php
				$query_blog = "SELECT * FROM blog WHERE blog_status = 'Active'";
				$result_blog = mysqli_query($connection, $query_blog);
				if ($result_blog->num_rows > 0) {
					while ($row_blog = mysqli_fetch_assoc($result_blog)) {
						$query_follow_blog = "SELECT COUNT(follower_id) AS 'followers', blog_following_id FROM following_blog 
						WHERE blog_following_id = '".$row_blog['blog_id']."' AND status = 'Followed'";
						$result_follow_blog = mysqli_query($connection, $query_follow_blog);
						if ($result_follow_blog->num_rows > 0) {
							while ($row_follow_blog = mysqli_fetch_assoc($result_follow_blog)) {
								$popular_blog[$row_follow_blog['blog_following_id']] = $row_follow_blog['followers'];
							}
						}
					}
				}

				if (isset($popular_blog)) {
					arsort($popular_blog);
					$count = 0;
					foreach ($popular_blog as $blog_id => $followers) {
						$count++;
						if ($count > 3) {
							break;
						}
						$query_popular_blog = "SELECT * FROM blog WHERE blog_id = '".$blog_id."'";
						$result_popular_blog = mysqli_query($connection, $query_popular_blog);
						if ($result_popular_blog->num_rows > 0) {
							$rows_popular_blog = mysqli_fetch_assoc($result_popular_blog)
							?>
							<div class="col-sm-6 mb-3 mb-sm-0 text-center">
								<div class="card" style="width: 18rem;">
									<img src="images/<?php echo $rows_popular_blog['blog_background_image']; ?>" class="rounded card-img-top" alt="No Image">
									<div class="card-body">
										<h5 class="card-title"><?php echo $rows_popular_blog['blog_title']; ?></h5>
										<p class="card-text">Followers <small class="text-body-secondary"><?php echo $followers; ?></small></p>
										<hr />
										<a href="admin/blog/blog-page.php?blog_id=<?php echo $rows_popular_blog['blog_id']; ?>" class="page-link">See More</a>
									</div>
								</div>
							</div>
							<hr class="col-10 m-5" />
							<?php
						}
					}
				} else {
					echo "No Blogs";
				} ?>
			</div>
		</div>
	</div>
</div>



<?php 
include ("require/footer.php");

} else if ($_SESSION['role_id'] == 1) {
	header("location:admin/admin-page/admin.php");
} else if ($_SESSION['role_id'] == 2) {
	header("location:user/user-page/user.php");
}

?>