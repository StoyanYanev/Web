<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
</head>

<body>
    <a href="index.php"> Take me home, country roads ... </a> <br>
    <?php

    session_start();

    if (!isset($_SESSION["email"])) {
        die("Only authenticated users are allowed");
    }

    include "db-connection.php";
    $conn = openCon();

    $table = "person";
    $email = $_SESSION["email"];
    $sql = "SELECT * from $table where email = :email;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->execute() or die("Failed to query from DB!");
    $firstrow = $stmt->fetch(PDO::FETCH_ASSOC) or die("User not found.");

    $role = $firstrow['role'];
    $adminRole = "admin";
    if (strcmp($role, $adminRole) != 0) {
        die("You are not authorized for this operation!");
    }

    $sql = "SELECT * from $table;";
    $resultSet = $conn->prepare($sql);
    $resultSet->execute() or  die("Failed to query from DB!");

    echo ("The users in the system are: <br>");
    while ($row = $resultSet->fetch(PDO::FETCH_ASSOC)) {
        echo $row['email'] . " " . $row['firstname'] . " " . $row['role'];
        echo "<br>";
    }
    ?>
</body>

</html>