<html>
  <head>
    <title>New BAnd</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="./resources/newemployee.css">
  </head>
  
  <body>
    <!--Displays the back bar and the copyright bar at the bottom-->
    <div class = banner>
      <a href= "./index.html"> Back </a>
    </div>
        
    <div id= copyright>
      Bonnie Atelsek - CSC4710 Database Systems
    </div>
    
  </body>
</html>

<?php
    include('dbconnection.php');
    
    //create variables to hold values from the input form
    $band_name = $_POST['band_name'];
    $genre = $_POST['genre'];
    $genre_id;
    
    //process data
    $genre_q = "SELECT genre_id FROM Genres WHERE(genre = '$genre')";
    $result = mysqli_query($db,$genre_q);
    if($result === false) {
      die("Database query failed");
    } else {
      $row = mysqli_fetch_row($result);
      $genre_id = $row[0];
    }

    //insert data
    $sql = "INSERT INTO Bands (band_name, genre_id) VALUES ('$band_name', $genre_id)";
    $result = mysqli_query($db,$sql);
    if($result === false) {
      die("Database query failed");
    } else {
      echo "YES";
    }
    
    $db->close();
    ?>