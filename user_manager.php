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
		 $server_details = include( 'server_details.php' );
		 $server_name = $server_details['server_name'];
		 $db_name = $server_details['db_name'];
		 $db_username = $server_details['db_username'];
		 $db_password = $server_details['db_password'];
		 
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
 
 // Performs a simple boolean check to see if we're logged in:
 function LoggedIn()
 {
	 // Make sure the session is valid:
	 CheckSession();
	 if( isset( $_SESSION['username'] ) )
	 {
		 return true;
	 }
	 
	 return false;
 }
 
 // Gets the current username:
 function GetUsername()
 {
	 return isset( $_SESSION['username'] ) ? $_SESSION['username'] : "Not Logged In";
 }
 
 // Gets the users profile image:
 function GetProfileImage()
 {
	 $server_details = include( 'server_details.php' );
	 $server_name = $server_details['server_name'];
	 $db_name = $server_details['db_name'];
	 $db_username = $server_details['db_username'];
	 $db_password = $server_details['db_password'];
	 
	 try {
		 $connection = new PDO( "mysql:host=$server_name;dbname=$db_name", $db_username, $db_password );
		 $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		 
		 $sql_statement = $connection->prepare( "SELECT avatar_name FROM users WHERE `username` = ?" );
		 $sql_statement->execute( array( $_SESSION['username'] ) );
		 
		 $user = $sql_statement->fetch( PDO::FETCH_ASSOC );
		 return strlen($user['avatar_name']) == 0 ? "testdp.jpg" : $user['avatar_name'];
	 }
	 catch( PDOException $e )
	 {
		 return "";
	 }
 }
 
 // Checks to see if a user can be logged in, if they can be then return true and log them in
 // else return false:
 function UserLogin( $username, $password )
 {
	 $server_details = include( 'server_details.php' );
	 $server_name = $server_details['server_name'];
 	 $db_name = $server_details['db_name'];
 	 $db_username = $server_details['db_username'];
 	 $db_password = $server_details['db_password']; 
	 
	 try {
		 $connection = new PDO( "mysql:host=$server_name;dbname=$db_name", $db_username, $db_password );
		 $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		 
		 $sql_query = $connection->prepare( "SELECT password FROM users WHERE `username` = ? LIMIT 1" );
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

 // If we've been posted a username and password then we want to
 // see if we can log in:
 if( isset( $_POST['username'] ) && isset( $_POST['password'] ) )
 {
	 $username = $_POST['username'];
	 $password = $_POST['password'];
	 if( UserLogin( $username, $password ) )
	 {
		 // We're logged in:
		 die( 'true' );
	 }
	 else
	 {
		 // The login failed:
		 die( 'false' );
	 }
 }
 else if( isset( $_POST['logout'] ) && $_POST['logout'] == true )
 {
	 Logout();
 }

?>