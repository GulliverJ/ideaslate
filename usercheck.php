<?php

/*	Author: Thomas Russell <thomas.russell97@googlemail.com>
 *	Purpose: Checks to see if the username exists or not
 */
 
 $server_details = include( 'server_details.php' );
 $server_name = $server_details['server_name'];
 $db_name = $server_details['db_name'];
 $db_username = $server_details['db_username'];
 $db_password = $server_details['db_password'];  
 
 $username = isset( $_GET['username'] ) ? $_GET['username'] : die( 'false' );
 
 try {
	 $connection = new PDO( "mysql:host=$server_name;dbname=$db_name", $db_username, $db_password );
	 $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	 
	 $sql_query = $connection->prepare( "SELECT COUNT(*) FROM users WHERE `username` = ? LIMIT 1" );
	 $sql_query->execute( array( $username ) );
	 
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