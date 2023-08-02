<?php
session_start();
require("../../require/connection.php");

if (isset($_SESSION['first_name']) && $_SESSION['role_id'] == 2) {

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

$page = "user-page/user.php";

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Page</title>
	<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
	<style>
		.navbar{
			background-color: #2D2727;
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



<div class="container-fluid position-relative">
  <div class="row my-5 ps-5">
    <div class="col rounded col-md-8 ps-5" style="background-color: white; margin: 5px;" align="center">
      <h3 class="col m-4 ms-5 text-center">Recent Posts</h3>

      <div class="container-fluid">
        <div class="row ps-5">
          <div class="col-md-4 col">
            <form class="d-flex my-5" role="search" action="user.php" method="GET">
              <input class="form-control me-2" name="search_value" type="search" placeholder="Search" aria-label="Search">
              <input class="btn btn-outline-danger" type="submit" name="search" value="Search">
            </form>
          </div>
        </div>
      </div>

      <?php
      if ($result->num_rows > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {?>

          <div class="card mb-3 ms-5" style="max-width: 680px; border-style: none;" align="center">
          <div class="row g-0">
            <div class="col">
              <img src="../../images/<?php echo $rows['featured_image']; ?>" class="mt-3 img-fluid rounded" alt="No Image">
            </div>
            <div class="col-md-8 ms-3">
              <div class="card-body" align="left">
                <p class="card-text"><img class="rounded-5" src="../../images/<?php echo $rows['user_image']; ?>" alt="" style="height: 20px;"><small class="text-body-secondary"> <?php echo $rows['first_name']; ?></small></p>
                <h5 class="card-title"><?php echo $rows['post_title']; ?></h5>
                <p class="card-text d-inline-block text-truncate" style="max-width: 200px;"><?php echo $rows['post_summary']; ?></p>
                <p class="card-text"><small class="text-body-secondary">Created on <?php echo date("F dS", strtotime($rows['created_at'])); ?> </small></p>
              </div>
              <button type="button" class="btn mb-2" style="background-color: white; color: #2D2727; width: 120px;"><a class="page-link" href="../post/post-page.php?post_id=<?php echo $rows['post_id']; ?>&user_id=<?php echo $rows['user_id']; ?>">See More</a></button>
            </div>
          </div>
        </div>
      <hr class="mx-5">
        <?php }
      } ?>

      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <?php
          if (isset($_GET['page']) && $_GET['page'] > 0) { ?>
            <li class="page-item">
              <a class="page-link" href="user.php?page=<?php echo ($_GET['page']) - 1; echo (isset($_GET['search_value'])) ? "&search_value=".$_GET['search_value']."" : ""; ?>">
                Previous
              </a>
            </li>
          <?php }

          for ($i = 1; $i <= $total_links; $i++) { ?>
            <li class="page-item"><a class="page-link" href="user.php?page=<?php echo $i - 1; echo (isset($_GET['search_value'])) ? "&search_value=".$_GET['search_value']."" : ""; ?>"><?php echo $i; ?></a></li>
          <?php }

          if (isset($_GET['page']) && $_GET['page'] + 1 != $total_links) { ?>
            <li class="page-item"><a class="page-link" href="user.php?page=<?php echo ($_GET['page']) + 1; echo (isset($_GET['search_value'])) ? "&search_value=".$_GET['search_value']."" : ""; ?>">Next</a></li>
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

        arsort($popular_blog);

        if (isset($popular_blog)) {
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
                    <img src="../../images/<?php echo $rows_popular_blog['blog_background_image']; ?>" class="rounded card-img-top" alt="No Image">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $rows_popular_blog['blog_title']; ?></h5>
                      <p class="card-text">Followers <small class="text-body-secondary"><?php echo $followers; ?></small></p>
                      <hr />
                      <a href="../blog/blog-page.php?blog_id=<?php echo $rows_popular_blog['blog_id']; ?>" class="page-link">See More</a>
                    </div>
                  </div>
                </div>
                <hr class="col-10 m-5" />
              <?php
            }
          }
        } ?>
      </div>
    </div>
  </div>
</div>

<?php
include ("../../require/footer.php");

} else {
	header("location:../../index.php");
}
?>