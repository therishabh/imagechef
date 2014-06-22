<?php 
if(isset($_POST['submit_btn']))
{

	$image_name = $_POST['image_name'];
	if($image_name != "")
	{
		$extension = pathinfo($image_name,PATHINFO_EXTENSION);
		if($extension == "jpg" || $extension == "jpeg")
		{
			$image = imagecreatefromjpeg("upload/".$image_name);
			imagefilter($image, IMG_FILTER_EMBOSS);
			header("content-type: image/png");
			imagejpeg($image,"effect/emboss/".$image_name);
			session_start();
			$_SESSION['image_name'] = $image_name;
			header("location:emboss-effect.php");
		}
		elseif ($extension == "png")
		{
			$image = imagecreatefrompng("upload/".$image_name);
			imagefilter($image, IMG_FILTER_EMBOSS);
			header("content-type: image/png");
			imagepng($image,"effect/emboss/".$image_name);
			session_start();
			$_SESSION['image_name'] = $image_name;
			header("location:emboss-effect.php");
		}
	}
	else
	{
		unset($_SESSION['image_name']);
		header("location:emboss-effect.php");
	}
}
?>