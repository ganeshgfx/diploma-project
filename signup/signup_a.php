<html>
<head>
	<title>Signup</title>
	<link rel="stylesheet" type="text/css" href="../res/css/md2.css">
	<link rel="stylesheet" type="text/css" href="../css/ui.css">
	<link  rel="stylesheet" type="text/css" href="signup.css">
	<link rel = "icon" href = "..\res\sitedp.png" type = "image/x-icon">
	<script src="signup.js"></script>
</head>
<body>
	<nav>
		<div class="bar">
			<p class="head" align="center">Signup</p>
		</div>
		<div class="hborder"></div>
	</nav>
<div class="mdiv" align="center" id="p1">
	<table border="0" align="center" class="ltd">
		<tr>
			<td><p>User Name</p></td>
			<td><input oninput="check_user(this.value)" id="uid" class="inpt" type="text" placeholder=" Eg. Alex"></td>
			<td id='umsg' class='already'></td>
		</tr>
		<tr>
			<td><p>Full Name</p></td>
			<td>
				<input id="nm" class="inpt" type="text" placeholder=" Eg. Alex Pax" name="name">
			</td>
			<td id='nmmsg' class='already'></td>
		</tr>
		<tr>
			<td><p>E-Mail</p></td><br>
			<td>
				<input id="em" class="inpt" type="email" placeholder=" Eg. alexpax@email.com" name="email" oninput="check_email(this.value)">
			</td>
			<td id='Emsg' class='already'></td>
		</tr>
		<tr>
			<td><p>Phone</p></td>
			<td>
				<input id="pn" class="inpt" type="number" placeholder=" Eg. Alex " name="phone" >
			</td>
			<td id='pnmsg' class='already'></td>
		</tr>
		<tr>
			<td><p>Birth Date</p></td>
			<td>
				<input id="date" class="inpt" type="date" name="date" required>
			</td>
			<td id='dtmsg' class='already'></td>
		</tr>
		<tr>
			<td colspan="3" align="center"> <br> <input class="btn" type="button" value="Next" onclick="next_password()"></td>
		</tr>
</table>
</div>
<div id="p2" style="display: none;">
		<table border="0" align="center" class="ltd">
		<tr align="center"><td colspan="2" id='passmsg' class='already'></td></tr>
		<tr>
			<td align="left"><p>Password</p></td>
			<td><input oninput="chk_pass_strong()" id="pass" class="inpt" type="text" placeholder=" ***"></td>
		</tr>
		<tr>
			<td align="left"><p>Confirm Password</p></td>
			<td><input oninput="" id="cpass" class="inpt" type="text" placeholder=" ***"></td>
		</tr>
		<tr>
			<td colspan="3" align="center"><input class="btn" type="button" value="Next" onclick="signup()"></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
			<div class="passW" id="passW">
				<p id="dp"> Your Password is Weak <br> Use following:</p>
				<p id="ln"> 8 Character </p>
				<p id="uc"> Upper Case [A,B..Z]</p>
				<p id="lc"> Lower Case [a,b..z]</p>
				<p id="no"> Numbers [0,1..9]</p>
				<p id="ss"> Symbols [@,#..?]</p>
			<div>
			</td>
		</tr>
</table>
</div>
</body>
</html>