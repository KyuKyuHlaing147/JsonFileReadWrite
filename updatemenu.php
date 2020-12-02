<?php 
	
	$name = $_POST['name'];
	$price = $_POST['price'];

	$id = $_POST['id'];
	$oldphoto = $_POST['oldphoto'];

	$newphoto = $_FILES['newphoto'];

	if ($newphoto['size'] > 0 ) {
		// upload File
		$basepath = 'photo/';
		$fullpath = $basepath.$newphoto['name']; // photo/IMG_4332 (1).jpg
		move_uploaded_file($newphoto['tmp_name'], $fullpath);
	}
	else{
		$fullpath = $oldphoto;
	}

	$menu= array(
		"name"		=>	$name,
		"price"		=>	$email,
		"photo"	=>	$fullpath
	);

	// get jsonData From studentlist.json file

	$jsonData = file_get_contents('menulist.json');

	if (!$jsonData) {
		$jsonData = '[]';
	}
	// convert into array from json

	$data_arr = json_decode($jsonData, true);
	$data_arr[$id] = $menu;

	$jsonData = json_encode($data_arr, JSON_PRETTY_PRINT);
	file_put_contents('menulist.json', $jsonData);
	header('location: index.php');


?>
