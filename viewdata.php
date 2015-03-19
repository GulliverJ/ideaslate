<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
     border: 1px solid black;
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

$sql = "SELECT user_id, username, email, fname, lname, joined, verified FROM users";
$stmt = $conn->query($sql);
$result = $stmt->fetchAll();
if (count($result) > 0) {
     echo "<h1>Users</h1><br>"
     echo "<table><tr><th>user_id</th>
                      <th>username</th>
                      <th>email</th>
                      <th>fname</th>
                      <th>lname</th>
                      <th>joined</th>
                      <th>verified</th>
                      </tr>";
     // output data of each row
     foreach($result as $row) {}
         echo "<tr><td>" . $row['user_id']. "</td>
                   <td>" . $row['username']. "</td>
                   <td>" . $row['email']. "</td>
                   <td>" . $row['fname']. "</td>
                   <td>" . $row['lname']. "</td>
                   <td>" . $row['joined']. "</td>
                   <td>" . $row['verified']. "</td>
                </tr>";
     }
     echo "</table><br><br>";
} else {
     echo "<p>Empty Set<p>";
}


?>

</body>
</html>