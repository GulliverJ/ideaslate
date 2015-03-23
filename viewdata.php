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

    //Users table
    echo "<br><h2>Users</h2>";
    $sql_select = "SELECT user_id, username, email, fname, lname, joined, verified FROM users";
    $stmt = $conn->query($sql_select);
    $results = $stmt->fetchAll(); 
    if(count($results) > 0) {
        echo "<table>";
        echo "<tr><th>user_id</th>";
        echo "<th>username</th>";
        echo "<th>email</th>";
        echo "<th>fname</th>";
        echo "<th>lname</th>";
        echo "<th>joined</th>";
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

    //User Tags
    echo "<br><h2>User Tags</h2>";
    $sql_select = "SELECT user_id, tag_id FROM user_tags";
    $stmt = $conn->query($sql_select);
    $results = $stmt->fetchAll(); 
    if(count($results) > 0) {
        echo "<table>";
        echo "<tr><th>user_id</th>";
        echo "<th>tag_id</th></tr>";
        foreach($results as $row) {
            echo "<tr><td>".$row['user_id']."</td>";
            echo "<td>".$row['tag_id']."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h3>Empty set</h3>";
    }

    //Projects table
    echo "<br><h2>Projects</h2>";
    $sql_select = "SELECT project_id, title, abstract, description, status_id, created, hidden FROM projects";
    $stmt = $conn->query($sql_select);
    $results = $stmt->fetchAll(); 
    if(count($results) > 0) {
        echo "<table>";
        echo "<tr><th>project_id</th>";
        echo "<th>title</th>";
        echo "<th>abstract</th>";
        echo "<th>description</th>";
        echo "<th>status_id</th>";
        echo "<th>created</th>";
        echo "<th>hidden</th></tr>";
        foreach($results as $row) {
            echo "<tr><td>".$row['project_id']."</td>";
            echo "<td>".$row['title']."</td>";
            echo "<td>".$row['abstract']."</td>";
            echo "<td>".$row['description']."</td>";
            echo "<td>".$row['status_id']."</td>";
            echo "<td>".$row['created']."</td>";
            echo "<td>".$row['hidden']."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h3>Empty set</h3>";
    }

    //Developer Roles
    echo "<br><h2>Developer Roles</h2>";
    $sql_select = "SELECT user_id, project_id, role_id FROM developer_roles";
    $stmt = $conn->query($sql_select);
    $results = $stmt->fetchAll(); 
    if(count($results) > 0) {
        echo "<table>";
        echo "<tr><th>user_id</th>";
        echo "<th>project_id</th>";
        echo "<th>role_id</th></tr>";
        foreach($results as $row) {
            echo "<tr><td>".$row['user_id']."</td>";
            echo "<td>".$row['project_id']."</td>";
            echo "<td>".$row['role_id']."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h3>Empty set</h3>";
    }

    //Project Sectors
    echo "<br><h2>Project Sectors</h2>";
    $sql_select = "SELECT project_id, sector_id FROM project_sectors";
    $stmt = $conn->query($sql_select);
    $results = $stmt->fetchAll(); 
    if(count($results) > 0) {
        echo "<table>";
        echo "<tr><th>project_id</th>";
        echo "<th>sector_id</th></tr>";
        foreach($results as $row) {
            echo "<tr><td>".$row['project_id']."</td>";
            echo "<td>".$row['sector_id']."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h3>Empty set</h3>";
    }

    //Project Tags
    echo "<br><h2>Project Tags</h2>";
    $sql_select = "SELECT project_id, tag_id FROM project_tags";
    $stmt = $conn->query($sql_select);
    $results = $stmt->fetchAll(); 
    if(count($results) > 0) {
        echo "<table>";
        echo "<tr><th>project_id</th>";
        echo "<th>tag_id</th></tr>";
        foreach($results as $row) {
            echo "<tr><td>".$row['project_id']."</td>";
            echo "<td>".$row['tag_id']."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h3>Empty set</h3>";
    }

    //Project Platforms
    echo "<br><h2>Project Platforms</h2>";
    $sql_select = "SELECT project_id, platform_id FROM project_platforms";
    $stmt = $conn->query($sql_select);
    $results = $stmt->fetchAll(); 
    if(count($results) > 0) {
        echo "<table>";
        echo "<tr><th>project_id</th>";
        echo "<th>platform_id</th></tr>";
        foreach($results as $row) {
            echo "<tr><td>".$row['project_id']."</td>";
            echo "<td>".$row['platform_id']."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h3>Empty set</h3>";
    }
?>

</body>
</html>