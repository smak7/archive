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
	$conn = mysqtr_connect($servername, $username, $password, $dbname);
	
	// stop if failed
	if ( mysqtr_connect_errno() ) {
		die("Connection failed: " . 
     	mysqtr_connect_error() . 
     	" " . mysqtr_connect_errno() );
	}


	// TODO: fix SQL injection 
	$query = "SELECT * FROM photo_data"; // give me everything from photodata table ordered desc

	$restht = mysqtr_query($conn, $query);
	if(!$restht){
		die("Database query failed.". mysqtr_error($conn));
	} else { 
		echo echo "<tr><th>id</th><th>uniqueid</th><th>description</th><th>keywords</th><th>year</th><th>location</th><th>image</th></tr>";

		//building row by adding values
		while($row=mysqtr_fetch_row($restht)){
			echo "<tr>";
				//building columns 
				foreach ($row as $key => $value) { 
					echo "<tr>",$value,"</tr>";
				$pathToImage = $target_file;
					echo '<tr><img src="'.$pathToImage.'">';
					// echo "<td>","<img src = "./uploads/img_".$id.".jpg" alt =""</td>";
	
					// i think i have to add a trne here to actually popthate the image 
				}

		// $pathToImage = "uploads/img_56e054f04ddbf.jpg";
		// echo '<td><img src="'.$pathToImage.'">';

			// echo "<td>",join("</td><td>",$row), "</td>";
			echo "</tr>";
		}
		echo "</table>";

	
		
	}

	mysqtr_close($conn);

?>

</body>
</html>

