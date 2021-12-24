<?php
	$msg_flag=0;
	$error1="";
	$error2="";
if (isset($_GET['p_mismatch']) || isset($_GET['c_mismatch'])) {
	$msg_flag=1;
	if ($_GET['p_mismatch']=="yes"){
		$error1="Pasword Invalid";
	}
	if ($_GET['c_mismatch']=="yes"){
		$error2="Type 'YES'";
	}
	if($_GET['p_mismatch']=="yes" && $_GET['c_mismatch']=="yes"){
		$error=$error1." & ".$error2;
	}
	else{
		$error = $error1.$error2;
	}
}
?>
<html>
	<head>
		<title>Delete Account ?</title>
		<link  rel="stylesheet" type="text/css" href="..\login\login.css">
		<link rel = "icon" href = "..\res\sitedp.png" type = "image/x-icon"> 
	</head>
	<body>
		<nav><div class="bar">
			<p class="head" align="center">Delete Account ?</p>
		</div>
		<div class="hborder"></div>
	</nav>
	<div class="tdiv"></div>
	<div class="mdiv" align="center">
		<table>
			<form action="del_acc.php" method="POST">
				<tr align="center">
					<td class="ltd">Please Confirm, Type 'YES' in Capital,<br>if You realy want to delete your Accont.<br></td>
					<td><br><input class="inpt" type="text" placeholder="" name="confi" required></td>
				</tr>
				<tr align="center">
					<td class="ltd">Confirm Pasword<br></td>
					<td><br><input class="inpt" type="password" placeholder="" name="password" required></td>
				</tr>
				<tr align="center">
					<td> <br> <input type="submit" class="btn" value="DELETE" name="dele"><br><br></td>
					<td><?php if($msg_flag==1){echo '<tr align="center"><td><p class="already">'.$error.'</p></td></tr>';}?></td>
				</tr>
			</form>
			<form action="del_acc.php" method="POST">
				<tr align="center"><td class="ltd">Or you can just Desable your Accont,<br>Your Accont will Become Inactive.<br>Your Accont will be enebled if you login it.<br></td> </tr>
				<tr align="center"><td> <br> <input type="submit" class="btn" value="DESABLE" name="dese"><br><br></td> </tr>
			</form>
		</table>
	</div>
		<div class="bdiv"></div>
</body>
</html>
