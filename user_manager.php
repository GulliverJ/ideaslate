<?php

/*	Author: Thomas Russell <thomas.russell97@googlemail.com>
 *	Purpose: User Manager, does rudimentary security checks and allows for log-in etc.
 */
 
 session_start();
 
  // We need the password compatibility library:
 require( '/passwordlib/password.php' );
 
 // Function which checks the status of the session and updates the
 // last activity; should be called at the beginning of each file.
 // also checks to see if the user in $_SESSION exists, if not we
 // log out:
 function CheckSession()
 {
	 if( isset( $_SESSION['last_activity'] ) && (time() - $_SESSION['last_activity'] > 1800 ) )
	 {
		 // Log us out:
		 Logout();
		 return;
	 }
	 else
	 {
		 $_SESSION['last_activity'] = time();
	 }
	 
	 if( isset( $_SESSION['created'] ) && (time() - $_SESSION['created'] > 1800) )
	 {
		 session_regenerate_id( true );
		 $_SESSION['created'] = time();
	 }
	 
	 // Check that we're a valid user (nothing has been spoofed):
	 if( isset( $_SESSION['username'] ) )
	 {
		 $server_name = "eu-cdbr-azure-north-c.cloudapp.net";
 		 $db_name = "isdevAnAqTBTyio8";
 		 $db_username = "b9b9fc737b7f9b";
 		 $db_password = "8bce3b67"; 
		 
		 try {
			 $connection = new PDO( "mysql:host=$server_name;dbname=$db_name", $db_username, $db_password );
			 $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			 
			 $sql_query = $connection->prepare( "SELECT EXISTS(SELECT 1 FROM users WHERE `username` = ?)" );
			 $sql_query->execute( array($_SESSION['username']) );
			 
			 $row = $sql_query->fetch( PDO::FETCH_ASSOC );
			 if( !$row )
			 {
				 Logout();
				 return;
			 }
		 }
		 catch( PDOException $e )
		 {
			 Logout();
			 return;
		 }
	 }
 }
 
 // Logs out the user and destroys the session:
 function Logout()
 {
	 // Destroy the session:
	 session_unset();
	 session_destroy();
	 session_write_close();
 }
 
 // If we've been posted a username and password then we want to
 // see if we can log in:
 if( isset( $_POST['username'] ) && isset( $_POST['password'] ) )
 {
	 if( UserLogin( $_POST['username'], $_POST['password'] ) )
	 {
		 // We're logged in:
		 
	 }
	 else
	 {
		 // The login failed:
		 die( 'Login failed, username or password is incorrect' );
	 }
 }
 
 // Checks to see if a user can be logged in, if they can be then return true and log them in
 // else return false:
 function UserLogin( $username, $password )
 {
	 $server_name = "eu-cdbr-azure-north-c.cloudapp.net";
 	 $db_name = "isdevAnAqTBTyio8";
 	 $db_username = "b9b9fc737b7f9b";
 	 $db_password = "8bce3b67"; 
	 
	 try {
		 $connection = new PDO( "mysql:host=$server_name,dbname=$db_name", $db_username, $db_password );
		 $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		 
		 $sql_query = $connection->prepare( "SELECT username, password FROM users WHERE `username` = ? LIMIT 1" );
		 $sql_query->execute( array( $username ) );
		 
		 // Does the user exist?
		 $result = $sql_query->setFetchMode( PDO::FETCH_ASSOC );
		 if( $user = $sql_query->fetch() )
		 {
			 if( password_verify( $password, $user['password'] ) )
			 {
				 $_SESSION['username'] = $username;
				 $_SESSION['last_activity'] = time();
				 $_SESSION['created'] = time();
				 
				 return true;
			 }
		 }
	 }
	 catch( PDOException $e )
	 {
		 return false;
	 }
	 
	 return false;
 }

?>