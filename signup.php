<?php
	
/* 	Author: Thomas Russell <thomas.russell97@googlemail.com>
 * 	Purpose: Script to add user to the database.
 *
 */
 
 require( 'passwordlib/password.php' );
 
 $server_details = include( 'server_details.php' );
 $server_name = $server_details['server_name'];
 $db_name = $server_details['db_name'];
 $db_username = $server_details['db_username'];
 $db_password = $server_details['db_password'];  
 
 // Get our user-data:
 $username = isset( $_POST['username'] ) ? $_POST['username'] : die( "You must enter a valid username" );
 $password = isset( $_POST['pass'] ) ? $_POST['pass'] : die( "You must enter a valid password" );
 $email = isset( $_POST['email'] ) ? $_POST['email'] : "";
 
 try {
	 $connection = new PDO( "mysql:host=$server_name;dbname=$db_name", $db_username, $db_password );
	 $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	 
	 // Check to see if that username or password exist:
	 $sql_statement = $connection->prepare( "SELECT COUNT(*) FROM users WHERE `username` = ? LIMIT 1" );
	 $sql_statement->execute( array( $username ) );
	 if( $sql_statement->fetchColumn() > 0 )
	 {
		 // That username already exists:
		 die( "That username already exists" );
	 }
	 
	 $sql_statement = $connection->prepare( "SELECT COUNT(*) FROM users WHERE `email` = ? LIMIT 1" );
	 $sql_statement->execute( array( $email ) );
	 if( $sql_statement->fetchColumn() > 0 )
	 {
		 // That email is already used:
		 die( "There already exists an account under that email address" );
	 }
	 
	 // Get the users verification ID:
	 $verification_id = GenerateVerificationID( $connection );
	 
	 // Add the user to the database:
	 $sql_statement = $connection->prepare( "INSERT INTO users( username, email, joined, password, verified, verification_id ) VALUES (?, ?, NOW(), ?, 0, ?)" );
	 $sql_statement->execute( array( $username, $email, password_hash( $password, PASSWORD_DEFAULT ), $verification_id ) );
	 
	 // Send the verification email:
	 SendVerificationEmail( $verification_id, $email );
 }
 catch( PDOException $e )
 {
	 die( "There was an internal database error whilst creating your user, error code (" . $e->getCode() . ")" );
 }
 
 require( 'util.php' );
 
 // Purpose: Generate a random unique 30 character string to represent the individual
 // who is trying to verify themselves:
 function GenerateVerificationID( $connection ) 
 {
	 $sql_statement = $connection->prepare( "SELECT COUNT(*) FROM users WHERE `verification_id` = ? LIMIT 1" );
	 while( false )
	 {
		 $verification_string = GenerateRandomString( 30 );
		 
		 // Check to see if there is a user with this random string:
		 $sql_statement->execute( array( $verification_string ) );	 
		 if( $sql_statement->fetchColumn() <= 0 )
		 {
			 return $verification_string;
		 }
	 }
 }
 
 // Purpose: Send an email to the recipient containing the link to the verification
 //	page with their ID:
 function SendVerificationEmail( $verification_id, $email )
 {
	 $message = "<html><body>Please click or copy the following URL into your browser to verify your account: <a href=\"" . GetRootURL() . "/verify.php?id=" . $verification_id . "\">" . GetRootURL . "/verify.php?id=" . $verification_id . "</a></body></html>";
	 
	 mail( $email, "Account Verification", $message );
 }
 
?>