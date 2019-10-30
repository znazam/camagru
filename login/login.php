<html>
    <head>
        <style>
            body {
            background-image: url('https://thumbs.dreamstime.com/b/image-wolf-jumping-sky-moony-night-warewolf-light-161016922.jpg');
            background-repeat: no-repeat;
           background-size: cover;
           background-position: center;
        }
        p {
        color: black;
        font-size: 29px;
        font-family: calibri;
        }
        form {
            margin-top: 9%;
            margin-left:-70%;
        }
        button {
            border-radius: 40%;
            height: 25px;
            background-color: lightblue;

        }
		a {
			color: white;
			font-size: 20px;
		}
        </style>
    </head>
   <body>
      <center><form action="../model/login_data.php" method="POST">
           <p>Email address: <input type="text" name="email"/></p>
           <p>Password: <input  type="password" name="passwd"/></p>
           <a href = "../index.php"><input type = "submit"></a>
			<br/><br/><br/>
			<a href = "register.php">Don't have an account?  Sign Up now</a>
       </form></center>
   </body>
</html>