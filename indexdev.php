<?php

/*  Authors: Thomas Russell <thomas.russell97@googlemail.com>; Gulliver Johnson <gulliver.johnson@gmail.com>
 *  Purpose: Main page and template handling engine for the IdeaSlate website
 */


 require( 'user_manager.php' );
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>IdeaSlate</title>

    <!-- Bootstrap -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
   
  </head>

  <body>

    <?php 
    if( LoggedIn() )
    {
    ?>
        <h2>Logged In!!! <a id="log-out" href="#">Log Out</a></h2>
        <?php
    }
    else
    {
    ?>
    <form id="login-form" method="post" action="user_manager.php">
      <input name="username" type="text" placeholder="Username" title="Enter your username" required><br>
      <input name="password" id="pwd" type="password" placeholder="Password" required><br>
      <button type="submit">Log In</button>
    </form>
    <br>
    <br>
    <form name="signup" method="post" action="signup.php" id="signup-form" novalidate>
      <input name="username" id="username" type="text" placeholder="Choose a username" title="Enter your username"><br>
      <input name="pass" id="pass" type="password" placeholder="Choose a password"><br>
      <input name="passconf" id="passconf" type="password" placeholder="Repeat password"><br>
      <input name="email" id="email" class="form-control" type="email" placeholder="Enter your email address"><br>
      <button type="submit" name="submit">Sign up</button>
    </form>

    <?php 
    }
    ?>

  <!-- Verify Javascript Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/landing.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug
    <script src="./Starter Template for Bootstrap_files/ie10-viewport-bug-workaround.js"></script> -->

  <!-- Signup Form JavaScript -->
    <script type="text/javascript">
  // Verify our signup form and AJAXify:
  $(document).ready( function() {
    // Set up our verification properties:
    $('#signup-form').validate({
      rules: {
        username: {
          required: true,
          remote: "usercheck.php"
        },
        pass: {
          required: true,
          minlength: 6, // We require at least a 6-letter password
        },
        passconf: {
          equalTo: "#pass"
        },
        email: {
          required: true,
          email: true,
          remote: "emailcheck.php"
        }
      },
      messages: {
        username: {
          required: "Please enter a username",
          remote: "This username has already been taken"
        },
        pass: {
          required: "Please enter a password",
          minlength: "Your password must be at least 6 letters long"
        },
        passconf: "Your passwords must match",
        email: {
          required: "Please enter an email address",
          email: "You must enter a valid email address format",
          remote: "There already exists a user with this email address"
        }
      }
    });
    
    // Don't just blindly submit the form:
    $('#signup-form').submit( function(event) {
      event.preventDefault();
      event.stopImmediatePropagation();
      
      if( $('#signup-form').valid() )
      {
        // If we're valid then try to send the data via AJAX:
        $.ajax({
          url: 'signup.php',
          type: 'POST',
          data: $('#signup-form').serialize(),
          success: function( data ) {
            $('#signup-form').fadeOut( 500, function() {
              $('#signup-form').hide();
              
              if( !data )
              {
                $('#signup-form').after( '<p class="submission-text" style="display:none">Congratulations, you have successfully signed up; you can now log-on when you wish</p>' );
              }
              else
              {
                var html = '<p class="submission-text" style="display:none">';
                var full = html.concat( data, '</p>' );
                $('#signup-form').after( full );
              }
              
              $('.submission-text').fadeIn( 500 );
            });
          },
          error: function( data ) {
            // ToDo: Make this more useful:
            $('#signup-form').fadeOut( 1000, function() {
              $('#signup-form').hide();
              $('#signup-form').after( '<p class="submission-text" style="display:none">Due to an internal server error, we are unable to process your request at the moment</p>' );
              $('.submission-text').fadeIn( 500 );
            });
          }
        });
      }
      
      return false;
    });
    
    $('#login-form').submit( function(event) {
      event.preventDefault();
      event.stopImmediatePropagation();
      
      $.ajax({
        url: 'user_manager.php',
        type: 'POST',
        data: $('#login-form').serialize(),
        success: function( data ) {
          if( data == 'false' )
          {
            alert( 'Invalid Login Details (note, this is a placeholder, will be fancy animation or w/e)' );
          }
          else
          {
            // We logged in successfully, refresh the page:
            location.reload();
          }
        },
        error: function( data ) {
          alert( 'Server Error (sigh)' );
        }
      });
    });
    
    $('#log-out').click( function(event) {
      $.ajax({
        url: 'user_manager.php',
        type: 'POST',
        data: { logout : true },
        success: function( data ) {
          location.reload();
        },
        error: function( data ) {
          alert( 'Server Error (sigh)' );
        }
      });
    });
    
  });
  </script>

</body></html>