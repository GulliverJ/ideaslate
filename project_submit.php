<?php

/*	Author: Thomas Russell <thomas.russell97@googlemail.com>
 *	Purpose: PHP form to submit a new project
 */
 
 $project_name = isset( $_POST['project-name'] ) ? $_POST['project-name'] : die( "You must enter a project name" );
 $project_abstract = isset( $_POST['abstract'] ) ? $_POST['abstract'] : die( "You must enter a project abstract" );
 $project_description = isset( $_POST['description'] ) ? $_POST['description'] : "";
 $project_platforms = isset( $_POST['platform'] ) ? $_POST['platform'] : array();
 $project_sectors = isset( $_POST['sector'] ) ? $_POST['sector'] : array();
 
 $server_details = include( 'server_details.php' );
 $server_name = $server_details['server_name'];
 $db_name = $server_details['db_name'];
 $db_username = $server_details['db_username'];
 $db_password = $server_details['db_password'];

 echo "Test";
 
 try {
	 $connection = new PDO( "mysql:host=$server_name;dbname=$db_name", $db_username, $db_password );
	 $connection->setAttributes( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	 
	 $sql_statement = $connection->prepare( "SELECT COUNT(*) FROM projects WHERE `title` = ? LIMIT 1" );
	 echo $sql_statement;
	 $sql_statement->execute( array( $project_name ) );
	 
	 if( $sql_statement->fetchColumn() > 0 )
	 {
		 die( "A project with that title already exists" );
	 }
	 
	 $sql_statement = $connection->prepare( "INSERT INTO projects (title, abstract, description, created) VALUES (?, ?, ?, NOW())" );
	 echo $sql_statement;
	 $sql_statement->execute( array( $project_name, $project_abstract, $project_description ) );
	 $project_id = $connection->lastInsertId();
	 
	 $sql_statement = $connection->prepare( "INSERT INTO project_platforms (project_id, platform_id) VALUES (?, ?)" );
	 echo $sql_statement;
	 foreach( $project_platforms as $platform )
	 {
		 // Insert each platform into the database:
		 $sql_statement->execute( array( $project_id, $platform ) );
	 }
	 
	 $sql_statement = $connection->prepare( "INSERT INTO project_sectors (project_id, sector_id) VALUES (?, ?)" );
	 echo $sql_statement;
	 foreach( $project_sectors as $sector )
	 {
		 // Insert each sector into the database:
		 $sql_statement->execute( array( $project_id, $sector ) );
	 }
 }
 catch( PDOException $e )
 {
	 // ToDo: Handle exceptions better!
	 die( "The project was unable to be submitted due to an internal database error" );
 }

?>