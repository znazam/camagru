<html>
    <head>
        <title>Upload picture</title>
		<link rel="stylesheet" href="../main.css">
    </head>
    <body>
		<?php echo $msg;?>
            <div id="header">
                <a href="../index.php" style="color: blue; font-size: 300%">Homepage</a>
                <div class="header_item">
                </div>
                <div class="header_item">
                    <a href="../pages/gallery.php"><img class="user_icon" src="https://static.thenounproject.com/png/18307-200.png"></a>
                    <div class="header_item" style="display: inline; width: 30px;">
                    <a href="../login/logout.php"><img class="user_icon" onclick="logOut()" src="https://www.freeiconspng.com/uploads/shutdown-icon-28.png"></a>
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
                    <form action ="/cama/modal/images.php" id="submit_form" method="POST" enctype="multipart/form-data">
                        <!-- <input id="b_image" type="file" value="browse" accept="image/*" name="b_pic"  onchange="loadFile(event)" style="display: none;"> -->
                        <p><a for="b_image" href="uploadingit.php"style="cursor: pointer; background-color: 191970; padding: 10px; border-radius: 5px; color: white;">Click here to choose image</a></p>
                        <textarea id="img_caption" type="text" name="caption"></textarea>
                        <input id="post_pic" name="post_pic" type="submit" value="Upload">
                        <input id="url" name="url" type="text" style="display: none;">
                        <input id="chosen_frame" name="chosen_frame" type="text" style="display: none;">
                        <input id="origin" name="origin" type="text" style="display: none;">
                    </form>
                </div>
                <div id="frames">
                    <img class="frame" id="lips" src="../uploads/d57d226a693dc563b9fe83ed3457d101.png">
                    <img class="frame" id="catpaws" src="../uploads/6733.png">
                    <img class="frame" id="vendetta" src="../uploads/516b6f_7503d2b992c64e14b72c9a742c92a57a_mv2.png">
                    <img class="frame" id="mickey" src="../uploads/d7t8j10-1e36b0eb-dcd0-459d-ab30-4ebd04dd5730.png">
                </div>
            </div>
            <div id="side">
            </div>
        </div>
        <div id="snackbar"></div>
		<script type="text/javascript" src="../js/photo.js"></script>
		<div id="footer">
            <p id="f_msg" style="color: white">This website is proundly provided to you by Zaid Nazam</p>
            <p id="cr" style="color: white">znazam 2019</p>
        </div>
    </body>
</html>