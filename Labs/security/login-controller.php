<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
</head>

<body>
    <a href="index.php"> Take me home, country roads ... </a> <br>
    <?php
    include "db-connection.php";
    $conn = openCon();

    $email = $_POST["email"];
    $password = $_POST["password"];
    $table = "person";
    $sql = "SELECT * from $table where email=:email AND password=:password";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $firstrow = $stmt->fetch(PDO::FETCH_ASSOC) or die("Invalid credentials.");
    echo ("Hello " . $firstrow['firstname'] . " you are now logged in.");

    session_start();
    $_SESSION["email"] = $firstrow['email'];

    ?>
</body>

</html>