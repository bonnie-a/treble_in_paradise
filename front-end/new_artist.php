<html>
  <head>
    <title>New Artist</title>
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
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $band_name = $_POST['band_name'];
    $band_id;
    
    //process data
    $band_q = "SELECT band_id FROM Bands WHERE(band_name = '" . $band_name . "')";
    $result = mysqli_query($db,$band_q);
    if($result === false) {
      die("Database query failed");
    } else {
      $row = mysqli_fetch_row($result);
      $band_id = $row[0];
    }

    //insert data
    $sql = "INSERT INTO Artists (fname, lname, band_id) VALUES ('$fname', '$lname', $band_id)";
    $result = mysqli_query($db,$sql);
    if($result === false) {
      die("Database query failed");
    } else {
      echo "YES";
    }
    
    $db->close();
    ?>