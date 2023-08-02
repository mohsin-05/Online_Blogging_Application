<?php
session_start();
require("../../require/connection.php");

$query = "SELECT * FROM category ORDER BY category_id DESC";
$result = mysqli_query($connection, $query);

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'show_category') { ?>

	<div class="px-2 py-5">
	<table class="table table-dark table-striped display" id="example">
	    <thead>
	    <tr>
	      <th scope="col">S. No 			</th>
	      <th scope="col">Title 			</th>
	      <th scope="col">Description 		</th>
	      <th scope="col">Active/InActive 	</th>
	      <th scope="col">Status 			</th>
	      <th scope="col">Show Posts 		</th>
	      <th scope="col">Created At 		</th>
	      <th scope="col">Edit 				</th>
	    </tr>
	  </thead>
	  <tbody>

	  	<?php 
	  	if ($result->num_rows > 0) {
	  		$serial = 0;
	  		while ($row = mysqli_fetch_assoc($result)) {
	  			echo "<tr>";
	  			echo "<td>".++$serial."</td>";
	  			echo "<td>".$row['category_title']."</td>";
	  			echo "<td>".$row['category_description']."</td>";
	  			echo "<td><button class='btn btn-outline-success' onclick='active(".$row['category_id'].")'>Active</button>
		  			<button class='btn btn-outline-danger' onclick='inactive(".$row['category_id'].")'>InActive</button></td>";

		  		if ($row['category_status'] == "Active") {
	  				echo "<td><button class='btn btn-success'>".$row['category_status']."</button></td>";
		  		} else {
		  			echo "<td><button class='btn btn-danger'>".$row['category_status']."</button></td>";
		  		}

		  		echo "<td><button class='btn btn-outline-info'><a class='page-link' href='category-page.php?category_id=".$row['category_id']."'>Show Posts</a></button></td>";
	  			echo "<td>".date("F dS", strtotime($row['created_at']))."</td>";
	  			echo "<td><button class='btn btn-outline-light' type='button' data-bs-toggle='modal' data-bs-target='#staticBackdropUpdateCategory".$row['category_id']."'>
	  				<svg class='me-2' xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'><path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/><path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/></svg>
	  				Edit</button</td>";
	  			echo "</tr>";
	  		}
	  	}
	  	 ?>
	  </tbody>
	</table>
</div>

<?php
}
?>