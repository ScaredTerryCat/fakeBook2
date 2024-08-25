<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
</style>
</head>
<body>
<div class="banner"><h1>Add friend</h1></div>
<div class="formContainer">
<form method='post' action=''>
<input placeholder="Enter person name" type="text" name="searchedPerson"></input>
</form>
</div>
<h2>Suggested potential friends:</h2>
<div class="suggestedFriends">
<form action="" method="post">

<?php
session_start();
$username = $_SESSION["username"];
$dName = $_SESSION["databaseName"];
$dUsername = $_SESSION["databaseUsername"];
$dPassword = $_SESSION["databasePassword"];
$host = $_SESSION["host"];
$conn = mysqli_connect($host, $dUsername, $dPassword, $dName);

$searchedPerson = $_POST["searchedPerson"] ?? null;

if ($searchedPerson) {
    $query = "SELECT username FROM authentication WHERE username = ?";
    $configuredQuery = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($configuredQuery, "s", $searchedPerson);
    mysqli_stmt_execute($configuredQuery);
    $result = mysqli_stmt_get_result($configuredQuery);
    
    if (mysqli_num_rows($result) > 0) {
        echo "<div style='background-color:lightblue;width:fit-content;padding:10px;'><form method='post' action='' style='max-width:100%;box-sizing:border-box;overflow-wrap:break-word;'>";
        echo "<h3 style='color:blue'> Do you want to add " . htmlspecialchars($searchedPerson) . " ?</h3>";
        echo "<input type='hidden' name='confirmPerson' value='" . htmlspecialchars($searchedPerson) . "'/>";
        echo '<h3><input name="response1" style="background-color:lightgreen;margin-right:10px;" type="submit" value="Yes"/>';
        echo '<input name="response1" style="background-color:red" type="submit" value="No"/></h3>';
        echo "</form></div>";  
    }
}

if (isset($_POST["confirmPerson"]) && isset($_POST["response1"])) {
    $confirmPerson = $_POST["confirmPerson"];
    $response1 = $_POST["response1"];

    if ($response1 == "Yes") {
        $query = "INSERT INTO relations (username1, username2) VALUES (?, ?)";
        $configuredQuery = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($configuredQuery, "ss", $username, $confirmPerson);
        mysqli_stmt_execute($configuredQuery);
	$configuredQuery=mysqli_prepare($conn,$query);
	mysqli_stmt_bind_param($configuredQuery,"ss",$confirmPerson,$username);
	mysqli_stmt_execute($configuredQuery);

        echo "<p style='color:green;'>You have added " . htmlspecialchars($confirmPerson) . " as a friend.</p>";
    } else {
        echo "<p style='color:red;'>You did not add " . htmlspecialchars($confirmPerson) . " as a friend.</p>";
    }

    // Clear the search to reset the form
    $_POST["searchedPerson"] = null;
}

// If no specific person was searched or added, show suggested friends
if (!$searchedPerson) {
    $query = "SELECT username FROM authentication WHERE username != ? LIMIT 15;";
    $configuredQuery = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($configuredQuery, "s", $username);
    mysqli_stmt_execute($configuredQuery);
    $result = mysqli_stmt_get_result($configuredQuery);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<input name='searchedPerson' type='submit' value='" . htmlspecialchars($row["username"]) . "'/><br><br>";
    }
}
?>

</form>
</div>
</body>
</html>

