<?php
	set_include_path("../");
    include "/cama/config/database.php";
    session_start();
    if (isset($_POST['url']) && isset($_POST['post_pic']) && $_POST['url'] != "" && isset($_POST['chosen_frame']) && $_POST['chosen_frame'] != "")
    {
        if (!file_exists("uploads"))
        {
            mkdir("../uploads");
        }
        if ($_POST['origin'] == "file")
        {
            $image = "../uploads/".$_FILES['src']['name'];
            $target = "../uploads/".basename($_FILES['src']['name']);
            move_uploaded_file($_FILES["src"]["tmp_name"], $target);
        }
        else
        {
            $rawData = $_POST['url'];
            $filteredData = explode(',', $rawData);
            $unencoded = base64_decode($filteredData[1]);
            $randomName = rand(0, 99999); 
            $fp = fopen("../uploads/".$randomName.'.jpg', 'w');
            fwrite($fp, $unencoded);
            fclose($fp);
            $image = "../uploads/".$randomName.".jpg";
        }
        $srcPath = $_POST['chosen_frame'];
        if (substr($image, -3) == "jpg")
        {
            $dest = imagecreatefromjpeg($image);
        }
        else if (substr($image, -3) == "png")
        {
            $dest = imagecreatefrompng($image);
        }
        else if (substr($image, -3) == "gif")
        {
            $dest = imagecreatefromgif($image);
        }
        $src = imagecreatefrompng($srcPath);
        $srcXpos = 0;
        $srcYpos = 0;
        $srcXcrop = 0;
        $srcYcrop = 0;
        $username = $_SESSION['username'];
        $userid = $_SESSION['id'];
        $caption = $_POST['caption'];
        $time = time();
        if (substr($image, -3) == "gif")
        {
            $newImageName = "../uploads/".$username."_".date("Y_m_d", $time)."_".$time.".gif";
        }
        else
        {
            $newImageName = "../uploads/".$username."_".date("Y_m_d", $time)."_".$time.".jpg";
        }
        list($srcWidth, $srcHeight) = getimagesize($srcPath);
        imagecolortransparent($src, imagecolorat($src, 0, 0));
        imagecopymerge($dest, $src, $srcXpos, $srcYpos, $srcXcrop, $srcYcrop, $srcWidth, $srcHeight, 100);
        if (substr($image, -3) == "gif")
        {
            imagegif($dest, $newImageName, 100);
        }
        else
        {
            imagejpeg($dest, $newImageName, 100);
        }
        if (file_exists($image))
        {
            unlink($image);
        }
        imagedestroy($dest);
        imagedestroy($src);
        
        $postImageQuery = "INSERT INTO `$db_name`.`images`(`image`, `user`, `caption`) VALUES(?, ?, ?)";
        $postImageResult = $db_name->prepare($postImageQuery);
        $postImageResult->bindParam(":image", $newImageName, PDO::PARAM_STR);
        $postImageResult->bindParam(":user", $userid, PDO::PARAM_STR);
        $postImageResult->bindParam(":caption", $caption, PDO::PARAM_STR);
        $postImageResult->execute();
        die();
    }
    else if (isset($_POST['url']) && isset($_POST['post_pic']))
    {
        echo "<script>alert('You forgot something like taking a picture or selecting a frame');</script>";
    }
