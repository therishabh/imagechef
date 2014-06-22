<?php 
include 'header.php';

?>

<div class="row">
	<div class="col-lg-3 col-centered">
		<div class="heading">RGB Color Effect</div>
	</div>
</div>
 <div class="work-div">
 	<div class="row">
 		<div class="col-lg-9 col-centered">
 			<div class="row">
 				<div class="col-lg-5">
 					<div class="upload-image upload">
 						<?php 
 						if(isset($_SESSION['image_name']) && !empty($_SESSION['image_name']))
 						{
 							echo '<img src="upload/'.$_SESSION['image_name'].'" alt="">';
 						}
 						else
 						{
 							echo '<img src="images/default-upload.jpg" alt="">';
 						}
 						?>
 					</div>
 				</div>
 				<div class="col-lg-2">
 					<form action="rgb-convert.php" method="post">
 						<div style="font-color:black">Red</div>
 						<input type="number" max="255" min="0" class="form-control num" value="0" name="red">
 						<div style="font-color:black">Green</div>
 						<input type="number" max="255" min="0" class="form-control num" value="0" name="green">
 						<div style="font-color:black">Blue</div>
 						<input type="number" max="255" min="0" class="form-control num" value="0" name="blue">
 						<?php 
 						if(isset($_SESSION['image_name']) && !empty($_SESSION['image_name']))
 						{
 							echo '<input type="hidden" value="'.$_SESSION['image_name'].'" name="image_name" id="image-name" value="">';
 						}
 						else
 						{
 							echo '<input type="hidden" name="image_name" id="image-name" value="">';
 						}
 						?>
 						<input type="submit" value="Convert" name="submit_btn" class="submit-btn" style="margin-top:10px;">
 					</form>
 				</div>
 				<div class="col-lg-5">
 					<div class="upload-image">
 						<?php 
 						if(isset($_SESSION['image_name']) && !empty($_SESSION['image_name']))
 						{
 							echo '<img src="effect/rgb/'.$_SESSION['image_name'].'" alt="">';
 						}
 						else
 						{
 							echo '<img src="images/default-preview.jpg" alt="">';
 						}
 						?>
 					</div>
 				</div>
 			</div>
 			<div class="row" style="margin-top:20px;">
 				<div class="col-lg-5">
 					<label style="width:100%;">
						<input type="file" style="display:none;" name="image" accept="image/*" id="files">
						<div class="submit-btn" style="font-weight:normal;">Upload Image</div>
					</label>
				</div>
 				<div class="col-lg-5 col-lg-offset-2">
 					<?php 
					if(isset($_SESSION['image_name']) && !empty($_SESSION['image_name']))
					{
						echo '<a href="effect/rgb/'.$_SESSION['image_name'].'"><div class="submit-btn">Save</div></a>';
					}
					
					?>
 					
 				</div>
 			</div>
 		</div>
 	</div>
 </div>


<script type="text/javascript">
		
	$("#files").change(function(event) {
		if($("#files").val() != "")
		{
			var data = new FormData();
		    data.append('files',$(this)[0].files[0]);
		    $.ajax({
		    	type: "POST",
		    	url: "negative-ajax.php",
		    	processData: false,
		    	contentType: false,
		    	data:data,
		    	success : function(result){
		    		$(".upload").html(result);
		    		$("#image-name").val($(".image_name").text());
		    	}
		    });
		}
	});

	// script for percent box, rupee-box, course-fee-value..
	$(".work-div").on('keypress','.num',function(e){
	
		//if the letter is not digit then display error and don't type anything
		if (e.which != 8 && e.which != 0  && (e.which < 48 || e.which > 57))
		{
			return false;
		}

	});

	$(".work-div").on('focusout','.num',function(e){
	
		if($(this).val() > 255)
		{
			$(this).val("255");
		}

	});

</script>

<?php unset($_SESSION['image_name']); ?>