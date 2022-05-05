<?php

// define('LBROOT',getcwd()); // LegoBox Root ... the server root
// include("core/controller/Database.php");
include "../../autoload.php";
session_start(); 
if(Session::getUID()=="") {
$user = $_POST['email'];
$pass = sha1(md5($_POST['password']));
$base = new Database();
$con = $base->connect();
$sql = "select * from pacient where (email= \"".$user."\" ) and password= \"".$pass."\" and is_active=1";
$query = $con->query($sql);
$found = false;
$userid = null;
$userEmail = null;
$username = null;
$lastname = null;
while($r = $query->fetch_array()){
	$found = true ;
	$userid = $r['id'];
	$userEmail = $r['email'];
	$username = $r['name'];
	$lastname = $r['lastname'];
}
 
if($found==true) {
//	print $userid;
	$_SESSION['user_id']=$userid ;
	$_SESSION['email']=$userEmail ;
	$_SESSION['username']=$username ;
	$_SESSION['lastname']=$lastname ;
	setcookie('username',$username);
	setcookie('lastname',$lastname);
	setcookie('userEmail',$userEmail);
	setcookie('userid',$userid);
	
//	print $_SESSION['userid'];
	print "Cargando ... $user";
	header('Location: /citas/');
}else {
	//print $sql;
	Core::alert("¡Usuario no encontrado!");
	print "<script>window.location='/citas/login.php';</script>";
}

}else{
	print "<script>window.location='/citas/index.php';</script>";
	
}
?>