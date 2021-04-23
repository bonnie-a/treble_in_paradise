<html> 
<head>
    <title>Edit Playlist</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="./resources/newemployee.css">
</head> 
<body>
 
    <h1 class=banner>Edit/Create Playlist</h1>
     
    <form action="new_playlist.php" method="post">
        <div class= description>
            Fill out all provided fields. <br>
            If the song you want to add does not appear in the list, return to the previous screen
            and add it to the database.<br><br>
            If you are adding to an existing playlist, enter the title of the playlist you are editing.
            If you are creating a new playlist, enter the title you'd like your new playlist to have.
        </div>
    
        Username: <input name="username" type="text" required>
        <br>
        
        Playlist Title: <input name="playlist_title" type="text" required>
        <br>
        
        What song would you like to add?
        <select name="song" id="song" required></select> 
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
    $query = "SELECT title FROM Songs";

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
        document.getElementById('song').appendChild(z);</script>";
    }
    
    $db->close();
?>