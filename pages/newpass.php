<?php session_start();
if(!$_SESSION['uid'])
header("Location: ../login/login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Newpass</title>
        <style>
            body {
            background-image: url('https://thumbs.dreamstime.com/b/image-wolf-jumping-sky-moony-night-warewolf-light-161016922.jpg');
            background-repeat: no-repeat;
		   background-size: cover;
        }
        p {
        color: black;
        font-size: 29px;
        font-family: calibri;
		text-align: left;
        }
        button {
            border-radius: 40%;
            height: 25px;
        }
		a {
			color: white;
			font-size: 20px;
			text-align: center;
		}
		</style>
		<title>newpassword</title>
    </head>
   <body>
      <form action="/cama/modal/newpassback.php" method="POST">
	  		<?php echo $msg;  ?>
	  		<p>Email was sent to your address</p>
			<p>Enter new password here<input type="password" name="password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/></p>
			<p>Re enter new password here<input type="password" name="newpass"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/></p>
			<div style="color:white"><?=isset($_GET['error']) ? $_GET['error'] : ""?></div>
			<input type = "submit" value="submit" name="submit">
       </form>
   </body>
</html>