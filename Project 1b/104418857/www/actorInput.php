<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Jumbotron Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

  </head>

  <body>
    <nav class="navbar-custom navbar navbar-inverse bg-inverse navbar-toggleable-md">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleCenteredNav" aria-controls="navbarsExampleCenteredNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExampleCenteredNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-text nav-link" href="index.php">CS143 Database Query System</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-text nav-link dropdown-toggle" href="http://example.com" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Add New Content</a>
            <div class="dropdown-menu" aria-labelledby="dropdown03">
              <a class="dropdown-item" href="actorInput.php">Actor/Director</a>
              <a class="dropdown-item" href="movieInput.php">Movie Information</a>
              <a class="dropdown-item" href="movieActorR.php">Movie/Actor Relation</a>
              <a class="dropdown-item" href="movieDirectorR.php">Movie/Director Relation</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-text nav-link dropdown-toggle" href="http://example.com" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Browse Content</a>
            <div class="dropdown-menu" aria-labelledby="dropdown03">
              <a class="dropdown-item" href="actorInfo.php">Actor Information</a>
              <a class="dropdown-item" href="movieInfo.php">Movie Information</a>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-text nav-link" href="search.php">Search</a>
          </li>
        </ul>
      </div>
    </nav>

    <br>
    <center><h1>Add New Actor or Director</h1></center><br>
    <hr><br>
    <div class="container">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <form method="POST" action="actorInput.php">
              <label class="radio-inline">
                <input checked type="radio" name="adSelect" id="actor" value="actor">
                Actor
              </label>
              &nbsp&nbsp
              <label class="radio-inline">
                <input type="radio" name="adSelect" id="director" value="director">
                Director
              </label><br>
              <label for="firstName">First Name</label>
              <input required type="text" class="form-control" name="firstName" placeholder="First">
              <label for="firstName">Last Name</label>
              <input required type="text" class="form-control" name="lastName" placeholder="Last">
              <br><label class="radio-inline">
                <input checked type="radio" name="gSelect" id="male" value="male">
                Male
              </label>
              &nbsp&nbsp
              <label class="radio-inline">
                <input type="radio" name="gSelect" id="female" value="female">
                Female
              </label><br>
              <label for="dob">Date of Birth (Year-Month-Day)</label>
              <input required type="text" class="form-control" name="dob" placeholder="1997-05-05">
              <label for="dod">Date of Death (leave blank if still alive)</label>
              <input type="text" class="form-control" name="dod" placeholder="1997-05-05">
              <br><button type="submit" class="btn btn-default">Add</button>
          </form>
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>

<?php
  $db_connection = mysql_connect("localhost", "cs143", "");
  mysql_select_db("CS143", $db_connection);

  $ad = $_POST['adSelect'];
  $first = $_POST['firstName'];
  $last = $_POST['lastName'];
  $mf = $_POST['gSelect'];
  $dob = $_POST['dob'];
  $dod = $_POST['dod'];

  $query = "Select * From MaxPersonID;";
  $result = mysql_query($query, $db_connection);
  $row = mysql_fetch_row($result);
  $newVal = $row[0] + 1;
  $sex = $mf == 'male' ? 'Male' : 'Female';

  if ($ad == 'actor') {
    if ($dod)
      $query = 'INSERT INTO Actor VALUES ("'.$newVal.'", "'.$last.'", "'.$first.'", "'.$sex.'", STR_TO_DATE("'.$dob.'", "%Y-%m-%d"), STR_TO_DATE("'.$dod.'", "%Y-%m-%d"));'; 
    else
      $query = 'INSERT INTO Actor VALUES ("'.$newVal.'", "'.$last.'", "'.$first.'", "'.$sex.'", STR_TO_DATE("'.$dob.'", "%Y-%m-%d"), NULL);';
    $result = mysql_query($query, $db_connection);
  } else if ($ad == 'director') {
    if ($dod)
      $query = 'INSERT INTO Director VALUES ("'.$newVal.'", "'.$last.'", "'.$first.'", STR_TO_DATE("'.$dob.'", "%Y-%m-%d"), STR_TO_DATE("'.$dod.'", "%Y-%m-%d"));';
    else
      $query = 'INSERT INTO Director VALUES ("'.$newVal.'", "'.$last.'", "'.$first.'", STR_TO_DATE("'.$dob.'", "%Y-%m-%d"), NULL);';
    $result = mysql_query($query, $db_connection);
  }
  if (mysql_error($db_connection))
    echo "Error Inserting Value";
  else if ($_POST['adSelect']) {
    echo "Successfully added values";
    $query = "UPDATE MaxPersonID SET id=id+1;";
    $result = mysql_query($query, $db_connection);
  }
  

  echo '<script src="js/jquery.min.js"></script><script src="js/bootstrap.js"></script></body></html>';
?>