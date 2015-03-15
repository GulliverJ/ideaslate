<?php

/*	Author: Thomas Russell <thomas.russell97@googlemail.com>
 * 	Purpose: Checks to see if a user already exists using this email address
 */
 
 $server_details = include( 'server_details.php' );
 $server_name = $server_details['server_name'];
 $db_name = $server_details['db_name'];
 $db_username = $server_details['db_username'];
 $db_password = $server_details['db_password'];  
  
 $email = isset( $_GET['email'] ) ? $_GET['email'] : die( 'false' );
 
 try {
	 $connection = new PDO( "mysql:host=$server_name;dbname=$db_name", $db_username, $db_password );
	 $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	 
	 $sql_query = $connection->prepare( "SELECT COUNT(*) FROM users WHERE `email` = ? LIMIT 1" );
	 $sql_query->execute( array( $email ) );
	 
	 if( $sql_query->fetchColumn() > 0 )
	 {
		 die( 'false' );
	 }
	 else
	 {
		 die( 'true' );
	 }
 }
 catch( PDOException $e )
 {
	 die( 'false' );
 }

?>