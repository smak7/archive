<html><body>
<?php
	
	error_reporting(-1);

	// connection 
	// TODO:secure connection details 
	$servername = "localhost";
	$username = "samar";
	$password = "password";
	$dbname = "archive";

	// Create db connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	// stop if failed
	if ( mysqli_connect_errno() ) {
		die("Connection failed: " . 
     	mysqli_connect_error() . 
     	" " . mysqli_connect_errno() );
	}
	// TODO: fix SQL injection 
	$query = "SELECT * FROM audio"; // give me everything from photodata table ordered desc
	$result = mysqli_query($conn, $query);
	if(!$result){
		die("Database query failed.". mysqli_error($conn));
	} else { 
		echo "<table border='1'>";
		echo "<tr><th>photo_id</th><th>audio_file</th><th>hotspot</th>";
		//building row by adding values
		while($row=mysqli_fetch_row($result)){
			echo "<tr>";
				//building columns 
				foreach ($row as $key => $value) { 
					echo "<td>",$value,"</td>";
				}
			// echo "<td>",join("</td><td>",$row), "</td>";
			echo "</tr>";
		}
		echo "</table>";
		
	}

	mysqli_close($conn);

?>

</body>
</html>

