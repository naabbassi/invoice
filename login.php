<html>
	<head>
		<meta charset="utf-8">
		<title>Invoice Managment System</title>
	</head>
	<style type="text/css">
		body
		{
			background:#103344;
			background-size: 100% ;
			font-family:tahoma;
			font-size:14px;
			color:#7c7c7c;
		}
		#wrapper
		{
			margin: 100px auto;width:350px;
			background:rgba(255,255,255,.2);
			padding:12px;border-radius:7px;
			text-align:center;
		}
		.continer{background:#fff;padding:17px;border-radius:7px;}
		label
		{
			width:80px;
			display:inline-block;
		}
		input
		{
			padding:4px;
			width:200px;
			height:32px;
			border-radius:4px;outline:none;
			border:3px solid #cdcdcd;
			background-color:transparent;
		}

	.btnb{margin:15px 0 5px 0;
		padding:5px 20px;
		background:#103344;
		color:#fff;
		font-size:18px;
		border-radius:5px;
		min-width:55px;
		display:inline-block;
		transition: background 0.2s  ease-in-out;
		-webkit-transition: background 0.2s ease-in-out;
		border:none;
	}
	.btnb:hover{
		background:#103324;
	}
	</style>
	<body>
		<div id="wrapper">
			<div class="continer">
			<form action="home.html?login" method="post">
				<p>Login</p>
			<p><label>Username :</label><input name="usern" type="text" placeholder="username"></p>
			<p><label>password :</label><input name="userp" type="password" placeholder="password"></p>
			<p><input  type="submit" value="login" class="btnb"></p>
			<?php if (isset($error)) echo $error; ?>
			</form>
		</div></div>
	</body>
</html>