?>
<html>
    <head>
        <title>Upload picture</title>
		<link rel="stylesheet" href="../main.css">
    </head>
    <body>
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
                    <img class="frame" id="lips" src="../uploads/Lips-Sticker-01_large.jpg">
                    <img class="frame" id="catpaws" src="../uploads/6733.png">
                    <img class="frame" id="vendetta" src="../uploads/Trends-on-Wall-Vendetta-Mask-SDL956351653-1-9a5f0.jpg">
                    <img class="frame" id="mickey" src="../uploads/Married-To-The-Mob-Birdie-Sticker-_261461.jpg">
                </div>
            </div>
            <div id="side">
            </div>
        </div>
        <div id="snackbar"></div>

        <script type="text/javascript">
            function hasGetUserMedia()
            {
                return !!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia);
            }
                const constraints = {
                video: true
                };
                const video = document.getElementById('vid');
                const img = document.getElementById('captured_one');
                const canvas = document.getElementById('screenshot');
                const shoot = document.getElementById('take_pic');
                const re_shoot = document.getElementById('take_another_one');
                const post_it = document.getElementById('post_pic');
                const url = document.getElementById('url');
                const cat = document.getElementById('catpaws');
                const vendetta = document.getElementById('vendetta');
                const lips = document.getElementById('lips');
                const mickey = document.getElementById('mickey');
                var context = canvas.getContext('2d');
                const frame = document.getElementById('omunye');
                const chosenFrame = document.getElementById('chosen_frame');
                const origin = document.getElementById('origin');
                frame.style.display = "none";
            if (hasGetUserMedia())
            {
                navigator.mediaDevices.getUserMedia(constraints).
                then((stream) => {video.srcObject = stream});
                navigator.mediaDevices.getUserMedia(constraints).
                then((stream) => {video.srcObject = stream});
                //When you take a picture
                shoot.onclick = video.onclick = function()
                {
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    context.drawImage(video, 0, 0);
                    img.src = canvas.toDataURL('image/jpeg');
                    url.value = canvas.toDataURL('image/jpeg');
                    img.style.display = "block";
                    video.style.display = "none";
                    origin.value = "cam";
                };
                re_shoot.onclick = function()
                {
                    img.src = "";
                    url.value = "";
                    img.style.display = "none";
                    video.style.display = "block";
                };
            }
            else
            {
                alert('getUserMedia() is not supported by your browser');
			}
                cat.addEventListener("click", function()
                {
                    if (video.style.display != "none" || origin.value == "file")
                    {
                        frame.src = cat.src;
                        chosenFrame.value = cat.src;
                        frame.style.display = "block";
                    }
                });
                vendetta.addEventListener("click", function()
                {
                    if (video.style.display != "none" || origin.value == "file")
                    {
                        frame.src = vendetta.src;
                        chosenFrame.value = vendetta.src;
                        frame.style.display = "block";
                    }
                });
                lips.addEventListener("click", function()
                {
                    if (video.style.display != "none" || origin.value == "file")
                    {
                        frame.src = lips.src;
                        chosenFrame.value = lips.src;
                        frame.style.display = "block";
                    }
                });
                mickey.addEventListener("click", function()
                {
					if (video.style.display != "none" || origin.value == "file")
                    {
                        frame.src = mickey.src;
                        chosenFrame.value = mickey.src;
                        frame.style.display = "block";
                    }
                });
                var loadFile = function(event)
                {
                    if (event.target.files[0])ﬁ
                    {
                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;
                        img.src = URL.createObjectURL(event.target.files[0]);
                        canvas.innerHTML = "<img src='" + img.src + "'>";
                        url.value = canvas.toDataURL('image/jpeg');
                        img.style.display = "block";
                        video.style.display = "none";
                        origin.value = "file";
                    }
                };
				function deletePost(id)
				{
					var srcId = "image"+id;
					var path = document.getElementById(srcId).src;
					$.ajax({url: "deletePost.php?id=" + id + "&path=" + path, success: function(result)
					{
						if (result == "Deleted")
						{
							location.reload();
							showSnackbar("Post deleted");
						}
						showSnackbar(result);
					}})
                }
                
				function showSnackbar(message) {
					var snackbar = document.getElementById("snackbar");
					snackbar.innerHTML = message;
					snackbar.className = "show";
					setTimeout(function()
					{
						snackbar.className = "";
					}, 3000);
                }
                
				function logOut()
				{
					$.ajax({url:"logOut.php", success: function(result)
					{
						location.reload();
					}})
				}
        </script>
        <div id="footer">
            <p id="f_msg">This website is proundly provided to you by Zaid Nazam</p>
            <p id="cr">znazam 2019</p>
        </div>

    </body>
</html>