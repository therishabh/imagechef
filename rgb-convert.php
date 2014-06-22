<?php

if(isset($_POST['submit_btn']))
{
	if($_POST['image_name'] != "")
	{
		
		$image_name = $_POST['image_name'];
		$red = $_POST['red'];
		$green = $_POST['green'];
		$blue = $_POST['blue'];

		if($red == "")
		{
			$red = 0;
		}
		if($green == "")
		{
			$green = 0;
		}
		if($blue == "")
		{
			$blue = 0;
		}

		$extension = pathinfo($image_name,PATHINFO_EXTENSION);
		if($extension == "jpg" || $extension == "jpeg")
		{
			$image = imagecreatefromjpeg("upload/".$image_name);
			imagefilter($image, IMG_FILTER_COLORIZE,$red,$green,$blue);
			header("content-type: image/jpeg");
			imagejpeg($image,"effect/rgb/".$image_name);
			session_start();
			$_SESSION['image_name'] = $image_name;
			header("location:rgb-effect.php");
		}
		elseif ($extension == "png")
		{
			$image = imagecreatefrompng("upload/".$image_name);
			imagefilter($image, IMG_FILTER_COLORIZE,$red,$green,$blue);
			header("content-type: image/png");
			imagepng($image,"effect/rgb/".$image_name);
			session_start();
			$_SESSION['image_name'] = $image_name;
			header("location:rgb-effect.php");
		}
	}
	else{
		unset($_SESSION['image_name']);
		header("location:rgb-effect.php");
	}
}
?>