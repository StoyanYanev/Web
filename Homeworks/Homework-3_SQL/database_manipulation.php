<?php

require 'configuration_properties.php';

$configs = getConfigurations();
$table_name = $configs['table_name'];

function insertCandidate($firstname, $lastname, $course, $speciality, $facultyNumber, 
                        $group, $birthDate, $zodiacSign, $socialLink, $photo, $motivation) 
{
    global $table_name;

    $connection = getDatabaseConnection();
    $insertQuery = "INSERT INTO 
                        $table_name (
                            firstname,
                            lastname,
                            course,
                            speciality,
                            faculty_number,
                            course_group,
                            date_of_birth,
                            zodiac_sign,
                            social_link,
                            photo,
                            motivation)
                    VALUES 
                    (
                        :firstname,
                        :lastname,
                        :course,
                        :speciality,
                        :facultyNumber,
                        :group,
                        :dateOfBirth,
                        :zodiacSign,
                        :socialLink,
                        :photo,
                        :motivation
                    )";

    $preparedSql = $connection->prepare($insertQuery) or die("An error occurred! Try again later!");
    $preparedSql->bindParam(':firstname', $firstname);
    $preparedSql->bindParam(':lastname', $lastname);
    $preparedSql->bindParam(':course', $course);
    $preparedSql->bindParam(':speciality', $speciality);
    $preparedSql->bindParam(':facultyNumber', $facultyNumber);
    $preparedSql->bindParam(':group', $group);
    $preparedSql->bindParam(':dateOfBirth', $birthDate);
    $preparedSql->bindParam(':zodiacSign', $zodiacSign);
    $preparedSql->bindParam(':socialLink', $socialLink);
    $preparedSql->bindParam(':photo', $photo);
    $preparedSql->bindParam(':motivation', $motivation);

    $preparedSql->execute() or die("An error occurred! Please try again later!");

    echo("You candidate successfully!");
}

function getDatabaseConnection()
{
    global $configs;
    $host = $configs['host'];
    $dbname = $configs['database_name'];
    $username = $configs['username'];
    $password = $configs['password'];

    $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password) or die("An error occurred! Please try again later!");
   
    return $connection;
}
?>