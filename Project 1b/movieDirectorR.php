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
    <center><h1>Movie Director Relationship Input</h1></center><br>
    <hr><br>

<?php 
  $db_connection = mysql_connect("localhost", "cs143", "");
  mysql_select_db("CS143", $db_connection);

  $movieID = $_POST['movie'];
  $directorID = $_POST['director'];

  if ($movieID && $directorID) {
    $query = 'INSERT INTO MovieDirector VALUES ("'.$movieID.'", "'.$directorID.'");';
    $result = mysql_query($query, $db_connection);
    echo $query;
    $err = mysql_error($db_connection);
    if ($err) 
      echo "Error inserting values";
    else
      echo "Successfully inserted values!";
  }

  $movieQuery = 'SELECT id, CONCAT(title, " (", year, ")") FROM Movie;';
  $directorQuery = 'SELECT id, CONCAT(first, " ", last, " (", dob, ")") FROM Director;';
  echo '<div class="container"><div class="row"><div class="col-md-2"></div><div class="col-md-8"><form method="POST" action="movieDirectorR.php">';
  echo '<label for="movie">Movie Title:</label><select class="form-control" name="movie">';
  $result = mysql_query($movieQuery, $db_connection);
  while ($row = mysql_fetch_row($result)) {
    echo '<option value="'.$row[0].'">'.$row[1].'</option>';
  }
  echo '</select>';
  echo '<label for="director">Director Name</label><select class="form-control" name="director">';
  $result = mysql_query($directorQuery, $db_connection);
  while ($row = mysql_fetch_row($result)) {
    echo '<option value="'.$row[0].'">'.$row[1].'</option>';
  }
  echo '</select>';
  echo '<br><button type="submit" class="btn btn-default">Add</button>';
  echo '</form>';
  echo '<script src="js/jquery.min.js"></script><script src="js/bootstrap.js"></script></body></html>';
?>