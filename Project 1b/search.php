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
    <center><h1>Search</h1></center>
    <hr><br>
    <div class="container">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <form action="search.php" method="GET">
            <div class="form-group">
              <label for="search">Search The Database:</label>
              <input name="search" type="text" class="form-control" id="search" placeholder="Search">
            </div>
            <center><button type="submit" class="btn btn-default">Submit</button></center>
          </form>
          
        </div>
        <div class="col-md-2"></div>
    </form>

<?php 
  $db_connection = mysql_connect("localhost", "cs143", "");
  mysql_select_db("CS143", $db_connection);
  $param = $_GET['search'];
  if (!$param) {
    echo '<script src="js/jquery.min.js"></script><script src="js/bootstrap.js"></script></body></html>';
    exit;
  }
  
  $param = explode(' ', $param);
  $first = false;
  $query = "SELECT title, year, id
            FROM Movie
            WHERE";
  foreach($param as $item) {
    if (!$first) {
      $first = true;
      $query = $query . ' title LIKE "%' . $item . '%"';
    } else {
      $query = $query . ' AND title LIKE "%' . $item . '%"';
    }
  }
  echo '<div class="container"><br><div class="row"><div class="col-md-6">';
  $result = mysql_query($query, $db_connection);
  echo '<center><h3>Movie Results</h3></center>';
  echo '<table class="table table-compact table-b">';
  echo "<tr><thead>";
  $i = 0;
  while ($i < mysql_num_fields($result)) {
      $info = mysql_fetch_field($result, $i);
      if ($info->name == 'id')
        break;
      echo '<td><b>';
      echo ucwords($info->name);
      echo "</b></td>";
      $i = $i + 1;
  }
  echo "</thead></tr><tbody>";

  while($row = mysql_fetch_row($result)) {
    echo "<tr>";
    echo '<td><a href="movieInfo.php?mid=' . $row[2] . '"><small>' . $row[0] . '</a></small></td>';
    echo '<td><small>' . $row[1] . '</small></td>';
    echo "</tr>";
  }
  echo "</tbody>";
  echo '</table></div><div class="col-md-6">';
  echo '<center><h3>Actor/Actress Results</h3></center>';
  $query = "SELECT CONCAT(first, ' ', last) as Name, dob, id
            FROM Actor
            WHERE";
  $first = false;
  foreach($param as $item) {
    if (!$first) {
      $first = true;
      $query = $query . ' (first LIKE "%' . $item . '%" OR last LIKE "%' . $item . '%")';
    } else {
      $query = $query . ' AND (first LIKE "%' . $item . '%" OR last LIKE "%' . $item . '%")';
    }
  }
  $result = mysql_query($query, $db_connection);
  echo '<table class="table table-compact table-b">';
  echo "<tr><thead>";
  $i = 0;
  while ($i < mysql_num_fields($result)) {
      $info = mysql_fetch_field($result, $i);
      if ($info->name == 'id')
        break;
      echo '<td><b>';
      echo ucwords($info->name);
      echo "</b></td>";
      $i = $i + 1;
  }
  echo "</thead></tr><tbody>";

  while($row = mysql_fetch_row($result)) {
    echo "<tr>";
    echo '<td><a href="actorInfo.php?aid=' . $row[2] . '"><small>' . $row[0] . '</small></td>';
    echo "<td><small>" . $row[1] . "</small></a></td>";
    echo "</tr>";
  }
  echo "</tbody>";
  echo '</table></div>';
  echo '<script src="js/jquery.min.js"></script><script src="js/bootstrap.js"></script></body></html>';
?>