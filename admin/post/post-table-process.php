<?php
session_start();
require("../../require/connection.php");

$query = "SELECT * FROM post INNER JOIN blog ON post.blog_id = blog.blog_id 
INNER JOIN post_category ON post.`post_id` = post_category.`post_id` 
INNER JOIN category ON post_category.`category_id` = category.`category_id` 
WHERE blog.user_id = '".$_SESSION['user_id']."' ORDER BY post.`post_id` DESC";
$result = mysqli_query($connection, $query);

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'show_post') { ?>

	<h2 class="text-uppercase fw-bold text-center mt-5">Posts Created By User <?php echo $_SESSION['first_name']; ?></h2>

	<div class="px-2 py-5">
		<table class="table table-dark table-striped display" id="example">
		    <thead>
		    <tr>
		      <th class="text-center" scope="col">S. No 			</th>
		      <th class="text-center" scope="col">Image 			</th>
		      <th class="text-center" scope="col">Post Title 		</th>
		      <th class="text-center" scope="col">Active/InActive 	</th>
		      <th class="text-center" scope="col">Status 			</th>
		      <th class="text-center" scope="col">Created At 		</th>
		      <th class="text-center" scope="col">Summary 			</th>
		      <th class="text-center" scope="col">Comments Allowed 	</th>
		      <th class="text-center" scope="col">Show Post 		</th>
		      <th class="text-center" scope="col">Blog Title 		</th>
		      <th class="text-center" scope="col">Category 			</th>
		      <th class="text-center" scope="col">Attachments		</th>
		      <th class="text-center" scope="col">Edit 				</th>
		    </tr>
		  </thead>
		  <tbody>

			<?php if ($result->num_rows > 0) {
					$serial = 0;
		  			while ($row = mysqli_fetch_assoc($result)) {
			  			echo "<tr>";
			  			echo "<td>".++$serial."</td>";
			  			echo "<td><img class='rounded' src='../../images/".$row['featured_image']."' alt='No Image' style='height: 50px;'></td>";
			  			echo "<td>".$row['post_title']."</td>";
			  			echo "<td><button class='btn btn-outline-success' onclick='active(".$row['post_id'].")'>Active</button>
				  			<button class='btn btn-outline-danger' onclick='inactive(".$row['post_id'].")'>InActive</button></td>";
				  		if ($row['post_status'] == "Active") {
			  				echo "<td><button class='btn btn-success'>".$row['post_status']."</button></td>";
				  		} else {
				  			echo "<td><button class='btn btn-danger'>".$row['post_status']."</button></td>";
				  		}
			  			echo "<td>".date("F dS", strtotime($row['created_at']))."</td>";
			  			echo "<td>".$row['post_summary']."</td>";
			  			if ($row['is_comment_allowed'] == 1) {
				  			echo "<td>Yes</td>";
			  			} else {
				  			echo "<td>No</td>";
			  			}
			  			echo "<td><button class='btn btn-outline-info'><a class='page-link' href='post-page.php?post_id=".$row['post_id']."'>Show Post</a></button></td>";
			  			echo "<td>".$row['blog_title']."</td>";
			  			echo "<td>".$row['category_title']."</td>";
			  			echo "<td><button class='btn btn-outline-primary' onclick='show_attachments(".$row['post_id'].");'>Attachments</button></td>";
			  			echo "<td><button class='btn btn-outline-light' type='button' data-bs-toggle='modal' data-bs-target='#staticBackdropUpdatePost".$row['post_id']."'>
			  				<svg class='me-2' xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'><path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/><path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/></svg>
			  				Edit</button></td>";
			  			echo "</tr>";
			  		}
		  		} ?>
		  </tbody>
		</table>
	</div>
<?php
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == "show_attachment") { ?>
	<h2 class="text-uppercase fw-bold text-center mt-5">Attachments</h2>
	<div class="px-2 py-5">
		<table class="table table-dark table-striped display" id="example">
		    <thead>
		    	<tr>
			      <th class="text-center" scope="col">S. No 			</th>
			      <th class="text-center" scope="col">Attachment Title 	</th>
			      <th class="text-center" scope="col">Active/InActive 	</th>
			      <th class="text-center" scope="col">Status 			</th>
			      <th class="text-center" scope="col">Created At 		</th>
				</tr>
		  	</thead>
		  	<tbody>

		  		<?php
		  		$query = "SELECT * FROM post_atachment WHERE post_id = '".$_REQUEST['post_id']."'";
				$result = mysqli_query($connection, $query);
				if ($result->num_rows > 0) {
					$serial = 0;
					while ($rows = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						echo "<td>".++$serial."</td>";
						echo "<td>".$rows['post_attachment_title']."</td>";
						echo "<td><button class='btn btn-outline-success' onclick='active_attachment(".$rows['post_atachment_id'].", ".$_REQUEST['post_id'].")'>Active</button>
				  			<button class='btn btn-outline-danger' onclick='inactive_attachment(".$rows['post_atachment_id'].", ".$_REQUEST['post_id'].")'>InActive</button></td>";
				  		if ($rows['is_active'] == "Active") {
			  				echo "<td><button class='btn btn-success'>".$rows['is_active']."</button></td>";
				  		} else {
				  			echo "<td><button class='btn btn-danger'>".$rows['is_active']."</button></td>";
				  		}
						echo "<td>".date("F dS", strtotime($rows['created_at']))."</td>";
						echo "</tr>";
					}
				} ?>
			</tbody>
		</table>
	</div>
<?php
}
?>