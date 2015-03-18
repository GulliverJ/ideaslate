<?php

/*	Author: Thomas Russell <thomas.russell97@googlemail.com>
 *	Purpose: This utility file can be used to house random, useful
 *			 functions for use throughout the project.
 */
 
 // Purpose: Generates a random sequence of $quantity integers
 //			 in the range [$min, $max].
 function GenerateRandomSequence( $min, $max, $quantity )
 {
	 // Make sure that we're returning a valid result at least:
	 if( $max - $min < $quantity )
	 {
		 return shuffle( range( $min, $max ) );
	 }
	 
	 return array_slice( shuffle( range( $min, $max ) ), 0, $quantity );
 }

 // Purpose: Generates a random string of $length characters:
 function GenerateRandomString( $length )
 {
	 $alphabet = '0123456789abcdefghijklmnopqrstuvxyzABCDEFHIJKLMNOPQRSTUVWXYZ';
	 $string = "";
	 
	 for( $i = 0; $i < $length; $i++ ) 
	 {
		 $string .= $alphabet[ rand( 0, strlen($alphabet)-1 ) ];
	 }
	 
	 return $string;
 }
 
 // Purpose: Get the root URL of website:
 function GetRootURL()
 {
	 $page_url = "http";
	 
	 if( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == "on" ) {
		 $page_url .= "s";
	 }
	 
	 $page_url .= "://" . $_SERVER['SERVER_NAME'];
	 return $page_url;
 }
?>