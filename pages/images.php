<!-- <!DOCTYPE html>
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
  		<input type='button' value='Save image' name='upload' id="upload">
    	<canvas id="canvas" width="400" height="300"></canvas>
   </div>
   <script type="text/javascript" src="../js/photo.js"></script>
</body>
</html> -->

<html>
    <head>
        <script src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>
		<link rel="stylesheet" href="../main.css">
		<title>Upload picture</title>
        <!-- <style>
            body
            {
                text-align: center;
            }
            #side
            {
                background-color: black;
            }
            #header
			{
				position: fixed;
				top: 0px;
				left: 0px;
				background-color: #A9A9A9;
				width: 100%;
				padding: 10px;
				box-shadow: 0px 8px 16px 0px grey;
				display: inline-grid;
  				grid-template-columns: auto auto auto;
				text-align: center;
				z-index: 1;
			}
			.web_icon
			{
				width: 50px;
				display: inline;
			}
			#search_icon
			{
				width: 30px;
				margin-top: 5px;
				margin-left: 5px;
			}
			.user_icon
			{
				width: 50px;
				display: inline;
			}
			.header_item
			{
				text-align: center;
			}
            #screenshot
            {
                display: none;
                max-height: 100px;
            }
            #vid
            {
                width: 600px;
                display: block;
            }
            #captured_one
            {
                display: none;
                width: 600px;
            }
            #omunye
            {
                display: none;
                position: absolute;
                top: 120px;
                width: 200px;
            }
            #take_pic
            {
                position: relative;
                left: 265px;
                background-color: rgba(255,255,255,0.7);
                border-radius: 100%;
                padding: 10px;
                border: 5px solid RoyalBlue;
                height: 60px;
                width: 60px;
				box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            }
            #take_another_one
            {
                position: relative;
                top: 10px;
                left: 340px;
                background-color: rgba(255,255,255,0.7);
                border-radius: 100%;
                padding: 10px;
                border: 5px solid green;
                height: 25px;
                width: 25px;
				box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            }
            #post_pic
            {
                position: relative;
                height: 50px;
                background-color: rgba(0,0,0,0.7);
                color: white;
                padding: 10px;
                border: 3px solid white;
                border-radius: 10px;
                top: -20px;
				box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            }
            #img_caption
            {
                position: relative;
                width: 500px;
                height: 50px;
                margin-top: 10px;
				border-radius: 5px;
				border: 2px solid #1E90FF;
            }
            #main
            {
                padding: 10px;
                border-radius: 10px;
                top: 120px;
                left: 50px;
                text-align: left;
                display: grid;
  				grid-template-columns: auto auto;
                grid-gap: 20px;
                margin-bottom: 20px;
                min-width: 800px;
            }
            #side
            {
                top: 120px;
                right: 50px;
                border-radius: 10px;
                display: grid;
  				grid-template-columns: auto auto auto;
                padding: 10px;
                grid-gap: 10px;
				overflow: auto;
                border: 5px solid grey;
                min-width: 100px;
            }
            .grid_img
            {
                width: 100%;
            }
            #frames
            {
                display: grid;
				box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                border-radius: 10px;
                height: 98%;
				overflow: auto;
  				grid-template-columns: auto auto;
                grid-gap: 5%;
                padding: 10px;
                min-width: 100px;
            }
            #lay
            {
                display: grid;
                grid-template-columns: auto auto;
                grid-gap: 10px;
                margin-top: 120px;
                min-width: 1000px;
                min-height: 1000px;
            }
            .frame
            {
                width: 100%;
                background-color: white;
                border-radius: 10px;
            }
            #cr
            {
                display: inline;
                float: right;
                margin-right: 10px;
            }
            #f_msg
            {
                display: inline;
                float: left;
                margin-left: 10px;
            }
            #b_image
            {
                background-color: black;
                padding: 5px;
                color: white;
                border-radius: 3px;
            }
			#web_name
			{
				font-style: bold;
				color: white;
				font-family: monospace;
				font-size: 18px;
			}
			.delete
			{
				color: #DD0000;
				font-size: 28px;
				font-weight: bold;
			}
			.delete:hover,
			.delete:focus
            {
				color: red;
				text-decoration: none;
				cursor: pointer;
			}
        </style> -->
    </head>
    <body>
            <div id="header">
                <a href="../index.php" style="color: blue; font-size: 300%">Homepage</a>
                <div class="header_item">
                    <a href="gallery.php"><img class="user_icon" src="https://www.shareicon.net/download/2016/11/09/851666_user_512x512.png"></a>
                    <div class="header_item" style="display: inline; width: 30px;">
                        <img class="user_icon" onclick="logOut()" src="https://www.freeiconspng.com/uploads/shutdown-icon-28.png">
                    </div>
                </div>
            </div>
        <div id="lay">
            <div id="main">
                <div id="cam">
                    <video id="vid" autoplay></video>
                    <canvas id="screenshot"></canvas>
                    <img id="captured_one" src="">
                    <img id="omunye" src="">
                    <button id="take_pic"></button>
                    <img src="https://cdn3.iconfinder.com/data/icons/faticons/32/refresh-01-512.png" id="take_another_one">
                    <form id="submit_form" method="POST" enctype="multipart/form-data">
                        <input id="b_image" type="file" value="browse" accept="image/*" name="b_pic"  onchange="loadFile(event)" style="display: none;">
                        <p><label for="b_image" style="cursor: pointer; background-color: 191970; padding: 10px; border-radius: 5px; color: white;">Click here to choose image</label></p>
                        <textarea id="img_caption" type="text" name="caption"></textarea>
                        <input id="post_pic" name="post_pic" type="submit" value="Upload">
                        <input id="url" name="url" type="text" style="display: none;">
                        <input id="chosen_frame" name="chosen_frame" type="text" style="display: none;">
                        <input id="origin" name="origin" type="text" style="display: none;">
                    </form>
                </div>
                <div id="frames">
                    <div class="frame" id="none"></div>
                    <img class="frame" id="cat1" src="../uploads/cat-png-gray-cat-png-image-347.png">
                    <img class="frame" id="dragon" src="../uploads/doggy.png">
                    <img class="frame" id="cupid" src="../uploads/ball.png">
                </div>
            </div>
        </div>
		<div id="snackbar"></div>
		
		<script type="text/javascript" src="../js/photo.js"></script>
		<div id="footer">
            <p id="f_msg">This website is proundly provided to you by Zaid Nazam</p>
            <p id="cr">znazam 2019</p>
        </div>
    </body>
</html>