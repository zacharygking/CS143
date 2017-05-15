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
    <center><h1>Add New Movie</h1></center><br>
    <hr><br>
    <div class="container">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <form method="POST" action="movieInput.php">
              <label for="title">Title</label>
              <input required type="text" class="form-control" name="title" placeholder="Title">
              <label for="company">Company</label>
              <input required type="text" class="form-control" name="company" placeholder="Company">
              <label for="year">Year</label>
              <input required type="text" class="form-control" name="year" placeholder="2017">
              <label for="rating">MPAA Rating</label>
              <select class="form-control" name="rating">
                <option value="G">G</option>
                <option value="NC-17">NC-17</option>
                <option value="PG">PG</option>
                <option value="PG-13">PG-13</option>
                <option value="R">R</option>
              </select>
              Genre(s):<br>
              <input type="checkbox" name="genre[]" value="Action">Action</input>
              <input type="checkbox" name="genre[]" value="Adult">Adult</input>
              <input type="checkbox" name="genre[]" value="Adventure">Adventure</input>
              <input type="checkbox" name="genre[]" value="Animation">Animation</input>
              <input type="checkbox" name="genre[]" value="Comedy">Comedy</input>
              <input type="checkbox" name="genre[]" value="Crime">Crime</input>
              <input type="checkbox" name="genre[]" value="Documentary">Documentary</input>
              <input type="checkbox" name="genre[]" value="Drama">Drama</input>
              <input type="checkbox" name="genre[]" value="Family">Family</input>
              <input type="checkbox" name="genre[]" value="Fantasy">Fantasy</input>
              <input type="checkbox" name="genre[]" value="Horror">Horror</input>
              <input type="checkbox" name="genre[]" value="Musical">Musical</input>
              <input type="checkbox" name="genre[]" value="Mystery">Mystery</input>
              <input type="checkbox" name="genre[]" value="Romance">Romance</input>
              <input type="checkbox" name="genre[]" value="Sci-Fi">Sci-Fi</input>
              <input type="checkbox" name="genre[]" value="Short">Short</input>
              <input type="checkbox" name="genre[]" value="Thriller">Thriller</input>
              <input type="checkbox" name="genre[]" value="War">War</input>
              <input type="checkbox" name="genre[]" value="Western">Western</input>
              <br><button type="submit" class="btn btn-default">Add</button>
          </form>
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>

<?php
  $db_connection = mysql_connect("localhost", "cs143", "");
  mysql_select_db("CS143", $db_connection);
  if ($_POST['title']) {
    $title = $_POST['title'];
    $company = $_POST['company'];
    $year = $_POST['year'];
    $rating = $_POST['rating'];
    $genres = $_POST['genre'];

    $query = "Select * From MaxMovieID;";
    $result = mysql_query($query, $db_connection);
    $row = mysql_fetch_row($result);
    $newVal = $row[0] + 1;

    $query = 'INSERT INTO Movie VALUES ("'.$newVal.'", "'.$title.'", "'.$year.'", "'.$rating.'", "'.$company.'");'; 
    $result = mysql_query($query, $db_connection);
    $err = mysql_error($db_connection);

    foreach($genres as $genre) {
      $query = 'INSERT INTO MovieGenre VALUES ("'.$newVal.'", "'.$genre.'");';
      $result = mysql_query($query, $db_connection);
    }

    if ($err)
      echo "Error Inserting Value";
    else {
      echo "Successfully added values";
      $query = "UPDATE MaxMovieID SET id=id+1";
      $result = mysql_query($query, $db_connection);
    }
  }

  echo '<script src="js/jquery.min.js"></script><script src="js/bootstrap.js"></script></body></html>';
?>