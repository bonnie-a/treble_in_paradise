<?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $database = "treble_db";
 $port = "3306";
 
  $db = mysqli_connect($servername,$username,$password,$database,$port)
  or die('Error connecting to MySQL server.');
?>