<html><body>
<?php
	
	error_reporting(-1);

	// connection 
	// TODO:secure connection details 
	$servername = "localhost";
	$username = "samar";
	$password = "password";
	$dbname = "archive";
	$target_file = "uploads/img_".$id.".jpg";

	// Create db connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	// stop if failed
	if ( mysqli_connect_errno() ) {
		die("Connection failed: " . 
     	mysqli_connect_error() . 
     	" " . mysqli_connect_errno() );
	}


	// TODO: fix SQL injection 
	$query = "SELECT * FROM photo_data"; // give me everything from photodata table ordered desc

	$result = mysqli_query($conn, $query);
	if(!$result){
		die("Database query failed.". mysqli_error($conn));
	} else { 
		echo "<table border='1'>";
		echo "<tr><th>id</th><th>uniqueid</th><th>description</th>";
		echo "<th>keywords</th><th>year</th><th>location</th><th>image</th></tr>";
		
		//building row by adding values
		while($row=mysqli_fetch_row($result)){
			echo "<tr>";
				//building columns
			foreach ($row as $key => $value) {				
				echo "<td>",$value,"</td>";
			}
			echo "<td>","<img src='./uploads/img_",$row[1],".jpg' width=250>","</td>";
			echo "</tr>";
		}
		echo "</table>";

	
		
	}

	mysqli_close($conn);

?>

</body>
</html>

