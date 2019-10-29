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
      <form action="../model/create_user.php" method="POST">
           <p>First Name  <input type="text" name="firstname"/></p>
           <p>Last Name  <input  type="text" name="lastname"/></p>
           <p>Email   <input type="email" name = "email"/></p>
           <p>Password   <input type="password" name="password"/></p>
           <p>Retype Password  <input type="password" name="confirm_password"/></p>
           <input type = "submit" value="submit">
			<br/><br/>
       </form>
   </body>
</html>