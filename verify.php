<?php

/*	Author: Thomas Russell <thomas.russell97@googlemail.com>
 *	Purpose: Verify the email address associated with a user to allow them
 *			 to maintain and use the account.
 */
 
 $verification_id = isset( $_GET['id'] ) ? $_GET['id'] : "";
 
 if( strlen( $verification_id ) != 30 )
 {
	 // The verification ID is invalid, so just redirect to the homepage:
	 header( 'Location: index.php' );
	 die( 'Invalid verification ID' );
 }
 
 
 $server_details = include( 'server_details.php' );
 $server_name = $server_details['server_name'];
 $db_name = $server_details['db_name'];
 $db_username = $server_details['db_username'];
 $db_password = $server_details['db_password'];
 
 try 
 {
	 // Find the user associated with the verification id?
	 $connection = new PDO( "mysql:host=$server_name;dbname=$db_name", $db_username, $db_password );
	 $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	 
	 $sql_statement = $connection->prepare( "SELECT id FROM users WHERE `verification_id` = ?" );
	 $sql_statement->execute( array( $verification_id ) );
	 
	 $row = $sql_statement->fetch();
	 if( !$row )
	 {
		 throw Exception( "There doesn't exist a user with this verification ID" );
	 }
	 
	 $sql_statement = $connection->prepare( "UPDATE users SET `verified` = 1, `verification_id` = NULL WHERE `id` = ?" );
	 $sql_statement->execute( array( (int)$row['id'] ) );
 }
 catch( Exception $e )
 {
	 // ToDo: Maybe handle an error slightly better?
	 header( 'Location: index.php' );
	 die( 'Internal Server Error' );
 }
 
 header( 'Location: index.php' );

?>