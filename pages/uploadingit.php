<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="main/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<header>
        <div class="headingss">
            <a href="gallery.php?page=1"><img src="https://static.thenounproject.com/png/18307-200.png" width="100" ></a>
            <a href="profile.php?page=1"><img src="https://image.shutterstock.com/image-vector/user-account-profile-circle-flat-260nw-467503004.jpg" width="100" width="100"></a>
            <a href="images.php"><img src="https://www.creativefabrica.com/wp-content/uploads/2018/10/Camera-logo-by-DEEMKA-STUDIO-580x406.jpg" width="40" height="40"></a>
            <a href="../login/logout.php">logout</a>
        </div>
    </header>
<form action="../modal/upload.php" method="post" enctype="multipart/form-data">
    Select Image File to Upload:
    <input type="file" name="file" required>
    <input type="submit" name="submit" value="Upload" >
    <br>
    <title>Caption</title>
    <textarea id="img_caption" type="text" name="caption"></textarea>
</form>
</body>
</html>