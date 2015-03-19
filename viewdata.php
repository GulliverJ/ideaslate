<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
     border-top: 1px solid gray;
     padding-left: 5px;
     padding-right: 5px;
}

body {
  font-family: "Helvetica Neue", Arial, Sans-Serif;
}

</style>
</head>
<body>

<?php
echo "<p>This is working 2</p>";
// Create connection
 // DB connection info
    $host = "eu-cdbr-azure-north-c.cloudapp.net";
    $user = "b9b9fc737b7f9b";
    $pwd = "8bce3b67";
    $db = "isdevAnAqTBTyio8";
    // Connect to database.
    try {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e){
        die(var_dump($e));
    }

    echo "<p>This is working 3</p>";

    $sql_select = "SELECT user_id, username, email, fname, lname, joined, verified FROM users";
    $stmt = $conn->query($sql_select);
    $results = $stmt->fetchAll(); 
    if(count($results) > 0) {
        echo "<h2>Users</h2>";
        echo "<table>";
        echo "<tr><th>user_id</th>";
        echo "<tr><th>username</th>";
        echo "<tr><th>email</th>";
        echo "<tr><th>fname</th>";
        echo "<tr><th>lname</th>";
        echo "<tr><th>joined</th>";
        echo "<th>verified</th></tr>";
        foreach($results as $row) {
            echo "<tr><td>".$row['user_id']."</td>";
            echo "<td>".$row['username']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['fname']."</td>";
            echo "<td>".$row['lname']."</td>";
            echo "<td>".$row['joined']."</td>";
            echo "<td>".$row['verified']."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h3>Empty set</h3>";
    }




?>

</body>
</html>