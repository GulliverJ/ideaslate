<?php
	
/* 	Author: Thomas Russell <thomas.russell97@googlemail.com>
 * 	Purpose: Script to add user to the database.
 *
 */
 
 require( 'passwordlib/password.php' );
 
 $server_name = "eu-cdbr-azure-north-c.cloudapp.net";
 $db_name = "isdevAnAqTBTyio8";
 $db_username = "b9b9fc737b7f9b";
 $db_password = "8bce3b67"; 
 
 // Get our user-data:
 $username = isset( $_POST['username'] ) ? $_POST['username'] : die( "You must enter a valid username" );
 $password = isset( $_POST['password'] ) ? $_POST['password'] : die( "You must enter a valid password" );
 $email = isset( $_POST['email'] ) ? $_POST['email'] : "";
 
 try {
	 $connection = new PDO( "mysql:host=$server_name;dbname=$db_name", $db_username, $db_password );
	 $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	 
	 // Check to see if that username or password exist:
	 $sql_statement = $connection->prepare( "SELECT count(*) FROM users WHERE username = ?" );
	 $sql_statement->execute( array( $username ) );
	 if( $sql_statement->fetch( PDO::FETCH_NUM ) > 0 )
	 {
		 // That username already exists:
		 die( "That username already exists" );
	 }
	 
	 $sql_statement = $connection->prepare( "SELECT count(*) FROM users WHERE email = ?" );
	 $sql_statement->execute( array( $email ) );
	 if( $sql_statement->fetch( PDO::FETCH_NUM ) > 0 )
	 {
		 // That email is already used:
		 die( "There already exists an account under that email address" );
	 }
	 
	 // Add the user to the database:
	 $sql_statement = $connection->prepare( "INSERT INTO users( username, email, joined, password ) VALUES (?, ?, NOW(), ?)" );
	 $sql_statement->execute( array( $username, $email, password_hash( $password, PASSWORD_DEFAULT ) ) );
 }
 catch( PDOException $e )
 {
	 die( "There was an internal database error whilst creating your user, error code (" . $e->getCode() . ")" );
 }
 
?>