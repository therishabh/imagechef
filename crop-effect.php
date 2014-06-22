<?php 
include 'header.php';
?>
<?php

$image='';
$err='';
if(isset($_POST['submit'])){
	//error variable to hold your error message 
	$err="";
	$path = "upload/";
	//alled image format will be used for filter	
	$allowed_formats = array("jpg", "png", "gif", "bmp");
	$imgname = $_FILES['img']['name'];
	$tmpname = $_FILES['img']['tmp_name'];
	$size = $_FILES['img']['size'];
	//validate image
	if(!$imgname){
		$err="<strong>Oh snap!</strong>Please select image..!";
		return false;
	}
	if($size > (1024*1024)){
		$err="<strong>Oh snap!</strong>File Size is too large..!";
	}
	list($name, $ext) = explode(".", $imgname);
	if(!in_array($ext,$allowed_formats)){
			$err="<strong>Oh snap!</strong>Invalid file formats only use jpg,png,gif";
			return false;					
	}
	if($ext=="jpg" || $ext=="jpeg" ){
		$src = imagecreatefromjpeg($tmpname);
	}
	else if($ext=="png"){
		$src = imagecreatefrompng($tmpname);
	}
	else {
		$src = imagecreatefromgif($tmpname);
	}
	list($width,$height)=getimagesize($tmpname);
	if($width > 400){
		$newwidth=399;
		$newheight=($height/$width)*$newwidth;
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		$image = $path.$imgname;
		imagejpeg($tmp,$path.$imgname,100);
		move_uploaded_file($image,$path.$imgname);
	}
	else{
		if(move_uploaded_file($tmpname,$path.$imgname)){
			$image="../upload/".$imgname;
		}
		else{
			$err="<strong>Oh snap!</strong>failed";
		}
	}	
}
?>

<div class="row">
	<div class="col-lg-3 col-centered">
		<div class="heading">Crop Image</div>
	</div>
</div>

 <div class="work-div">
 	<div class="row">
 		<div class="col-lg-9 col-centered">
 			<div class="row">
 				<div class="col-lg-5">
 					<div class="upload-image upload">
 						<?php 
 						if($image)
 						{
 							echo '<img src="'.$image.'" id="imgc" alt="">';
 						}
 						else
 						{
 							echo '<img src="images/default-upload.jpg" alt="">';
 						}
 						?>
 					</div>
 				</div>
 				<div class="col-lg-2">
 					<button id="cropbtn" class="function-btn submit-btn">Crop</button>
 					<!-- <form action="blur-convert.php" method="post">
 						<input type="hidden" name="image_name" id="image-name" value="">
 						<input type="submit" value="Convert" name="submit_btn" class="function-btn submit-btn">
 					</form> -->
 				</div>
 				<div class="col-lg-5">
 					<div class="upload-image" style="margin-top:5px;">
 						<div class="frame">
 							<div id="preview">
		 						<?php 
		 						if($image)
		 						{
		 							echo '<img src="'.$image.'" alt="">';
		 						}
		 						else
		 						{
		 							echo '<img src="images/default-preview.jpg" alt="">';
		 						}
		 						?>
 							</div>
 						</div>
 					</div>
 				</div>
 			</div>
 			<div class="row" style="margin-top:20px;">
 				<div class="col-lg-5">
 					<form id="imgcrop" method="post" enctype="multipart/form-data">
 						<label style="width:100%;">
							<input type="file" style="display:none;" id="img"  name="img" accept="image/*">
							<div class="submit-btn" style="font-weight:normal;">Upload Image</div>
						</label>
						<input type="hidden" name="imgName" id="imgName" value="<?php echo($imgname) ?>" />
						<button class="submit-btn" name="submit">Submit</button>
					</form>
 					
				</div>
 				<div class="col-lg-5 col-lg-offset-2">
 					<div id='output'></div>
 					
 					<?php 
					if(isset($_SESSION['image_name']) && !empty($_SESSION['image_name']))
					{
						echo '<a href="effect/blur/'.$_SESSION['image_name'].'"><div class="submit-btn">Save</div></a>';
					}
					
					?>
 					
 				</div>
 			</div>
 		</div>
 	</div>
 </div>			

<script type="text/javascript" src="js/jquery.imgareaselect.js"></script>
<script type="text/javascript" src="js/process.js"></script>