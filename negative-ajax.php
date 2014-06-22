<?php 
function generateRandomString($length = 3) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString.rand(0,9);
}
if(!empty($_FILES['files']['name']))
{
	$image_name = $_FILES['files']['name'];
	$extension = pathinfo($image_name,PATHINFO_EXTENSION);
	$random_name = generateRandomString(5);
	$image_new_name = $random_name.".".$extension;
	move_uploaded_file($_FILES['files']['tmp_name'],"upload/{$image_new_name}");
	echo "<div style='display:none' class='image_name'>{$image_new_name}</div><img src='upload/{$image_new_name}'>";
}
?>