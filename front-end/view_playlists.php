<html> 
<head>
    <title>Playlists</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="./resources/newemployee.css">
</head> 
<body>
 
    <h1 class=banner>Playlists</h1>
     
    <div id="wrapper"></div>
    
    <div id= copyright>
      Bonnie Atelsek - CSC4710 Database Systems
    </div>
    
</body> 
</html>

<?php
include('dbconnection.php');

$playlists = array();

$playlist_q = "SELECT playlist_title, playlist_id, user_id FROM Playlists;";
$result = mysqli_query($db, $playlist_q);

    //fetch playlist titles and user-ids
while($row = mysqli_fetch_row($result)) {
    $arr = array($row[0],$row[1],$row[2]);
    array_push($playlists, $arr);
  }

    //fetch usernames corresponding to user_ids
for($i = 0; $i < count($playlists); $i++) {
    $user_id = $playlists[$i][2];
    $user_q = "SELECT username FROM Users WHERE (user_id = $user_id)";
    $result = mysqli_query($db, $user_q);
    $row = mysqli_fetch_row($result);
    $playlists[$i][2] = $row[0];
}

    //add songs to array
for($i = 0; $i < count($playlists); $i++) {
    $arr = array();
    $playlist_id = $playlists[$i][1];
    $songs_q = "SELECT title FROM Songs WHERE (playlist_id = $playlist_id)";
    $result = mysqli_query($db, $songs_q);
    
    while($row = mysqli_fetch_row($result)) {
        array_push($arr, $row[0]);
    }
    array_push($playlists[$i], $arr);
}

//array structure: {[playlist name], [playlist id], [username], [songs]...}

//display playlists
for($i = 0; $i < count($playlists); $i++) {
    $ptitle = $playlists[$i][0];
    $username = $playlists[$i][2];
    $songs = $playlists[$i][3];
    $numsongs = count($songs);
    $songlist = '["' . implode('", "', $songs) . '"]';
    
    echo "<script>
        var wrapper = document.getElementById('wrapper');
        
        var playlist = document.createElement('form');
        var pt = document.createElement('p');
            playlist.innerText = 'Playlist: ' + '$ptitle';
        var user = document.createElement('p');
            user.innerText = 'Creator: ' + '$username';
        playlist.appendChild(pt);
        playlist.appendChild(user);
        
        var songlist = $songlist;
        var str = '';
        for (var i = 0; i < $numsongs; i++) {
            str = str + songlist[i] + '\\n';
        }
        var songs = document.createElement('p');
            songs.innerText = str;
        playlist.appendChild(songs);
        
        wrapper.appendChild(playlist);
        </script>";
}


$db->close();
?>