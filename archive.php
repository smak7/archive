<?php
	// echo $_POST['location'];
	error_reporting(-1);

	$id = uniqid();
	$description = $_POST['description'];
	$keywords = $_POST['keywords'];
	$year = $_POST['year'];
	$location = $_POST['location'];//'paris';
	//$photo_id = $_POST['id'];
	$audio_file = $_POST['audio_file'];
	$hotspot = $_POST['hotspot_location'];
	$hotspot_id = 0;
	echo 'ok ';
	echo  $_POST['year'];
	echo 'hotspot ' . $hotspot;
	//echo $_POST['hotspot'];

	// connection 
	// TODO:secure connection details 
	$servername = "localhost";
	$username = "samar";
	$password = "password";
	$dbname = "archive";

	// Create db connection
	$conn = mysqli_connect($servername, $username, $password,$dbname);
	
	// stop if failed
	if ( mysqli_connect_errno() ) {
		die("Connection failed: " . 
     	mysqli_connect_error() . 
     	" " . mysqli_connect_errno() );
	}
	// TODO: fix SQL injection 
	$query = "INSERT INTO photo_data (unique_id,description,keywords,year,location) VALUES 
		('$id','$description','$keywords',$year,'$location')"; 

	// $result = mysqli_query($conn, $query);
	// if(!$result){
	// 	die("Database query failed.". mysqli_error($conn));
	// }

	// trying to get audio table populated with audio file and hotspot
	//$query = "INSERT INTO audio (photo_id,audio_file,hotspot_location) VALUES 
		//('$photo_id','$audio_file','$hotspot')";


	$result = mysqli_query($conn, $query);
	if(!$result){
		die("Database query failed.". mysqli_error($conn).$query);
	}


	// do new query here

	$query = "INSERT INTO audio (unique_id,audio_id,hotspot) VALUES ('$id','$hotspot_id','$hotspot')";


	$result = mysqli_query($conn, $query);
	if(!$result){
		die("Database query failed.". mysqli_error($conn).$query);
	}


	mysqli_close($conn);
	echo "success";

	// saving local files
	// $img = $_POST['image'];
	// $img = str_replace('data:image/jpg;base64,', '', $img);
	// $img = str_replace(' ', '+', $img);
	// $fileData = base64_decode($img);
	
	$target_file = "uploads/img_".$id.".jpg";
	// file_put_contents($fileName, $fileData);
	if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    if(!is_dir("recordings")){
	$res = mkdir("recordings",0777); 
}

// pull the raw binary data from the POST array
$data = substr($_POST['data'], strpos($_POST['data'], ",") + 1);

if($data){// decode it
	$decodedData = base64_decode($data);
	// print out the raw data, 
	//echo ($decodedData);
	$filename = 'audio_recording_' . $id .'_'.$hotspot_id.'.mp3';


	// write the data out to the file
	$fp = fopen('recordings/'.$filename, 'wb');
	fwrite($fp, $decodedData);
	fclose($fp);
	echo "saved audio:".$filename;
}
?>



<!-- // <?php
// 		$img = $_POST['image'];
// 		$img = str_replace('data:image/png;base64,', '', $img);
// 		$img = str_replace(' ', '+', $img);
// 		$fileData = base64_decode($img);

// 		// saving local files
// 		$id = uniqid();
// 		$fileName = $id.".jpg";
// 		$target_dir = "uploads/";
// 		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// 		$uploadOk = 1;
// 		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// 		if($FILES["image"]["size"] > 500000){
// 			echo "Sorry, your file is too large.";
// 			$uploadOK = 0;
// 		}

// 		if($imageFileType != ".jpg"){
// 			echo "Sorry, only .jpg files are allowed.";
// 			 $uploadOk = 0;
// 		}
// ?> -->