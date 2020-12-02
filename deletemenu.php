<?php

	$id=$_POST['id'];
	//var_dump($id);

	$menulist = file_get_contents('menulist.json');
	$menulist_array = json_decode($menulist, true);

	//photo delete
	//unlink($stuentlist_array[$id]['profile']);

	//data delete
	unset($menulist_array[$id]);

	//var_dump($stuentlist_array);die();

	$mydata=json_encode($menulist_array, JSON_PRETTY_PRINT);
	file_put_contents("menulist.json", $mydata);
?>