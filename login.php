<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<style>
    body{
        position: relative;
    }
    form{
        position: absolute;
        top: 200px;
        left: 575px;
    }
    table{
        text-align: center;
        border: 1;
    }
    table td{
        padding: 8px;
    }
</style>
</head>
<body>
<center>
<form action="inputlogin.php" method="POST">
	<h1>Login</h1>
	<table border="1">
		<tr>
			<td><input type="text" name="username" id="username" placeholder="Username"></td>
		</tr>
		<tr>
			<td><input type="password" name="password" id="password" placeholder="Password"></td>
		</tr>
		<tr>
			<td><input type="submit" name="cmdlogin" id="cmdlogin" value="Login"></td>
		</tr>
	</table>
    <p>don't have any account? <a href="register.php">Register</a></p>
</form>
</center>
</body>
</html>