<?php

include "./db-manipulation.php";

define("MAX_SUBJECT_NAME_LENGTH", 128, true);
define("MAX_LECTURE_NAME_LENGTH", 128, true);
define("MAX_DESCRIPTION_LENGTH", 1024, true);
define("MIN_DESCRIPTION_LENGTH", 10, true);

$fileName = "request-executor.php";
$dirname = basename($_SERVER['REQUEST_URI']);
if ($_POST) {
  if ($fileName == $dirname) {
    executePostRequest(null);
  }
}

function executePostRequest($electiveId)
{

  $subjectName = $_POST['subjectName'];
  $lecturerName = $_POST['lecturerName'];
  $description = $_POST['description'];

  $errors = array();
  validateElectiveField($subjectName, MAX_SUBJECT_NAME_LENGTH, $errors);
  validateElectiveField($lecturerName, MAX_LECTURE_NAME_LENGTH, $errors);
  validateElectiveField($description, MAX_DESCRIPTION_LENGTH, $errors);

  if (count($errors) != 0) {
    die();
  }

  if (is_null($electiveId)) {
    createNewElective($subjectName, $lecturerName, $description);
  } else {
    updateExistingElective($subjectName, $lecturerName, $description, $electiveId);
  }
}

function createNewElective($subjectName, $lecturerName, $description)
{
  addElactive($subjectName, $lecturerName, $description);
  echo ("Elective is added sucesfully!");
}

function updateExistingElective($subjectName, $lecturerName, $description, $electiveId)
{
  checkIfElectiveExsists($electiveId);
  updateElective($subjectName, $lecturerName, $description, $electiveId);
  echo ("Elective is updated sucesfully!");
}

function getElective($electiveId)
{
  checkIfElectiveExsists($electiveId);

  return getEletiveById($electiveId);
}

function checkIfElectiveExsists($electiveId)
{
  $elective = getEletiveById($electiveId);
  $isElectiveExists = $elective["title"];
  if (!$isElectiveExists) {
    die("The elective with the given id: $electiveId is not existing.");
  }
}

function validateElectiveField(String $formField, int $maxLength, &$errors)
{
  if (!$formField) {
    $errors["$formField"] = "Полето е задължително.";
  } elseif (strlen($formField) > $maxLength) {
    $errors["$formField"] = "Полето има максимална дължина $maxLength символа.";
  }
  if (array_key_exists($formField, $errors)) {
    echo $errors[$formField];
  }
}
