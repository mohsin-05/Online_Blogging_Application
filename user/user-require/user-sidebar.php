<?php
require("../../require/forms.php");

$query_followed_blogs = "SELECT * FROM blog INNER JOIN following_blog ON blog.blog_id = following_blog.`blog_following_id` 
INNER JOIN USER ON following_blog.`follower_id` = user.`user_id` WHERE user.`user_id` = '".$_SESSION['user_id']."'";
$result_followed_blogs = mysqli_query($connection, $query_followed_blogs);
if ($result_followed_blogs->num_rows > 0) {
	while ($rows_followed_blogs = mysqli_fetch_assoc($result_followed_blogs)) {
		$followed_blog_title[] = $rows_followed_blogs['blog_title'];
		$followed_blog_id[] = $rows_followed_blogs['blog_id'];
	}
}
?>

<!-- Sidebar -->

	<div class="offcanvas offcanvas-start text-white opacity-75" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" style="background-color: #2D2727">
		<div class="offcanvas-header" data-bs-theme="dark">
			<h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		</div>

		<div class="offcanvas-body">
			<li class="list-group-item text-white fw-bolder" style="background-color: #2D2727;">Followed Blogs</li>
			<ul class="list-group list-group-flush">
				<?php if (isset($followed_blog_title)) {
					foreach ($followed_blog_title as $key => $value) { ?>
						<li class="list-group-item text-white" style="background-color: #2D2727;"><a class="page-link" href="../../admin/blog/blog-page.php?blog_id=<?php echo $followed_blog_id[$key]; ?>"><?php echo $value; ?></a></li>
					<?php }
				} else { echo "No Followd Blogs"; } ?>
			</ul>
			<br>
			<li class="list-group-item text-white fw-bolder" style="background-color: #2D2727;">Categories</li>
			<ul class="list-group list-group-flush">
				<?php if (isset($category_title)) {
					foreach ($category_title as $key => $value) { ?>
						<li class="list-group-item text-white" style="background-color: #2D2727;"><a class="page-link" href="../../admin/category/category-page.php?category_id=<?php echo $row_category_id[$key]; ?>"><?php echo $value; ?></a></li>
					<?php }
				} else { echo "No Categories"; } ?>
			</ul>
			<br>
			<li class="list-group-item text-white fw-bolder" style="background-color: #2D2727;">
				<a class="page-link" href="../../admin/about-us/about-us.php">About Us</a>
			</li>
			</ul>
		</div>
	</div>

<!-- Sidebar End -->


<div class="text-center" id="show_message"></div>

<?php
if (isset($_REQUEST['update_msg'])) { ?>
	<div class="alert alert-info alert-dismissible fade show text-center" role="alert">
		<?php echo "<h6>".$_REQUEST['update_msg']."</h6>"; ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	<?php
}

if (isset($_REQUEST['setting_msg'])) { ?>
	<div class="alert alert-info alert-dismissible fade show text-center" role="alert">
		<?php echo "<h6>".$_REQUEST['setting_msg']."</h6>"; ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	<?php
}

?>  