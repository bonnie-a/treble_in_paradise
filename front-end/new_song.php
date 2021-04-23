<html>
  <head>
    <title>New Song</title>
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
    $song_title = $_POST['song_title'];
    $album_title = $_POST['album_title'];
    $band_name = $_POST['band_name'];
    $band_id;
    $album_id;
    
    //process data
    $band_q = "SELECT band_id FROM Bands WHERE(band_name = '" . $band_name . "')";
    $result = mysqli_query($db,$band_q);
    if($result === false) {
      die("Database query failed");
    } else {
      $row = mysqli_fetch_row($result);
      $band_id = $row[0];
    }
    
    $album_q = "SELECT album_id FROM Albums WHERE(album_title = '$album_title')";
    $result = mysqli_query($db,$album_q);
    if($result === false) {
      die("Database query failed");
    } else {
      $row = mysqli_fetch_row($result);
      if($row != null){
        $album_id = $row[0];
      }
      else {
        $album_q2 = "INSERT INTO Albums (album_title, band_id) VALUES ('$album_title',$band_id)";
        $result = mysqli_query($db,$album_q2);
        if($result === false) {
          die("Database query failed");
        } else {
          $row = mysqli_fetch_row($result);
          $album_id = $row[0];
        }
      }
    }

    //insert data
    $sql = "INSERT INTO Songs (title, band_id, album_id) VALUES ('$song_title', '$band_id', '$album_id')";
    $result = mysqli_query($db,$sql);
    if($result === false) {
      die("Database query failed");
    } else {
      echo "YES";
    }
    
    $db->close();
    ?>