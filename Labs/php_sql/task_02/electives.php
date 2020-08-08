<!DOCTYPE html>
<html lang="bg">

<head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
    <link rel="stylesheet" type="text/css" href="electives.css">
    <title>Редактиране на избираемата дисциплина</title>
</head>

<body>
    <?php
    include "./request-executor.php";

    $numberPattern = "/^[1-9][0-9]*$/";
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $requestUrl = $_SERVER['REQUEST_URI'];

    $pathId = basename($requestUrl);
    $dirname = dirname($requestUrl);

    if (!preg_match($numberPattern, $pathId) || preg_match($numberPattern, basename($dirname))) {
        die("Incorrect URL.");
    }

    if ($requestMethod == "POST") {
        executePostRequest($pathId);
        $elective = getElective($pathId);
    } elseif ($requestMethod == "GET") {
        $elective = getElective($pathId);
    }
    ?>
    <h2>Редактиране на избираемата дисциплина</h2>
    <form method="POST">
        <label for="course-subject">Име на предмет:</label>
        <input type="text" id="course-subject" name="subjectName" require value="<?php echo $elective["title"]; ?>">
        <label for="course-lecture">Преподавател:</label>
        <input type="text" id="course-lecture" name="lecturerName" require value="<?php echo $elective["lecturer"]; ?>">
        <label for="course-description">Описание:</label>
        <input type="text" id="descr" name="description" require value="<?php echo $elective["description"]; ?>">
        <input type="submit" value="Редактирай">
    </form>
</body>

</html>