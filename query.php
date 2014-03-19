<?php
error_reporting(7);
require_once("dbconn.php");
$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);


if(mysqli_connect_errno()){
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

if ($result = $mysqli->query("SELECT `hash` FROM `hash_table` WHERE 1")) {
    //printf("Select returned %d rows.\n", $result->num_rows);

    $id = 1;
    while ($row = $result->fetch_row())  
    {
       echo "<div>" .
       "<tfbody>" .  
       "<tr>" .  
       "<td>" . $id . "</td>" .                                                                                                 
       "<td>" . $row[0] . "</td>" .  
       "<td><a href=\"decrypt.php?hash=" . $row[0] . "\">DECRYPT ME</a></td>" .  
       "</tr>" .
       "</tfbody>" .  
       "</div>";
       $id = $id + 1;  
    }                 

    /* free result set */
    $result->close();
}


