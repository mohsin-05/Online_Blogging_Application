<?php
session_start();
require("../../require/connection.php");

$query = "SELECT * FROM blog WHERE user_id = '".$_SESSION['user_id']."' ORDER BY blog_id DESC";
$result = mysqli_query($connection, $query);

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'show_blog') { ?>

	<h2 class="text-uppercase fw-bold text-center mt-5">
		Blogs Created By User <?php echo $_SESSION['first_name']; ?>
	</h2>

	<div class="px-2 py-5">
		<table class="table table-dark table-striped display" id="example">
		    <thead>
		    <tr>
		      <th scope="col">S. No 			</th>
		      <th scope="col">Image 			</th>
		      <th scope="col">Title 			</th>
		      <th scope="col">Active/InActive	</th>
		      <th scope="col">Status 			</th>
		      <th scope="col">Created At 		</th>
		      <th scope="col">Posts Per Page 	</th>
		      <th scope="col">All Posts 		</th>
		      <th scope="col">Followers 		</th>
		      <th scope="col">Edit 				</th>
		    </tr>
		  </thead>
		  <tbody>

		<?php if ($result->num_rows > 0) {
				$serial = 0;
	  			while ($row = mysqli_fetch_assoc($result)) {
					$query = "SELECT COUNT(follower_id) AS 'followers' FROM following_blog WHERE blog_following_id = '".$row['blog_id']."' AND STATUS = 'Followed'";
					$result_followers = mysqli_query($connection, $query);
					$row_followers = mysqli_fetch_assoc($result_followers);
		  			echo "<tr>";
		  			echo "<td>".++$serial."</td>";
		  			echo "<td><img class='rounded' src='../../images/".$row['blog_background_image']."' alt='No Image' style='height: 50px;'></td>";
		  			echo "<td>".$row['blog_title']."</td>";
		  			echo "<td><button class='btn btn-outline-success' onclick='active(".$row['blog_id'].")'>Active</button>
			  			<button class='btn btn-outline-danger' onclick='inactive(".$row['blog_id'].")'>InActive</button></td>";
			  		if ($row['blog_status'] == "Active") {
		  				echo "<td><button class='btn btn-success'>".$row['blog_status']."</button></td>";
			  		} else {
			  			echo "<td><button class='btn btn-danger'>".$row['blog_status']."</button></td>";
			  		}
		  			echo "<td>".date("F dS", strtotime($row['created_at']))."</td>";
		  			echo "<td>".$row['post_per_page']."</td>";
		  			echo "<td><button class='btn btn-outline-info'><a class='page-link'href='../blog/blog-page.php?blog_id=".$row['blog_id']."'>Show All Posts</a></button></td>";
		  			echo "<td>".$row_followers['followers']."</td>";
		  			echo "<td><button class='btn btn-outline-light' type='button' data-bs-toggle='modal' data-bs-target='#staticBackdropUpdateBlog".$row['blog_id']."'><svg class='me-2' xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'> <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/><path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/></svg>Edit</button</td>";
		  			echo "</tr>";
		  		}
	  		} ?>
		  </tbody>
		</table>
	</div>
<?php
}

?>