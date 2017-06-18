<?php
    //Connect to the database
    $host = "127.0.0.1";
    $user = "naxespsn";                          //Cloud 9 username
    $pass = "";                                  //NO password by default!
    $db = "lexicode";                            //Name of database to connect (on phpmyadmin)
    $port = 3306;                                //The port #. It is always 3306
    
    $mysqli = new mysqli($host, $user, $pass, $db, $port)or die($mysqli->error);
?>