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
      <div class="profile panel-selector" id="profile-panel" data-param="profile-panel">       <!--TODO: Profile details loaded from server -->
        <div style="float: left; width: 276px">
          <img src="img/<?php echo GetProfileImage(); ?>" style="float: left; margin: 8px">
          <p class="signedin-as">Signed in as:</p>
          <p class="signedin-name"><?php echo GetUserName(); ?></p>
        </div>
        <div id="profile-arrow" style="float: right; width: 20px; height: 64px">
          <img id="arrow" src="img/tri-icon.png" style="margin-top: 28px">
        </div>
      </div>
   <?php } else { ?>
   	  <!-- TODO: Make this presentable, this is here purely for demonstrative purposes -->
   	  <form role="form" class="login-form" id="login-form" method="post" action="user_manager.php" novalidate>
      	<input name="username" class="form-username" type="text" placeholder="Username" title="Enter your username" required>
        <input name="password" class="form-password" type="password" placeholder="Password" title="Enter your password" required>
        <button type="submit" class="btn btn-default navform">Log In</button>
      </form>
   <?php } ?>
      <div class="panel-menu">
        <div class="panel-menu-item panel-selector" data-param="dashboard">
          <img src="img/home-icon.png">
        </div>
        <div class="panel-menu-item panel-selector" data-param="create-panel">
          <img src="img/create-icon.png">
        </div>
        <div class="panel-menu-item panel-selector" data-param="search-panel">
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

  <!--

  TODO: NEWLY ADDED CREATE PAGE

  --> 

  <div class="create-panel" style="display: none;">
      <form name="create" method="post" action="" id="create-form">

        <div class="create-header">
          <div style="border-bottom-color: #eee; border-bottom-style: solid; border-bottom-width: 1px;">
            <div style="width: 960px; margin-left: auto; margin-right: auto"> 
              <input class="create-text-input" name="project-name" id="proj-name" type="text" placeholder="Name your project">
            </div>
          </div>
          <div style="border-bottom-color: #eee; border-bottom-style: solid; border-bottom-width: 1px;">
            <div style="width: 960px; margin-left: auto; margin-right: auto"> 
              <textarea class="create-text-area" name="abstract" id="proj-abstract" type="text" maxlength="140" placeholder="Describe the project in 140 characters"></textarea>
            </div>
          </div>
        </div>

        <div style="border-bottom-color: #eee; border-bottom-style: solid; border-bottom-width: 1px; background-color: #f8f8f8">
          <div class="wrapper create-optional">

            <label class="create-label">Description</label>
            <textarea class="create-input" style="height: 300px" name="description" id="proj-desc" type="text" maxlength="1000" placeholder="Write a detailed description"></textarea>
            <br>

            <label class="create-label">Primary Requirements</label>
            <input class="create-input" style="height: 24px" name="requirement_item" id="requirement" placeholder="Add a requirement" type="text">
            <!-- TODO: Add a button to generate a duplicate input form, up to 6 primary requirements -->
            <br>

            <label class="create-label">Platform</label>
            <div style="width: 400px; float: left; margin-left: 50px; display:inline">
              <input type="checkbox" name="platform" value="0"> Web<br>
              <input type="checkbox" name="platform" value="1"> Windows<br>
              <input type="checkbox" name="platform" value="2"> Mac<br>
              <input type="checkbox" name="platform" value="3"> Linux<br>
              <input type="checkbox" name="platform" value="4"> Android
            </div>
            <div style="width: 400px; float: right; margin-right: 50px;">
              <input type="checkbox" name="platform" value="5"> Windows Phone<br>
              <input type="checkbox" name="platform" value="6"> iOS<br>
              <input type="checkbox" name="platform" value="7"> Pebble<br>
              <input type="checkbox" name="platform" value="8"> Arduino<br>
              <input type="checkbox" name="platform" value="9"> Raspberry Pi
            </div>
            <br>

            <label class="create-label">Sector</label>
            <div style="width: 400px; float: left; margin-left: 50px; display:inline">
              <input type="checkbox" name="platform" value="0"> Technology<br>
              <input type="checkbox" name="platform" value="1"> Education<br>
              <input type="checkbox" name="platform" value="2"> Social Media<br>
              <input type="checkbox" name="platform" value="3"> News<br>
              <input type="checkbox" name="platform" value="4"> Finance<br>
              <input type="checkbox" name="platform" value="5"> Legal
            </div>
            <div style="width: 400px; float: right; margin-right: 50px;">
              <input type="checkbox" name="platform" value="6"> Space<br>
              <input type="checkbox" name="platform" value="7"> Urban Infrastructure<br>
              <input type="checkbox" name="platform" value="8"> Transport<br>
              <input type="checkbox" name="platform" value="9"> Residential<br>
              <input type="checkbox" name="platform" value="10"> Tourism
            </div>
            <br>

            <label class="create-label">Team Positions</label>
            <div style="width: 500px; float: left">
              <select name="position" class="create-input" style="width: 350px">
                <option value="" selected disabled>Choose a role</option>
                <option value="2">Directors</option>
                <option value="3">Development Managers</option>
                <option value="4">General Developers</option>
                <option value="5">Front-end Developers</option>
                <option value="6">Back-end Developers</option>
                <option value="7">Software Engineers</option>
                <option value="8">System Engineers</option>
                <option value="9">Hardware Engineers</option>
                <option value="10">Testers</option>
              </select>
              <input class="create-input" placeholder="None" style="width: 75px" type="number" min="1" max="20">
            </div>
            <div style="width: 400px; float: right">
            <input class="create-input" style="width: 350px; float: left" type="text" placeholder="Nominate users to take this position">
            <br>
            <!-- TODO: As above, a button to add more user-nomination fields (unlimited number of people can be nominated for the associated role) -->
            <!-- TODO: This entire section should be duplicable (you can add up to one for each position and specify the number) -->

            <label class="create-label">Hidden</label>
            <input type="checkbox" name="hidden" value="1">
            <!-- TODO: Forgot about this on the first run; it'll be featured more prominently in the final design... -->

            <!-- TODO: Tags - not quite sure how to go about it, but putting it off for now isn't a huge deal -->

            </div>
          </div>
        </div>

        <div class="wrapper" style="display: block; margin-bottom: 32px">
          <label class="create-label">Nominate your Project Manager</label>
          <div style="display:inline; font-family: 'Helvetica Neue', Arial, Sans-serif; color: #333">
            <input type="radio" name="nominate-pm" style="margin-left: 24px;"> Me<br>
            <input type="radio" name="nominate-pm" style="margin-left: 24px"> Someone else
          </div>
          <div style="display:inline;">
            <input type="text" name="nominate-pm" placeholder="Search by name or username" class="create-input" style="width: 400px; margin-left: auto; margin-right: auto; float: right;">
          </div>
        </div>

        <!-- TODO: Add a "Save as draft" button, which is always active, whilst the "Create" button will be disabled until all of the required fields have been completed (Title, abstract, and indication of who will be project manager (themselves, a nominee, or whether it is to be left open). By having the "Save as draft" function,  users can quickly jot down ideas (with any fields they choose, required or not) and then save it to come back to it later. These drafts would be listed in their "My Projects" view on the home panel, indicated incomplete by an icon. -->
        <!-- TODO: The above requires extra database columns -->

        <div style="border-top-color: #eee; border-top-style: solid; border-top-width: 1px;">
          <div style="width: 250px; margin: auto; margin-top: 24px">
            <button type="submit" name="create" style="width: 250px; height: 48px;">Create</button>
          </div>
        </div>

      </form>
  </div>

  <!--

  CREATE PAGE END
  
  --> 

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