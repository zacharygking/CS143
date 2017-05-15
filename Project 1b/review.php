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
    <center><h1>Add New Movie Comment</h1></center><br>
    <hr><br>
    <div class="container">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form method="POST" action="review.php">
            <?php 
                if ($_POST['mid'])
                    $mid = $_POST['mid'];
                if ($_GET['mid'])
                    $mid = $_GET['mid'];
                if ($mid) {
                    $db_connection = mysql_connect("localhost", "cs143", "");
                    mysql_select_db("CS143", $db_connection);
                    $query = 'SELECT title FROM Movie WHERE id='.$mid.';';
                    $result = mysql_query($query, $db_connection);
                    $row = mysql_fetch_row($result);
                    echo "<b>Movie Title: ".$row[0]."</b><br><br>";
                    echo '<input type="hidden" class="hidden" value="'.$mid.'" name="mid"';
                }
            ?>
          
              <label for="name">Your Name</label>
              <input required type="text" class="form-control" name="name" placeholder="Name">
              <label for="rating">Rating</label>
              <select class="form-control" name="rating">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
               </select>
                <label for="comment">Comments</label>
              <textarea cols=60 rows=10 class="form-control" name="comment" placeholder="Comments"></textarea>
                <br><button type="submit" class="btn btn-default">Add</button>
             
          </form>
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>

<?php
  $db_connection = mysql_connect("localhost", "cs143", "");
  mysql_select_db("CS143", $db_connection);

  if ($_POST['rating']) {
    $name = $_POST['name'];
    $mid = $_POST['mid'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $query = 'INSERT INTO Review VALUES ("'.$name.'", NOW(), "'.$mid.'", "'.$rating.'", "'.$comment.'");'; 
    $result = mysql_query($query, $db_connection);
    $err = mysql_error($db_connection);

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