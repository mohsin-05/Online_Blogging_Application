<?php
session_start();
require("../../require/connection.php"); 

$page = "about-us/about-us.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>About Us</title>
	<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
	<style>
		.navbar{
			background-color: #2D2727;
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
} ?>

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
			<li class="list-group-item text-white fw-bolder" style="background-color: #2D2727;"><a class="page-link" href="pages/about-us/about-us.php">About Us</a></li>
		</div>
	</div>

<!-- Sidebar End -->


<?php	
} ?>


<br><br><br><br><br><br>

<center>
	<h1 class="fw-bold">Online Blogging Application<hr class="border-5 border-warning" style="width: 50%;"></h1>
	<br><br><br>
	<h2>Popular Bloggers</h2>
</center>

<?php
$query_user = "SELECT * FROM user WHERE is_active = 'Active' AND role_id = 1";
$result_user = mysqli_query($connection, $query_user);
if ($result_user->num_rows > 0) {
  while ($row_user = mysqli_fetch_assoc($result_user)) {
    $query_followers = "SELECT COUNT(follower_id) AS 'followers', user.user_id FROM following_blog INNER JOIN blog ON following_blog.blog_following_id = blog.`blog_id` 
		INNER JOIN USER ON blog.user_id = user.user_id WHERE user.user_id = '".$row_user['user_id']."' AND STATUS = 'followed'";
    $result_followers = mysqli_query($connection, $query_followers);
    if ($result_followers->num_rows > 0) {
      while ($row_followers = mysqli_fetch_assoc($result_followers)) {
        $popular_user[$row_followers['user_id']] = $row_followers['followers'];
      }
    }
  }
}

if (isset($popular_user)) { 
	arsort($popular_user);
	foreach ($popular_user as $user_id => $followers) {
	    $query = "SELECT * FROM user WHERE user_id = '".$user_id."'";
		$result = mysqli_query($connection, $query);
	?>
	<div class="container-fluid">
		<div class="row text-center">
			<?php
			if ($result->num_rows > 0) {
				while ($rows = mysqli_fetch_assoc($result)) {
					echo "<div class='col-md-4 col'><hr class='mx-4'><h2 class='m-4'><img class='image-fluid rounded-pill mx-2' src='../../images/".$rows['user_image']."' alt='No Image' style='height: 80px;'> ".$rows['first_name']." ".$rows['last_name']."</h2></div>";
				}
			} ?>
		</div>
	</div>
<?php
	}
}
?>


<br><br><br><br><br><br>



<?php
include ("../../require/footer.php");
?>
