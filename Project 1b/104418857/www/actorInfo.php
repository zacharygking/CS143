<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Jumbotron Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
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
    <center><h1>Actor Information Page</h1></center>
    <hr><br>
<?php 
  $param = $_GET["aid"];
  if (!$param) {
    echo '<script src="js/jquery.min.js"></script><script src="js/bootstrap.js"></script></body></html>';
    echo 'Use the search function to find information on an Actor';
    exit;
  }
  else 
    $id = $param;

  $db_connection = mysql_connect("localhost", "cs143", "");
  mysql_select_db("CS143", $db_connection);
  echo '<div class="container"><div class="row">';
  echo '<div class="col-md-4">';
  $query = "SELECT CONCAT(first, ' ', last) as Name, sex, dob, dod
            FROM Actor
            WHERE Actor.id=" . $id . ";";

  $result = mysql_query($query, $db_connection);
  echo '<table class="table table-bless">';
  $row = mysql_fetch_row($result);
  $i = 0;
  while ($i < mysql_num_fields($result)) {        
    $info = mysql_fetch_field($result, $i);
    echo "<tr><td><b>";
    echo ucwords($info->name);
    echo "</b></td>";
    echo "<td>";
    if ($row[$i])
      echo $row[$i];
    else
      echo "Still Alive";
    echo "</td></tr>";
    $i = $i + 1;
  }
  echo "</table></div>";   
  echo '<div class="col-md-1"></div><div class="col-md-7"><h4>&nbspMovies and Roles:</h4>';     
  $query = "SELECT role, title, Movie.id
            FROM MovieActor, Movie 
            WHERE MovieActor.aid=" . $id . " AND MovieActor.mid=Movie.id;";

  $result = mysql_query($query, $db_connection);
  echo '<table class="table table-compact table-b">';
  echo "<tr>";
  $i = 0;
  while ($i < mysql_num_fields($result)) {
      $info = mysql_fetch_field($result, $i);
      if ($info->name == 'id')
        break;
      echo "<td><b>";
      echo ucwords($info->name);
      echo "</b></td>";
      $i = $i + 1;
    }
    echo "</tr>";

  while($row = mysql_fetch_row($result)) {
    echo "<tr>";
    echo '<td><small>' . $row[0] . '</small></td>';
    echo '<td><a href="movieInfo.php?mid=' . $row[2] . '"><small>' . $row[1] . '</small></td>';
    echo "</tr>";
  }


  echo '<script src="js/jquery.min.js"></script><script src="js/bootstrap.js"></script></body></html>';
?>