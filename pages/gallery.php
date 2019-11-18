<?php
session_start();
if($_SESSION['username'] != TRUE){
    header("location: ../login/login.php");}
    ?>
    <?php
include '../config/database.php';

$ID = $_SESSION['uid'];
$query = $conn->query("SELECT * FROM `images` WHERE `id` = $ID");
$array = $query->fetchall();
$x = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../main.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<header>
        <div class="logo">
        <a href="home.php"><img src="https://news.northeastern.edu/wp-content/uploads/2018/08/KingHuskyHead.jpg" height="2%" width="8%"></a>
        </div>
        <div class="headingss">
            <a href="gallery.php"><img src="images/Gallery-logos_transparent.png" width="100" ></a>
            <a href="profile.php"><img src="images/profile-logos_transparent.png" width="100" width="100"></a>
            <a href="images.php"><img src="images/picture-logos_transparent.png" width="40" height="40"></a>
            <a href="logout.php">logout</a>
        </div>
    </header>

    <div class="container">
        <div class="view-form">
            <div class="row">
                <?php
                
                $stmt = $conn->prepare("SELECT * FROM `images` order by `id` DESC");
                $stmt->execute();
                if($stmt->rowCount() > 0){
                    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row);

                ?>

            <div class="col">
                <p><?php echo $row['username']?></p>
                <img src="<?php echo $row['file_name']?>">
            </div>

            <?php
            }
        }
        ?>
            </div>
        </div>
    </div>
    <a href="https://www.facebook.com"><img src="images/facebook-logo-png-5a35528eaa4f08.7998622015134439826976.jpg" height="20px" width="50px"></a>
    <hr>
    <footer>
    &copytmansing 2019
    </footer>
</body>
</html>
