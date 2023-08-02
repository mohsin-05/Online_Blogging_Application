<?php
require ("../../require/connection.php");

$query_comment = "SELECT * FROM USER INNER JOIN post_comment ON post_comment.user_id = user.user_id 
INNER JOIN post ON post_comment.post_id = post.post_id ORDER BY post_comment_id DESC";
$result_comment = mysqli_query($connection, $query_comment);

if ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == "show_table" ) { ?>

	<div class="px-2 py-5">
		<table class="table table-dark table-striped display" id="example">
		    <thead>
		    <tr>
		      <th scope="col">S. No 			</th>
		      <th scope="col">Post Title 		</th>
		      <th scope="col">User Name 		</th>
		      <th scope="col">Comment 			</th>
		      <th scope="col">Created At 		</th>
		      <th scope="col">Status 			</th>
		      <th scope="col">Active/InActive 	</th>
		      <th scope="col">Update 			</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if ( $result_comment->num_rows > 0 ) {
		    		$serial = 0;
		  			while ( $row = mysqli_fetch_assoc( $result_comment ) ) {
			  			echo "<tr>";
			  			echo "<td>".++$serial."</td>";
			  			echo "<td>".$row['post_title']."</td>";
			  			echo "<td>".$row['first_name']."</td>";
			  			echo "<td>".$row['comment']."</td>";
			  			echo "<td>".date( "F dS", strtotime($row['created_at'] ) )."</td>";

			  			if ( $row['is_active'] == 'Active' ) {
				  			echo "<td><button class='btn btn-success'>".$row['is_active']."</button></td>";
			  			} else if ( $row['is_active'] == 'InActive' ) {
				  			echo "<td><button class='btn btn-danger'>".$row['is_active']."</button></td>";
			  			} else {
			  				echo "<td></td>";
			  			}

			  			echo "<td><button class='btn btn-outline-success' onclick='active(".$row['post_comment_id'].")'>Active</button>
			  				<button class='btn btn-outline-danger' onclick='inactive( ".$row['post_comment_id']." )'>InActive</button></td>";
			  			echo "<td><button class='btn btn-outline-light' type='button' data-bs-toggle='modal' data-bs-target='#staticBackdropUpdateComment".$row['post_comment_id']."'>
			  				<svg class='me-2' xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'><path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/><path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/></svg>
			  				Edit</button></td>";
			  			echo "</tr>";
			  		}
		  		} 
	  		?>
		  </tbody>
		</table>
	</div>
<?php
}

if ( isset( $_REQUEST['action']) && $_REQUEST['action'] == "active" ) {
	$comment_id = $_REQUEST['comment_id'];
	$query = "UPDATE post_comment SET is_active = 'Active' WHERE post_comment_id = $comment_id";
	$result = mysqli_query( $connection, $query );
	if ( $result ) {
		$query = "SELECT * FROM post_comment WHERE post_comment_id = $comment_id";
		$result = mysqli_query( $connection, $query );
		if ( $result->num_rows > 0 ) {
			$row = mysqli_fetch_assoc( $result );
			echo "<h4 class='text-center'>The Comment with Comment ID '".$row['post_comment_id']."' is Active</h4>";
		}
	}
}

if ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == "inactive" ) {
	$comment_id = $_REQUEST['comment_id'];
	$query = "UPDATE post_comment SET is_active = 'InActive' WHERE post_comment_id = $comment_id";
	$result = mysqli_query( $connection, $query );
	if ( $result ) {
		$query = "SELECT * FROM post_comment WHERE post_comment_id = $comment_id";
		$result = mysqli_query( $connection, $query );
		if ( $result->num_rows > 0 ) {
			$row = mysqli_fetch_assoc( $result );
			echo "<h4 class='text-center'>The Comment with Comment ID '".$row['post_comment_id']."' is InActive</h4>";
		}
	}
}

?>