<?php 
	$name=$_POST['name'];
	$price=$_POST['price'];
	
	$photos=$_FILES['photo'];

	//upload file
	$basepath = 'photo/';
	$fullpath=$basepath.$photos['name'];//photo/1.jpg
	move_uploaded_file($photos['tmp_name'], $fullpath);

	$menu = array (
			"name" => $name,
			"price" => $price,
			"photo" => $fullpath
		);

	//get jsonData from studentlist.json file
	$jsonData = file_get_contents('menulist.json');

	if (!$jsonData) {
		$jsonData = '[]';
	}

	//convert into array from json
	$data_arr = json_decode($jsonData, true);
	array_push($data_arr, $menu);

	$jsonData = json_encode($data_arr, JSON_PRETTY_PRINT);
	file_put_contents('menulist.json', $jsonData);

	header('location: menu.php');
//var_dump($fullpath);
?>