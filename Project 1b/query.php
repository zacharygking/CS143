<!DOCTYPE HTML>
<html>
    <head>
        <title>CS143 Web Query</title>

        <link href="css/bootstrap.css" rel="stylesheet">
        
    </head>
    <body>
        <center>
            <h1> CS143 Web Query </h1>
            <h4> Type a SQL query in the following box:</h4>
            <h5> EX: SELECT * FROM Actor WHERE id=10;</h5>
            <br>
            <form method="POST" action="query.php">
                <textarea name="query" cols="60" rows="10"></textarea><br>
                <input type="submit" value="Submit"></input><br>
            </form>
            <br>

<?php
    // Connect to DB and Query
    $db_connection = mysql_connect("localhost", "cs143", "");
    mysql_select_db("TEST", $db_connection);
    $query = $_POST["query"];
    $result = mysql_query($query, $db_connection);
    if (strlen($query) == 0) {
        exit;
    }

    // Create the Table for the Results and Fill First Row w/ Col Names
    echo "<table border=1>";
    echo "<tr>";
    $i = 0;
    while ($i < mysql_num_fields($result)) {
        $info = mysql_fetch_field($result, $i);
        echo "<td><b>";
        echo $info->name;
        echo "</b></td>";
        $i = $i + 1;
    }
    echo "</tr>";

    // Add Rows to the Table While More Exist in the Results
    while($row = mysql_fetch_row($result)) {
        echo "<tr>";
        foreach($row as $item) {
            echo "<td>";

            if ($item)
                echo $item;
            else
                echo "NULL";

            echo "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
    echo "</center>";
    echo "</body>";
    echo "</html>";
?>