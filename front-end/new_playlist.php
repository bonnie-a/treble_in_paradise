<html>
  <head>
    <title>Modify Playlist</title>
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
    $song_title = $_POST['song'];
    $username = $_POST['username'];
    $playlist_title = $_POST['playlist_title'];
    $playlist_id;
    $user_id;
    $song_id;
    
    //process data
    $user_q = "SELECT user_id FROM Users WHERE (username = '$username')";
    $result = mysqli_query($db,$user_q);
    if($result === false) {
      die("Database query failed 1");
    } else {
      $row = mysqli_fetch_row($result);
      if($row != null){
        $user_id = $row[0];
      }
      else {
        $user_q2 = "INSERT INTO Users (username) VALUES ('$username')";
        $result = mysqli_query($db,$user_q2);
        if($result === false) {
          die("Database query failed 2");
        } else {
          $user_q = "SELECT user_id FROM Users WHERE (username = '$username')";
          $result = mysqli_query($db,$user_q);
          $row = mysqli_fetch_row($result);
          $user_id = $row[0];
        }
      }
    }
    
    $playlist_q = "SELECT playlist_id FROM Playlists WHERE(playlist_title = '$playlist_title')";
    $result = mysqli_query($db,$playlist_q);
    if($result === false) {
      die("Database query failed 3");
    } else {
      $row = mysqli_fetch_row($result);
      if($row != null){
        $playlist_id = $row[0];
      }
      else {
        $playlist_q2 = "INSERT INTO Playlists (playlist_title, user_id) VALUES ('$playlist_title',$user_id)";
        $result = mysqli_query($db,$playlist_q2);
        if($result === false) {
          die("Database query failed 4");
        } else {
          $playlist_q = "SELECT playlist_id FROM Playlists WHERE(playlist_title = '$playlist_title')";
          $result = mysqli_query($db,$playlist_q);
          $row = mysqli_fetch_row($result);
          $playlist_id = $row[0];
        }
      }
    }
    
    $song_q = "SELECT song_id FROM Songs WHERE(title = '$song_title')";
    $result = mysqli_query($db,$song_q);
    if($result === false) {
      die("Database query failed 5");
    } else {
      $row = mysqli_fetch_row($result);
      $song_id = $row[0];
    }

    //update data
    $sql = "UPDATE Songs SET playlist_id = $playlist_id WHERE (song_id = $song_id)";
    $result = mysqli_query($db,$sql);
    if($result === false) {
      die("Database query failed");
    } else {
      echo "YES";
    }
    
    $db->close();
    ?>