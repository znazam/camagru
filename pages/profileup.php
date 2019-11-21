<?php session_start();
if(!$_SESSION['uid'])
header("Location: ../login/login.php");
?>
<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../main.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>profile</title>
</head>
<body width = "100%" style = "font-size: 1vw">
<header>
        <div class="logo">
        <a href="../index.php" style="color: blue; font-size: 300%">HOMEPAGE</a>
        </div>
        <div id="header">
                <a href="../index.php" style="color: blue; font-size: 300%">Homepage</a>
                <div class="header_item">
                </div>
                <div class="header_item">
                    <a href="../pages/gallery.php?page=1" style="margin-left: -150%"><img class="user_icon" src="https://static.thenounproject.com/png/18307-200.png"></a>
                    <div class="header_item" style="display: inline; width: 30px;">
						<a href="profile.php?page=1" style="margin-left: 50%"><img src="https://image.shutterstock.com/image-vector/user-account-profile-circle-flat-260nw-467503004.jpg" width="100" width="100"></a>
						<a href="../login/logout.php" style="margin-left: 50%"><img class="user_icon" onclick="logOut()" src="https://www.freeiconspng.com/uploads/shutdown-icon-28.png"></a>
                    </div>
                </div>
    </header>
	<h1>Welcome <?php echo $_SESSION['username']; ?>
    <form action="../modal/profileup.php" method="POST">
        <input type="text" name="new_username"placeholder="username" >
        <button style="background-color: white" type="submit" name="username_submit">Update</button>
        <br>
        <input type="email" name="new_email"placeholder="email">
        <button style="background-color: white" type="submit" name="email_submit">Update</button>
        <br>
        <input type="password" name="new_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="new-password">
        <input type="password" name="re_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="re-enter new-password">
        <button style="background-color: white" type="submit" name="pass_submit">Update</button>
		<br>
		<p style="color: white; font-size: 50%">Notify me via email about comments?<button type="submit" name="notify"><?php if($_SESSION["notify"] == '0'){echo "yes";}else{echo "no";}?></button></p>
		<div style="color:white"><?=isset($_GET['error']) ? $_GET['error'] : ""?></div>
    </form>
    <hr>
    <div id="footer">
            <p id="f_msg" style="color: white">This website is proundly provided to you by Zaid Nazam</p>
            <p id="cr" style="color: white">znazam 2019</p>
    </div>
</body>
</html>