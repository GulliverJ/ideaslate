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
    
    <!-- Verify Javascript Script -->
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    
    <!-- Signup Form JavaScript -->
    <script type="text/javascript">
	// Verify our signup form and AJAXify:
	$(document).ready( function() {
		// Set up our verification properties:
		$('#signup-form').validate({
			rules: {
				username: {
					required: true
				},
				pass: {
					required: true,
					minlength: 6, // We require at least a 6-letter password
				},
				passconf: {
					required: true,
					minlength: 6,
					equalTo: "#pass"
				},
				emailadd: {
					required: true,
					email: true
				}
			}
		});
		
		// Don't just blindly submit the form:
		$('#signup-form').submit( function(event) {
			
			if( $('#signup-form').valid() )
			{
				// If we're valid then try to send the data via AJAX:
				$.ajax({
					url: 'signup.php',
					type: 'POST',
					data: $('#signup-form').serialize(),
					success: function( data ) {
						$('#signup-form').fadeOut( 1000, function() {
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
	});
	</script>
  </head>

  <body>

  <div style="background-image: url(img/summer_meadow2.jpg); background-size: 1920px; background-repeat: repeat-x; background-attachment: fixed;">
    <nav class="navbar navbar-default navbar-static-top lightnav" style="background-image: url(img/50b.png); background-repeat: repeat;">
      <div class="container">

        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" style="color: #eee" href="#">IdeaSlate</a>
        </div>

        <div id="navbar" class="collapse navbar-collapse" style="float: right; margin-bottom: 8px;">
          <form class="form-inline" role="form" style="padding-top: 8px;">
            <div class="form-group">
              <input name="username" class="form-control navform" type="text" placeholder="Username" title="Enter your username" required>
            </div>

            <div class="form-group">
              <input name="password" id="pwd" class="form-control navform" type="password" placeholder="Password" title="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-default navform">Log in</button>
          </form>
        </div>

      </div>
    </nav>

    <div class="container-fluid welcome">
      <div class="welcome-main">
        <h1>Main page template</h1>
        <div class="input-group input-group-lg mainsearch" >
          <input type="text" class="form-control" placeholder="Search for projects">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button">Search</button>
          </span>
        </div>
        <p class="lead">Some descriptive text, a blurb about the website designed to pique interest and attract further reading below (or a sign-up!)</p>
        <div class="row" style="padding-bottom: 20px">
          <div class="col-sm-1"></div>
          <div class="col-sm-5" style="padding-top: 10px">
            <button onclick="return false;" onmousedown="autoScrollTo('about');"class="btn btn-lg welcome-btn" type="button">Find out more</button>
          </div>
          <div class="col-sm-5" style="padding-top: 10px">
            <button class="btn btn-lg welcome-btn" id="signup" type="button">Sign up</button>
          </div>
          <div class="col-sm-1"></div>
        </div>
      </div>
    </div>

  </div>

    <div class="signup" style="display: none;">
      <div class="container">
        <form name="signup" method="post" action="signup.php" id="signup-form">
        <div class="row">
          <h2 style="text-align: center">Sign Up</h2>
            <div class="col-sm-6 signup-form">
                <h3>Basic Details</h3>

                <div class="form-group"> <!-- Will need to check for duplicates -->
                  <label for="username">Username:</label>
                  <input name="username" id="username" class="form-control" type="text" placeholder="Choose a username" title="Enter your username" required>
                </div>

                <div class="form-group">
                  <label for="pass">Password:</label>
                  <input name="password" id="pass" class="form-control" type="password" placeholder="Choose a password" title="Enter your password" required>
                </div>

                <div class="form-group"> <!-- Needs JS to verify -->
                  <label for="passconf">Confirm Password:</label>
                  <input name="password" id="passconf" class="form-control" type="password" placeholder="Repeat your password" title="Repeat your password" required>
                </div>

                <div class="form-group"> <!-- Verification emails -->
                  <label for="emailadd">Email Address:</label>
                  <input name="email" id="emailadd" class="form-control" type="email" placeholder="Enter your email address" title="Enter your email address" required>
                </div>

            </div>
            <div class="col-sm-6 signup-form">
              <h3>Optional Details</h3>
              <ul>
                <li>A short bio</li>
                <li>A profile picture</li>
                <li>Specialisations/skills (user-defined tags)</li>
                <li>Upload their CV</li>
                <li>Add links (e.g. social media, linkedin, website)</li>
              </ul>
            </div>
        </div>
        <div class="btn-signup-div">
          <button type="submit" name="submit" class="btn btn-lg btn-signup">Submit</button> <!-- Later, add intelligence to have text "Skip and submit" if the user has not filled out all of the additional information -->
        </div>
        </form>
      </div>
    </div>


    <div class="container previews" style="background-color: #fff">
      <div class="row">
        <div class="col-sm-6 newest">
          <h2>New Ideas</h2>
          <p>The most recently posted project would be featured here! Auto-updating.</p>
        </div>
        <div class="col-sm-6 popular">
          <h2>Popular Ideas</h2>
          <p>The most popular project would be featured here! Cycling through top 10?</p>
        </div>
      </div>
    </div>

    <div id = "about" class="container-fluid about">
      <h2>Text about what IdeaSlate is</h2>
    </div>

    <div class="container-fluid about">
      <h2>Text about how to use IdeaSlate</h2>
    </div>

    <div class="container-fluid about">
      <h2>Some more text. These three sections are basically the "about"</h2>
    </div>

    <div class="container-fluid footer">
      <a href="testphp.php" style="font-size: 18pt;">Check this awesome link out!</a>
    </div>



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/landing.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug
    <script src="./Starter Template for Bootstrap_files/ie10-viewport-bug-workaround.js"></script> -->

</body></html>