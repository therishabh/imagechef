<?php 
include 'header.php';

?>

<div class="row">
	<div class="col-lg-3 col-centered">
		<div class="heading">Emboss Effect</div>
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
 					<form action="emboss-convert.php" method="post">
 						<input type="hidden" name="image_name" id="image-name" value="">
 						<input type="submit" value="Convert" name="submit_btn" class="function-btn submit-btn">
 					</form>
 				</div>
 				<div class="col-lg-5">
 					<div class="upload-image">
 						<?php 
 						if(isset($_SESSION['image_name']) && !empty($_SESSION['image_name']))
 						{
 							echo '<img src="effect/emboss/'.$_SESSION['image_name'].'" alt="">';
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
						echo '<a href="effect/emboss/'.$_SESSION['image_name'].'"><div class="submit-btn">Save</div></a>';
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

</script>

<?php unset($_SESSION['image_name']); ?>