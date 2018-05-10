<!DOCTYPE html>
<html lang="en">
	<head>
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css"
      rel="stylesheet">
	</head>
<body>
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
		<h3 class="text-primary">PHP File Archiver</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<form method="POST" enctype="multipart/form-data">
				<div class="form-inline">
					<input class="form-control" type="file" name="upload[]" multiple/><br><br>
					<button type="submit" class="btn btn-primary form-control" name="submit">Archive Files</button
				</div>
			</form>
		</div>
		<br />
		<?php
			if(ISSET($_POST['submit'])){
				if(array_sum($_FILES['upload']['error']) > 0){
					echo "No Selected File";
				}else{
					$archive = new ZipArchive();
					$archive->open("files.zip", ZipArchive::CREATE);
					$files = $_FILES['upload'];
					
					for($i = 0; $i < count($files['name']); $i++){
						$tmp_name = $files['tmp_name'][$i];
						$filename = $files['name'][$i];
						
						move_uploaded_file($tmp_name, $filename);
						
						$archive->addFile("$filename");
					}
					
					$archive->close();
					echo "Successfully compressed the file";
				}
			}
		?>
	</div>
</body>
</html>
