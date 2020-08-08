<?php

$configs = include('configuration_properties.php');
$table_name = $configs['table_name'];

function addElactive($subjectName, $lecturerName, $description)
{
  global $table_name;

  $insertStatment = "INSERT INTO global $table_name (title, description, lecturer) 
              VALUES 
                (:title, :description, :teacher)";

  $connection = getConnectionWithDatabase();
  $statement = $connection->prepare($insertStatment);
  $statement->bindParam(':title', $subjectName);
  $statement->bindParam(':description', $description);
  $statement->bindParam(':teacher', $lecturerName);
  $statement->execute() or die("Failed to execute query to database!");
}

function updateElective($subjectName, $lecturerName, $description, $electiveId)
{
  global $table_name;
  
  $updateStatement = "UPDATE $table_name 
              SET 
                title = :titlePlaceholder, description = :descriptionPlaceholder, lecturer = :lecturerPlaceholder
              WHERE id=:electiveId;";

  $connection = getConnectionWithDatabase();
  $statement = $connection->prepare($updateStatement);
  $statement->bindParam(':titlePlaceholder', $subjectName);
  $statement->bindParam(':descriptionPlaceholder', $description);
  $statement->bindParam(':lecturerPlaceholder', $lecturerName);
  $statement->bindParam(':electiveId', $electiveId);
  $statement->execute() or die("Failed to execute query to database!");
}

function getEletiveById($electiveId)
{
  global $table_name;
  $selectStatment = "SELECT * FROM $table_name
              WHERE id=:electiveId";

  $connection = getConnectionWithDatabase();
  $statement = $connection->prepare($selectStatment);
  $statement->bindParam(':electiveId', $electiveId);
  $statement->execute() or die("Failed to execute query to database!");
  $elective = $statement->fetch(PDO::FETCH_ASSOC) or die("The elective is not found!");

  return $elective;
}
function getConnectionWithDatabase()
{
  global $configs;
  $host = $configs['host'];
  $dbname = $configs['database_name'];
  $username = $configs['username'];
  $password = $configs['password'];

  try{
    $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    return $connection;
  }
  catch(PDOException $error) {
    die($error->getMessage());
  }
}
?>