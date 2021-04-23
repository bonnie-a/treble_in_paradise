<html> 
<head>
    <title>New Song</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="./resources/newemployee.css">
</head> 
<body>
 
    <h1 class=banner>Song Information</h1>
     
    <form action="new_song.php" method="post">
        <div class= description>
            Fill out all provided fields. If the Band to which the song belongs does not appear in the list,
            return to the previous screen and add it.
        </div>
    
        Song Title: <input name="song_title" type="text" required>
        <br>
        
        Album Name: <input name="album_title" type="text" required>
        <br>
        
        Band Name: 
        <select name="band_name" id="band_name" required></select> 
        <br>
        
        <br> 
        <input type="submit" value="Add Song" name="form_result"> 
        <input type="reset">
    </form>
    
    <div id= copyright>
      Bonnie Atelsek - CSC4710 Database Systems
    </div>
    
</body> 
</html>

<?php
    include('dbconnection.php');
    $query = "SELECT band_name from Bands";

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
        document.getElementById('band_name').appendChild(z);</script>";
    }
    
    $db->close();
?>