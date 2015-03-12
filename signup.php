<?php
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
    // Insert registration info
    if(!empty($_POST)) {
    try {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $date = date("YYYY-mm-dd");
        // Insert data
        $sql_insert = "INSERT INTO users (username, email, joined, password) 
                   VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bindValue(1, $username);
        $stmt->bindValue(2, $email);
        $stmt->bindValue(3, $date);
        $stmt->bindValue(4, $password);
        $stmt->execute();
    }
    catch(Exception $e) {
        die(var_dump($e));
    }
    echo "<h3>Your're registered!</h3>";
    }
?>