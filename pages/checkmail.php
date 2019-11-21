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
		<title>checkmail</title>
    </head>
   <body width = "100%" style = "font-size: 1vw">
      <form action="../modal/verify.php" method="POST">
	  		<p>Check your email for verification Code</p>
			<p>Enter Verification Code Here <input type="Text" name="Code_Name"/></p>
			<div style="color:white"><?=isset($_GET['error']) ? $_GET['error'] : ""?></div>
			<input type = "submit" value="submit" name="submit">
       </form>
   </body>
</html>