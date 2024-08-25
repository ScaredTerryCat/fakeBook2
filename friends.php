
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="friends.css">
</head>
<body>
<form method="get" action="">
<?php
$friends=array();
$friendsCount=0;
session_start();
if(!isset($_SESSION["showNumber"])){$_SESSION["showNumber"]=5;}
$actualUsername=$_SESSION["username"];
$host="localhost";
$pass="";
$user="root";
$database="fakebook";
$conn=mysqli_connect($host,$user,$pass,$database);


$query="select username2 from relations where username1=? limit 1";
$configured_query=mysqli_prepare($conn,$query);
mysqli_stmt_bind_param($configured_query,"s",$actualUsername);
mysqli_stmt_execute($configured_query);
$result=mysqli_stmt_get_result($configured_query);
echo "<div class='banner'><h1>Your friends</h1>";
echo'
<a href="addFriend.php">Add new friend</a>
';
while($row=mysqli_fetch_assoc($result)){
$friends[$friendsCount]=$row["username2"];
if($friends[$friendsCount]!=""){$friendsCount+=1;
}

}

for($i=0;$i<$friendsCount;$i++){
$friend=$friends[$i];
echo "<input type='submit' value='$friend' name='selectedFriend'></input>";
}
echo '</form></div>';

$_SESSION["friends"]=$friends;
$_SESSION["friendsCount"]=$friendsCount;
$_SESSION["host"]=$host;
$_SESSION["databasePassword"]=$pass;
$_SESSION["databaseUsername"]=$user;
$_SESSION["databaseName"]=$database;

if(isset($_GET["selectedFriend"])){
$selectedFriend=$_GET["selectedFriend"];
//start1

if(isset($_POST["newMessage"])){
$newMessage=$_POST["newMessage"];
$query2='insert into relations(username1,username2,conversation) values(?,?,?);';
$configured2=mysqli_prepare($conn,$query2);
mysqli_stmt_bind_param($configured2,"sss",$actualUsername,$selectedFriend,$newMessage);
mysqli_stmt_execute($configured2);
}
//stop1
$query1 = "SELECT conversation,username1
           FROM relations
           WHERE ((username1 = ? AND username2 = ?) 
              OR (username1 = ? AND username2 = ?)) AND 
	(conversation!='')
	ORDER BY id DESC
";

$configuredQuery1=mysqli_prepare($conn,$query1);
mysqli_stmt_bind_param($configuredQuery1,"ssss",$actualUsername,$selectedFriend,$selectedFriend,$actualUsername);
mysqli_stmt_execute($configuredQuery1);
$result1=mysqli_stmt_get_result($configuredQuery1);
echo "<div class='conversation'>";
$Usernames=array();
$Messages=array();
$len=0;
while($row=mysqli_fetch_assoc($result1)){
$Usernames[$len]=$row["username1"];
$Messages[$len]=$row["conversation"];
$len+=1;
}

if(isset($_POST["up"])){$showChange=1;$_POST["up"]=NULL;}
else if(isset($_POST["down"]) && $_SESSION["showNumber"]>=5){$showChange=-1;$_POST["down"]=NULL;}
else{$showChange=0;}
echo "
<form method='post' action=''>
<input name='up' type='submit' value='up'/>
<input name='down' type='submit' value='down'/>
</form>
";
$_SESSION["showNumber"]=$_SESSION["showNumber"]+$showChange;
if(sizeof($Messages)>4){
for($i=$_SESSION["showNumber"];$i>=$_SESSION["showNumber"]-4;$i--){
echo "<br>"."<blue>$Usernames[$i]</blue>"."<yellow>:<yellow>"."<greenB>$Messages[$i]</greenB>"."<br>";
}}
else{
for($i=sizeof($Messages)-1;$i>=0;$i--){
echo "<br>"."<blue>$Usernames[$i]</blue>"."<yellow>:<yellow>"."<greenB>$Messages[$i]</greenB>"."<br>";
}}

echo '</div>';
//start
echo '<hr><form method="post" action="">
New message:<input type="text" name="newMessage"></input>
<input type="submit" value="send"/>
</form>
';
//end
}echo '</body></html>';
?>