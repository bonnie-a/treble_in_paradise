<html> 
<head>
    <title>New Band</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="./resources/newemployee.css">
</head> 
<body>
 
    <h1 class=banner>Band Information</h1>
     
    <form action="new_band.php" method="post">
        <div class= description>
            Fill out all provided fields.
        </div>
    
        Band Name: <input name="band_name" type="text" required>
        <br>

        Genre: 
        <select name="genre" id="genre" required></select> 
        <br>
        
        <br> 
        <input type="submit" value="Add Band" name="form_result"> 
        <input type="reset">
    </form>
    
    <div id= copyright>
      Bonnie Atelsek - CSC4710 Database Systems
    </div>
    
</body> 
</html>

<?php
    include('dbconnection.php');
    $query = "SELECT genre FROM Genres";

    $result = mysqli_query($db,$query);
    if (!$result) {
        echo "DB Error, could not list tables\n";
        echo 'MySQL Error: ' . mysqli_error();
        exit;
    }

    while ($row = mysqli_fetch_row($result)) {
        echo "<script>
        var z = document.createElement('option');
        z.setAttribute('value', '".$row[0]."');
        var t = document.createTextNode('".$row[0]."');
        z.appendChild(t);
        document.getElementById('genre').appendChild(z);</script>";
    }
    
    $db->close();
?>