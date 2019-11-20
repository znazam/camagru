<?php
	session_start();
?>

<html>
    <head>
        <style>
            body {
            background-image: url('https://thumbs.dreamstime.com/b/scarecrow-stands-autumn-field-against-evening-sky-160915939.jpg');
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
    </head>
   <body>
      <form action="../modal/create_user.php" method="POST">
	  		<p>Username  <input type="text" name="username" minlength="5" required/></p>
        	<p>First Name  <input type="text" name="firstname" minlength="5" required/></p>
        	<p>Last Name  <input  type="text" name="lastname" minlength="5" required/></p>
        	<p>Email   <input type="email" name = "email" required/></p>
        	<p>Password   <input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/></p>
        	<p>Retype Password  <input type="password" name="confirm_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/></p>
			<div style="color:white"><?=isset($_GET['error']) ? $_GET['error'] : ""?></div>
        	<input type = "submit" value="submit" style="background-color: white;">
			<br/><br/>
       </form>
   </body>
</html>