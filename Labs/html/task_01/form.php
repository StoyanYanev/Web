<?php
define("MAX_SUBJECT_NAME_LENGTH", 150, true);
define("MAX_LECTURE_NAME_LENGTH", 200, true);
define("MIN_DESCRIPTION_LENGTH", 10, true);
define("MIN_CREDITS", 0, true);
define("MAX_CREDITS", 20, true);

if ($_POST) {
  $errors = array();
  $subjectName = $_POST['subjectName'];
  $lecturerName = $_POST['lecturerName'];
  $description = $_POST['description'];
  $groups = $_POST['groups'];
  $credits = $_POST['credits'];

  validateSubjectName($subjectName, $errors);
  validateLectureName($lecturerName, $errors);
  validateDescriptionOfSubject($description, $errors);
  validateGroup($groups, $errors);
  validateCredits($credits, $errors);

  if (count($errors) == 0) {
    $filename = 'data.txt';
    file_put_contents($filename, "Име на предмет: ", FILE_APPEND | LOCK_EX);
    file_put_contents($filename, $subjectName, FILE_APPEND | LOCK_EX);
    file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
    file_put_contents($filename, "Име на преподавател: ", FILE_APPEND | LOCK_EX);
    file_put_contents($filename, $lecturerName, FILE_APPEND | LOCK_EX);
    file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
    file_put_contents($filename, "Описание на предмет: ", FILE_APPEND | LOCK_EX);
    file_put_contents($filename, $description, FILE_APPEND | LOCK_EX);
    file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
    file_put_contents($filename, "Група: ", FILE_APPEND | LOCK_EX);
    file_put_contents($filename, $groups, FILE_APPEND | LOCK_EX);
    file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
    file_put_contents($filename, "Кредити: ", FILE_APPEND | LOCK_EX);
    file_put_contents($filename, $credits, FILE_APPEND | LOCK_EX);
    file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
    file_put_contents($filename, "=====================================================", FILE_APPEND | LOCK_EX);
    file_put_contents($filename, "\n", FILE_APPEND | LOCK_EX);
  }
}


function validateSubjectName($subjectName, $errors)
{
  if (!$subjectName) {
    $errors['subjectName'] = 'Името на предмета е задължително поле.';
  } elseif (strlen($subjectName) > MAX_SUBJECT_NAME_LENGTH) {
    $errors['subjectName'] = 'Името на предмета трябва да е по-малко от 150 символа.';
  }
  if (array_key_exists('subjectName', $errors)) {
    echo $errors['subjectName'];
  }
}

function validateLectureName($lecturerName, $errors)
{
  if (!$lecturerName) {
    $errors['lecturerName'] = 'Името на лектора е задължително поле.';
  } elseif (strlen($lecturerName) > MAX_LECTURE_NAME_LENGTH) {
    $errors['lecturerName'] = 'Името на лектора трябва да е по-малко от 200 символа.';
  }
  if (array_key_exists('lecturerName', $errors)) {
    echo $errors['lecturerName'];
  }
}

function validateDescriptionOfSubject($description, $errors)
{
  if (!$description) {
    $errors['description'] = 'Описанието на предмета е задължително поле.';
  } elseif (strlen($description) < MIN_DESCRIPTION_LENGTH) {
    $errors['description'] = 'Описанието на предмета трябва да е по-голямо от 10 символа.';
  }
  if (array_key_exists('description', $errors)) {
    echo $errors['description'];
  }
}

function validateGroup($groups, $errors)
{
  if (!$groups) {
    $errors['groups'] = 'Трябва да изберете поне една група.';
    echo $errors['groups'];
  }
}

function validateCredits($credits, $errors)
{
  if (!$credits) {
    $errors['credits'] = 'Кредит е задължително поле.';
  } elseif (strlen($credits) < MIN_CREDITS) {
    $errors['credits'] = 'Кредита трябва да е положително число.';
  } elseif (strlen($credits) > MAX_CREDITS) {
    $errors['credits'] = 'Кредита може да бъде най-много 20.';
  }
  if (array_key_exists('credits', $errors)) {
    echo $errors['credits'];
  }
}
?>