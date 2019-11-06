<html>
    <head>
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
	  		<p>Email was sent to your address</p>
			<p>Enter new password here<input type="password" name="password"/></p>
			<p>Re enter new password here<input type="password" name="newpass"/></p>
			<input type = "submit" value="submit" name="submit">
       </form>
   </body>
</html>