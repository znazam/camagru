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
		<title>forgot password</title>
    </head>
   <body>
      <form action="/cama/modal/forgotpass.php" method="POST">
	  		<p>Email will be sent to your address</p>
			<p>Enter email address here<input type="Text" name="email"/></p>
			<input type = "submit" value="send" name="send">
       </form>
   </body>
</html>