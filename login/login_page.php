<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="../res/css/md2.css">
		<link rel="stylesheet" type="text/css" href="../css/ui.css">
		<link  rel="stylesheet" type="text/css" href="login.css">
		<link rel = "icon" href = "..\res\sitedp.png" type = "image/x-icon"> 
	</head>
	<body onresize="cngSize()">
		<nav><div class="bar">
			<p class="head" align="center">Login</p>
		</div>
		<div class="hborder"></div>
	</nav>
	<div class="tdiv"></div>
	<div class="mdiv" align="center">
		<table border="0">
				<tr align="center"><td id='msg' class='already'></td></tr>
				<tr align="center"><td class="ltd">User Name</td></tr>
				<tr align="center"><td><input id="username" onkeyup="enterU()" class="inpt" type="text" placeholder=" Eg. Alex " name="username"></td> </tr>
				<tr align="center"> <td class="ltd">Password</td> </tr>
				<tr align="center"> 
					<td>
						<input class="inpt" type="password" placeholder="" name="password" id="password" onkeyup="enterP()">
						<span 
							id="visibility" 
							class="material-icons pass_view">
								visibility
						</span>
					</td>
				</tr>
				<tr align="center">
					<td><input onclick="login()" class="btn" type="button" placeholder="Login" value="Login" id="btn"> </td>
				</tr>
				<tr align="center"><td class="f">No Account?<a href="../signup/signup_a.php">Create One</a></td> </tr>
				<!-- <tr align="center"> <td class="f">Forgot Password?<a href="#">Need Help</a></td> </tr> -->
			</table>
		</div>
		<div class="bdiv"></div>
</body>
<script src="login.js"></script>
</html>
