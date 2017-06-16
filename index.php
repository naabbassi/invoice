<?php
session_start();
if (isset($_REQUEST['exit'])){
session_destroy();
header("Location: index.html");
exit();
}
include 'asset/class/modelslist.php';
if (isset($_SESSION["LoggedIn"])) {
		$page=$_REQUEST['page'];
		include 'master.php';
		exit;	
}
if (isset($_REQUEST['login'])) {
$user=new user();
$count=$user->count("username='".addslashes(htmlspecialchars($_POST['usern']))."' And password='".addslashes(htmlspecialchars($_POST['userp']))."'");
	if ($count==1) {
				$_SESSION["LoggedIn"]=true;
				$_SESSION["User"]=addslashes(htmlspecialchars($_POST['usern']));
				$page=$_REQUEST['page'];
				include('master.php');
				exit;
			} 
			else
			{	
				$error="Username & Password Not Valid";
				include 'login.php';
			 
			} }

			else {
			include 'login.php';
			}
		?>