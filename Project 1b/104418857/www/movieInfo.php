<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Movie Information</title>

    <!-- Bootstrap core CSS -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">


  </head>

  <body>
    <nav class="navbar navbar-inverse navbar-toggleable-md navbar-custom">
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
    <center><h1>Movie Information Page</h1></center>
    <hr><br>
    <div class="container">
      <div class="row">
<!--
      <footer>
        <p>Zachary King</p>
      </footer>
    </div> <!-- /container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>-->
    <!--<script src="js/jquery-3.1.1.slim.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
  </body>
</html>-->

<?php
    $param = $_GET["mid"];
    if (!$param) {
        echo '<script src="js/jquery.min.js"></script><script src="js/bootstrap.js"></script></body></html>';
        echo 'Use the search page to find information on a Movie.';
        exit;
    } else 
      $id = $param;
        
    $db_connection = mysql_connect("localhost", "cs143", "");
    mysql_select_db("CS143", $db_connection);
    echo '<div class="container"><div class="row">';
    echo '<div class="col-md-4">';
    $query = "SELECT title, company as 'Production Company', rating as 'MPAA Rating'
              FROM Movie 
              Where Movie.id=" . $id . ";";
    $result = mysql_query($query, $db_connection);
    $row = mysql_fetch_row($result);

    echo '<table class="table table compact table-bless">';
    echo '<tr><td><b>Title</b></td><td>' . $row[0] . '</td></td>';
    echo '<tr><td><b>Production Company</b></td><td>' . $row[1] . '</td></td>';
    echo '<tr><td><b>MPAA Rating</b></td><td>' . $row[2] . '</td></td>';

    $query = "SELECT CONCAT(first, ' ', last, ' (', dob, ')') as Director
              FROM MovieDirector, Director
              WHERE MovieDirector.mid=" . $id . "
                AND MovieDirector.did=Director.id;";

    $result = mysql_query($query, $db_connection);
    $row = mysql_fetch_row($result);

    echo '<tr><td><b>Director</b></td><td>' . $row[0] . '</td></td>';

    $query = "SELECT genre
              FROM MovieGenre
              WHERE mid=" . $id . ";";

    $result = mysql_query($query, $db_connection);
    //$row = mysql_fetch_row($result);
            
    echo '<tr><td><b>Genre</b></td><td>';
    while($row = mysql_fetch_row($result))
     echo $row[0], ' ';
    echo '</td></td>';
  
    echo "</table></div>";
    echo '<div class="col-md-1"></div><div class="col-md-7">';
    echo '<h4>&nbsp&nbspActors In This Movie:</h4>';
    $query = "SELECT CONCAT(first, ' ', last) as Name, role, Actor.id
              FROM Actor, MovieActor 
              WHERE MovieActor.mid=" . $id . " 
                AND Actor.id=MovieActor.aid;";

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
      echo '<td><a href="actorInfo.php?aid=' . $row[2] . '"><small>' . $row[0] . '</small></a></td>';
      echo "<td><small>" . $row[1] . "</small></td>";
      echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";

    //row
    echo "</div>";

    echo '<hr><div class="row">';
    echo '<div class="col-md-12"><h2>User Reviews</h2></div></div>';
    echo '<div class="row"><div class="col-md-12">';
    $query = "SELECT avg(rating), count(*)
              FROM Review
              WHERE mid=" . $id . "
              GROUP BY mid";
    //container
    $result = mysql_query($query, $db_connection);
    $row = mysql_fetch_row($result);

    echo '<a href="review.php?mid='.$id.'">Review this Movie!</a><br>';
    if (!$row[0]) {
      echo "No User Reviews Yet";
    } else {
      echo 'The average User Rating for this title was ', $row[0], ' out of 5 based on ', $row[1], ' user reviews.';
      echo '</div></div><br>';
      $query = "SELECT name, time, rating, comment 
                FROM Review
                WHERE mid=" . $id . ";";

      $result = mysql_query($query, $db_connection);
      while($row = mysql_fetch_row($result)) {
        echo '<div class="row"><div class="col-md-1"></div><div class="col-md-11">';
        echo 'The user <b> ', $row[0], '</b> rated this movie with a score of ', $row[2], ' out 5 at ', $row[1]. '<br>';
        echo '</div></div>';
        echo '<div class="row"><div class="col-md-2"></div><div class="col-md-10">';
        echo 'Comments: ', $row[3];
        echo '</div></div>';
      }
    }

    echo '<script src="js/jquery.min.js"></script><script src="js/bootstrap.js"></script></body></html>';
?>