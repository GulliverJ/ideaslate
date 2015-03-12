<?php

/*	Author: Thomas Russell <thomas.russell97@googlemail.com>
 * 	Purpose: Checks to see if a user already exists using this email address
 */
 
 $server_name = "eu-cdbr-azure-north-c.cloudapp.net";
 $db_name = "isdevAnAqTBTyio8";
 $db_username = "b9b9fc737b7f9b";
 $db_password = "8bce3b67"; 
 
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