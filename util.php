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
		 $max = $min + $quantity;
	 }
	 
	 return array_slice( shuffle( range( $min, $max ) ), 0, $quantity );
 }

?>