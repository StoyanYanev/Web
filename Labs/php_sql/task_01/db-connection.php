<?php

function addElactive($subjectName, $lecturerName, $description)
{
    $host = "localhost";
    $username = "root";
    $pass = "";
    $dbname = "test";

    $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $pass);
    
    $query = "INSERT INTO electives (title, description, lecturer) 
              VALUES 
                (:title, :description, :teacher)";

    $statement = $connection->prepare($query) or die("Failed to connect with database!");
    $statement->bindParam(':title', $subjectName);
    $statement->bindParam(':description', $description);
    $statement->bindParam(':teacher', $lecturerName);
    $statement->execute();
}

?>