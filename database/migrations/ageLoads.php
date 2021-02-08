<?php

include "./autoload.php";
include "./database/connection.php";

$databaseConnection = setDatabaseConnection();

$sql = "CREATE TABLE IF NOT EXISTS age_loads(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    start INTEGER NOT NULL,
    end INTEGER NOT NULL,
    load_value FLOAT NOT NULL
)";

if(mysqli_query($databaseConnection, $sql)){
    echo "Table created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($databaseConnection);
}

mysqli_close($databaseConnection);
