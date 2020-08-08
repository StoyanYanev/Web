<?php
include "db-connection.php";
$conn = openCon();

$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : false;
$password = isset($_POST['password']) ? $_POST['password'] : false;
$role = isset($_POST['role']) ? $_POST['role'] : false;

$email = $_POST["email"];
$firstname = $_POST["firstname"];
$password = $_POST["password"];
$role = $_POST["role"];
$table = "person";
$adminRole = "admin";
$teacherRole = "teacher";
$studentRole = "student";

if ($firstname && $password && $role) {
  if (strcmp($role, $studentRole) == 0 || strcmp($role, $teacherRole) == 0) {
    $selectStatement = "SELECT COUNT(*) FROM $table WHERE email = :email";
    $selectedEmails = $conn->prepare($selectStatement);
    $selectedEmails->bindParam(':email', $email);
    $selectedEmails->execute();
    $result = $selectedEmails->fetch();

    if ($result[0] == 0) {
      $insertStatement = "INSERT INTO $table (email, firstname, password, role) values(:email, :firstname, :password, :role);";
      $stmt = $conn->prepare($insertStatement);
      $stmt->bindParam(":email", $email);
      $stmt->bindParam(":firstname", $firstname);
      $stmt->bindParam(":password", $password);
      $stmt->bindParam(":role", $role);
      $stmt->execute() or die("Failed to query!");
      echo ("You are registered as: " . $email . " with role: " .  $role);
    } else {
      die("There is existing user with this email");
    }
  }
} else {
  echo "All fields are required!";
}
