<?php

include "../autoload.php";

function setDatabaseConnection(): mysqli
{
    $databaseConnection = mysqli_connect(env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_NAME'));

    if($databaseConnection === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    return $databaseConnection;
}