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
$servername = "eu-cdbr-azure-north-c.cloudapp.net";
$username = "b9b9fc737b7f9b";
$password = "8bce3b67";
$dbname = "isdevanaqtbtyio8";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT user_id, username, email, fname, lname, joined, verified FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
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
     while($row = $result->fetch_assoc()) {
         echo "<tr><td>" . $row["user_id"]. "</td>
                   <td>" . $row["username"]. "</td>
                   <td>" . $row["email"]. "</td>
                   <td>" . $row["fname"]. "</td>
                   <td>" . $row["lname"]. "</td>
                   <td>" . $row["joined"]. "</td>
                   <td>" . $row["verified"]. "</td>
                </tr>";
     }
     echo "</table><br><br>";
} else {
     echo "Empty Set";
}

$sql = "SELECT project_id, title, abstract, description, status_id, created, upvotes, hidden FROM projects";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     echo "<h1>Projects</h1><br>"
     echo "<table><tr><th>project_id</th>
                      <th>title</th>
                      <th>abstract</th>
                      <th>description</th>
                      <th>status_id</th>
                      <th>created</th>
                      <th>upvotes</th>
                      <th>hidden</th>
                      </tr>";
     // output data of each row
     while($row = $result->fetch_assoc()) {
         echo "<tr><td>" . $row["project_id"]. "</td>
                   <td>" . $row["title"]. "</td>
                   <td>" . $row["abstract"]. "</td>
                   <td>" . $row["description"]. "</td>
                   <td>" . $row["status_id"]. "</td>
                   <td>" . $row["created"]. "</td>
                   <td>" . $row["upvotes"]. "</td>
                   <td>" . $row["hidden"]. "</td>
                </tr>";
     }
     echo "</table><br><br>";
} else {
     echo "Empty Set";
}

</body>
</html>