<?php
$username=$_POST["username"];
$password1=$_POST["password1"];
$password2=$_POST["password2"];
if($password1!=$password2){header("Location:differentPasswords.html");}
$securityQuestion=$_POST["securityQuestion"];
$securityAnswer=$_POST["securityAnswer"];

$host="localhost";$user="root";$passwd="";$database="fakebook";
$conn=mysqli_connect($host,$user,$passwd,$database);


$query1='select * from authentication where username=?;';
$configuredQuery1=mysqli_prepare($conn,$query1);
mysqli_stmt_bind_param($configuredQuery1,"s",$username);
mysqli_stmt_execute($configuredQuery1); 	
$result=mysqli_stmt_get_result($configuredQuery1);
if(mysqli_fetch_assoc($result)){
header("Location:alreadyExists.html");
}
else{
$query='insert into authentication (username,password,securityQuestion,securityAnswer) values(?,?,?,?);';
$configuredQuery=mysqli_prepare($conn,$query);
mysqli_stmt_bind_param($configuredQuery,"ssss",$username,$password1,$securityQuestion,$securityAnswer);
mysqli_stmt_execute($configuredQuery);
echo '
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body{display:flex;
height:100vh;
justify-content:center;
align-items:center;}
</style>
</head>
<body>
<h1>Account created successfully. <a href="login.html">Click here to login</a></h1>
</body>
</html>
';
}


?>