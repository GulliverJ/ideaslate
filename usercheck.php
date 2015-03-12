<?php

/*	Author: Thomas Russell <thomas.russell97@googlemail.com>
 *	Purpose: Checks to see if the username exists or not
 */
 
 $server_name = "eu-cdbr-azure-north-c.cloudapp.net";
 $db_name = "isdevAnAqTBTyio8";
 $db_username = "b9b9fc737b7f9b";
 $db_password = "8bce3b67"; 
 
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