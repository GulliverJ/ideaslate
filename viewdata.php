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

    echo "<p>This is working 3</p>";

    $sql_select = "SELECT * FROM status";
    $stmt = $conn->query($sql_select);
    $results = $stmt->fetchAll(); 
    if(count($results) > 0) {
        echo "<h2>People who are registered:</h2>";
        echo "<table>";
        echo "<tr><th>status_id</th>";
        echo "<th>status_label</th></tr>";
        foreach($results as $row) {
            echo "<tr><td>".$row['status_id']."</td>";
            echo "<td>".$row['status_label']."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h3>No one is currently registered.</h3>";
    }




?>

</body>
</html>