<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="../main.css">
   <title>images</title>
</head>
<body>
   <div class="booth">
    	<video id="video" width="400" height="300"></video>
		<a href="#" id="capture" class="booth-capture-button">take photo</a>
		<form method="post" action="../modal/images.php" enctype='multipart/form-data'>
  		<input type='submit' value='Save image' name='upload'>
		</form>
    	<canvas id="canvas" width="400" height="300"></canvas>
    	<img id="photo" method = "POST" src="../modal/images.php" alt=""></img>
   </div>
   <script type="text/javascript" src="../photo.js"></script>
</body>
</html>