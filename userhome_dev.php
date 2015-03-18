<?php

/*	Author: Thomas Russell <thomas.russell97@googlemail.com>; Gulliver Johnson <gulliver.johnson@gmail.com>
 *	Purpose: Main page and template handling engine for the IdeaSlate website
 */

 include( 'user_manager.php' );

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>IdeaSlate</title>

    <!-- Bootstrap -->
    <link href="css/userstyles_dev.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

<body>

    <!-- If not logged in... 

    <div>
      <form class="form-inline" role="form" id="login-form" method="post" action="user_manager.php" style="padding-top: 8px;">
        <div class="form-group">
          <input name="username" class="form-control navform" type="text" placeholder="Username" title="Enter your username" required>
        </div>

        <div class="form-group">
          <input name="password" id="pwd" class="form-control navform" type="password" placeholder="Password" title="Enter your password" required>
        </div>
        <button type="submit" class="btn btn-default navform">Log in</button>
      </form>
    </div>

    Else... -->

  <div class="header-base">
    <div class="wrapper topbar">
      <div class="logo">
        <a href="#">
          <img alt="IdeaSlate" src="img/logo.png">
        </a>
      </div>
      <div class="quicksearch" >
        <input type="text" class="quicksearch-in" placeholder="Quick Search">
      </div>
    </div>
    
    <div class="wrapper toolbar">
    <?php if( LoggedIn() ) { ?>
      <div class="profile" id="profile-panel" onclick="switchTo('profile-panel')">           <!--TODO: Profile details loaded from server -->
        <div style="float: left; width: 276px">
          <img src="img/<?php GetProfileImage(); ?>" style="float: left; margin: 8px">
          <p class="signedin-as">Signed in as:</p>
          <p class="signedin-name"><?php GetUserName(); ?></p>
        </div>
        <div id="profile-arrow" style="float: right; width: 20px; height: 64px">
          <img id="arrow" src="img/tri-icon.png" style="margin-top: 28px">
        </div>
      </div>
   <?php } else { ?>
   	  <!--- TODO: Make this presentable, this is here purely for demonstrative purposes --->
   	  <form class="login-form" id="login-form" action="user_manager.php" novalidate>
      	<input name="username" class="form-username" type="text" placeholder="Username" title="Enter your username" required>
        <input name="password" class="form-password" type="password" placeholder="Password" title="Enter your password" required>
        <button type="submit" class="btn btn-default navform">Log In</button>
      </form>
   <?php } ?>
      <div class="panel-menu">
        <div class="panel-menu-item" onclick="switchTo('dashboard')">
          <img src="img/home-icon.png">
        </div>
        <div class="panel-menu-item" onclick="switchTo('create-panel')">
          <img src="img/create-icon.png">
        </div>
        <div class="panel-menu-item" onclick="switchTo('search-panel')">
          <img src="img/search-icon.png">
        </div>
      </div>
    </div>
  </div>

  <div class="user-home">


  <div class="profile-panel" style="display: none;">
    <div class="wrapper">
      <div class="profile-panel-sidebar">
        <p style="color: #fff">Thomas Russell (and other profile stuff here) </p>
        <button type="button" id="log-out">Log out</button>
      </div>
      <div class="profile-panel-content">
      </div>
    </div>
  </div>

  <div class="search-panel" style="display: none;">
    <div class="wrapper">
      <p>Search panel</p>
    </div>
  </div>

  <div class="create-panel" style="display: none;">
    <div class="wrapper">
      <p>Create panel</p>

      <form name="create" method="post" action="" id="create-form">
        <!-- Required -->
        <input name="project-name" id="proj-name" type="text" placeholder="Name your project">
        <input name="abstract" id="proj-abstract" type="text" maxlength="140" placeholder="Describe the project in 140 characters">
        <!-- Optional -->
        <input name="desc" id="proj-desc" type="text" placeholder="Write a detailed description">
        <button type="submit" name="create">Create!</button>
      </form>

      <p>Sorry bro - should have done this as one of the first things... it'll be my focus when I'm next online. Things I think the form should have:</p>
      <br>
      <ul>
        <li>REQUIRED: Project Name</li>
        <li>REQURIED: 140-char abstract</li>
        <li>Detailed description</li>
        <li>Outline of requirements (list)</li>
        <li>An option to upload a logo or icon</li>
        <li>The platform(s) it'll run on</li>
        <li>The sector(s) it relates to</li>
        <li>Any tags they want to add (e.g. languages like C, Java, or descriptors like "responsive" or "machine learning")</li>
        <li>The option to nominate a project manager by name/username (with a button to choose "me") - the nominated projman will need to accept the position before it's confirmed</li>
        <li>The option to assign roles to named users (who will be notified of the nomination and need to accept before they're added)</li>
        <li>The option to add open positions, so that it will be suggested to all users fitting the description</li>
      </ul>
      <br>
      <p>I'm not sure, but I think it might be a good idea to have the last two options only available to the project manager; the person who has the idea might not necessarily know or be the best person to judge what kind of developers would be needed, nor how many. If the creator nominates themselves as the projman, the options to assign roles would become available; otherwise it would be up to the project manager when they accept the role, presumably through controls available on the project's page.</p>
      <br>
      
    </div>
  </div>

  <div class="dashboard">
    <div class="wrapper">
      <div class="menu">

        <div id="dashboard-btn" class="menuitem">
          <img src="img/dash-icon.png" style="float: left;">
          Dashboard
        </div>
        <div id="my-projects-btn" class="menuitem">
          <img src="img/my-projects-icon.png" style="float: left;">
          My Projects
        </div>
        <div id="following-btn" class="menuitem">
          <img src="img/following-icon.png" style="float: left;">
          Following
        </div>
        <hr size="1" style="margin-top: 12px">
        <div id="popular-btn" class="menuitem">
          <img src="img/popular-icon.png" style="float: left;">
          Popular
        </div>
        <div id="new-btn" class="menuitem">
          <img src="img/new-icon.png" style="float: left;">
          New
        </div>
        <div id="join-btn" class="menuitem">
          <img src="img/join-icon.png" style="float: left;">
          Join a team
        </div>
        <div id="manage-btn" class="menuitem">
          <img src="img/manage-icon.png" style="float: left;">
          Manage a team
        </div>
      </div>

      <div class="feed">

        <div class="tile">
          <p class="tile-hdr"><span class="tile-imp">This Tile </span>is an example tile!</p>
          <p class="tile-body">Here is a load of text about this tile.</p>
        </div>

        <div class="tile">
          <p class="tile-hdr"><span class="tile-imp">And here's another </span>example of a tile!</p>
          <p class="tile-body">Next up I need to get the database design made up so that we can start creating and searching for projects. I'm sorry, I should have done this far quicker... at least you'll still be able to get things done; integrating the log in/log out script, and the email activation (unless that's already done)... And I suppose making a start on tiles, perhaps, though there isn't any content yet for them to load (nor a table in the DB). Lots to do when I get back.</p>
        </div>

      </div>
    </div>
  </div>

  </div>

 	<!-- Verify Javascript Script -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script type="text/javascript" src="js/jquery.validate.min.js"></script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  <script src="js/bootstrap.min.js"></script>
  <script src="js/landing.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug
    <script src="./Starter Template for Bootstrap_files/ie10-viewport-bug-workaround.js"></script> -->

</body></html>