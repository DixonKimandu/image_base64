<?php
if(isset($_POST['submit_image'])){
  if ($_FILES["file"]["error"] > 0){
		echo "Error: " . $_FILES["file"]["error"] . "<br>";
	}else{
		move_uploaded_file($_FILES["file"]["tmp_name"], $_FILES["file"]["name"]);
		$bin_string = file_get_contents($_FILES["file"]["name"]);
		$hex_string = base64_encode($bin_string);
		$mysqli = mysqli_init();
		if (!$mysqli->real_connect('localhost', 'root', '', 'test')) {
			die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
		}
		$mysqli->query("INSERT INTO upload(image) VALUES ('" . $hex_string . "')");
	}
}else{
	$mysqli = mysqli_init();
	if ($mysqli->real_connect('localhost', 'root', '', 'test')) {
		if ($result = $mysqli->query("SELECT * FROM upload ORDER BY id DESC")){
			if($row = $result->fetch_assoc()){
				$output_hex_string = $row["image"];
				$output_bin_string = base64_decode($output_hex_string);
				header("Content-Type: image/jpg");
				header("Content-Length: " . strlen($output_bin_string));
				$result->free();
				echo $output_bin_string;
			}
		}
	}
  }
?>
