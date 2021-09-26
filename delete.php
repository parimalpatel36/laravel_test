
<?php
	$conn = mysqli_connect('localhost','root','','web');

	$sql = "DELETE FROM student WHERE id='" . $_GET["id"] . "'";

	if (mysqli_query($conn, $sql)) {

	    echo "Record deleted successfully";

	} else {
	
	    echo "Error deleting record: " . mysqli_error($conn);
	}
		header('location:index.php');

	mysqli_close($conn);
?>