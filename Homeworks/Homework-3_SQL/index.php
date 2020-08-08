<?php

require 'database_manipulation.php';

define("NAME_PATTERN", '/^[a-zA-z-]{2,20}$/', true);
define("COURSE_PATTERN", '/^[1-6]$/', true);
define("SPECIALITY_PATTERN", '/^[a-zA-z-]{2,50}$/', true);
define("FACULTY_NUMBER_PATTERN", '/^[1-9][0-9]{4,10}$/', true);
define("GROUP_PATTERN", '/^([1-9]|10)$/', true);
define("BIRTH_DATE_PATTERN", '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', true);
define("SOCIAL_LINK_PATTERN", '/^.{15,255}/', true);
define("MOTIVATION_PATTERN", '/^.{30,1024}/', true);
define("MAX_FILE_SIZE_BYTES", 3_000_000, true);

define("FIRSTNAME_FIELDNAME", "firstname");
define("LASTNAME_FIELDNAME", "lastname");
define("COURS_FIELDNAME", "course");
define("SPECIALITY_FIELDNAME", "speciality");
define("FACULTY_NUMBER_FIELDNAME", "faculty-number");
define("GROUP_FIELDNAME", "group");
define("BIRTH_DATE_FIELDNAME", "birth-date");
define("ZODIAC_SIGN_FIELDNAME", "zodiac-sign");
define("SOCIAL_LINK_FIELDNAME", "social-link");
define("PHOTO_FIELDNAME", "photo");
define("MOTIVATION_FIELDNAME", "motivation");
define("DATE_FORMAT", "Y-m-d");

$photo_formats = array("jpg", "jpeg", "png", "gif");
$zodiacs = array(
    'Sagittarius',
    'Capricorn',
    'Aquarius',
    'Pisces',
    'Aries',
    'Taurus',
    'Gemini',
    'Cancer',
    'Leo',
    'Virgo',
    'Libra',
    'Scorpio'
);

$invalidFieldMessages = array(
    FIRSTNAME_FIELDNAME => "Please insert correct firstname without any special signs!",
    LASTNAME_FIELDNAME => "Please insert correct lastname without any special signs!",
    COURS_FIELDNAME => "Please insert a number which represents your academic year!",
    SPECIALITY_FIELDNAME => "Please insert correct specialty name without any special signs!",
    FACULTY_NUMBER_FIELDNAME => "Please insert correct faculty number!",
    GROUP_FIELDNAME => "Please insert a number which represents your course group!",
    BIRTH_DATE_FIELDNAME => "Please insert a correct birth date in format yyyy-mm-dd!",
    SOCIAL_LINK_FIELDNAME => "Please insert a correct social link!",
    MOTIVATION_FIELDNAME => "Please write your motivation with length between 30 and 1024 symbols!"
);

if ($_POST) {
    validateFormFields();

    $firstname = $_POST[FIRSTNAME_FIELDNAME];
    $lastname = $_POST[LASTNAME_FIELDNAME];
    $course = $_POST[COURS_FIELDNAME];
    $speciality = $_POST[SPECIALITY_FIELDNAME];
    $facultyNumber = $_POST[FACULTY_NUMBER_FIELDNAME];
    $group = $_POST[GROUP_FIELDNAME];
    $birthDate = $_POST[BIRTH_DATE_FIELDNAME];
    $zodiacSign = $_POST[ZODIAC_SIGN_FIELDNAME];
    $socialLink = $_POST[SOCIAL_LINK_FIELDNAME];
    $motivation = $_POST[MOTIVATION_FIELDNAME];

    $photoName = getUploadedPhoto();

    $dateOfBirth = date(DATE_FORMAT, strtotime($birthDate));

    insertCandidate(
        $firstname,
        $lastname,
        $course,
        $speciality,
        $facultyNumber,
        $group,
        $dateOfBirth,
        $zodiacSign,
        $socialLink,
        $photoName,
        $motivation
    );
}

function validateFormFields()
{
    $errors = array();

    validateCandidateField(FIRSTNAME_FIELDNAME, NAME_PATTERN, $errors);
    validateCandidateField(LASTNAME_FIELDNAME, NAME_PATTERN, $errors);
    validateCandidateField(COURS_FIELDNAME, COURSE_PATTERN, $errors);
    validateCandidateField(SPECIALITY_FIELDNAME, SPECIALITY_PATTERN, $errors);
    validateCandidateField(FACULTY_NUMBER_FIELDNAME, FACULTY_NUMBER_PATTERN, $errors);
    validateCandidateField(GROUP_FIELDNAME, GROUP_PATTERN, $errors);
    validateCandidateField(BIRTH_DATE_FIELDNAME, BIRTH_DATE_PATTERN, $errors);
    validateZodiac(ZODIAC_SIGN_FIELDNAME, $errors);
    validateCandidateField(SOCIAL_LINK_FIELDNAME, SOCIAL_LINK_PATTERN, $errors);
    validateCandidateField(MOTIVATION_FIELDNAME, MOTIVATION_PATTERN, $errors);

    if (count($errors) != 0) {
        die();
    }
}

function validateCandidateField($fieldName, $fieldPattern, &$errors)
{
    $inputValue = $_POST[$fieldName] ?? "";
    if ($inputValue == "") {
        $errors["$fieldName"] = "The field $fieldName is required!";
    } elseif (!preg_match($fieldPattern, $inputValue)) {
        global $invalidFieldMessages;
        $errors[$fieldName] = $invalidFieldMessages[$fieldName];
    }

    if (array_key_exists($fieldName, $errors)) {
        echo "$errors[$fieldName] <br>";
    }
}

function validateZodiac($zodiacFieldName, &$errors)
{
    $zodiacSign = $_POST[$zodiacFieldName] ?? "";
    global $zodiacs;
    if ($zodiacSign == "") {
        $errors[$zodiacFieldName] = "The $zodiacFieldName is required!";
    } elseif (!in_array($zodiacSign, $zodiacs)) {
        $errors[$zodiacFieldName] = "The $zodiacFieldName is invalid!";
    }

    if (array_key_exists($zodiacFieldName, $errors)) {
        echo "$errors[$zodiacFieldName] <br>";
    }
}

function getUploadedPhoto()
{
    $photoUploadErrors = $_FILES[PHOTO_FIELDNAME]["error"];
    if ($photoUploadErrors == UPLOAD_ERR_NO_FILE) {
        die("The photo field is required!");
    }

    $uniquePhotoName = uniqid();
    $photosDirectory = 'images/';
    $info = pathinfo($_FILES[PHOTO_FIELDNAME]['name']);
    $extension = $info['extension'];
    $photoName = $uniquePhotoName . "." . $extension;
    $target = $photosDirectory . $photoName;

    checkUploadedPhoto($photoUploadErrors, $extension);
    savePhoto($photoUploadErrors, $target);

    return $photoName;
}

function checkUploadedPhoto($photoUploadErrors, $extension)
{
    if ($photoUploadErrors == UPLOAD_ERR_NO_TMP_DIR || $photoUploadErrors == UPLOAD_ERR_CANT_WRITE) {
        die("An error occurred! Please try again later!");
    }
    if (!getimagesize($_FILES[PHOTO_FIELDNAME]['tmp_name'])) {
        die("The uploaded file is not an image!");
    }
    if ($_FILES[PHOTO_FIELDNAME]["size"] > MAX_FILE_SIZE_BYTES) {
        die("The uploaded file is to large! The max allowed size is " . (MAX_FILE_SIZE_BYTES / 1000) . " MB");
    }
    global $photo_formats;
    if (!in_array($extension, $photo_formats)) {
        die("The uploaded file is not valid image format. The allowed formats are jpg, jpeg, png, gif.");
    }
}
function savePhoto($photoUploadErrors, &$target)
{
    if ($photoUploadErrors == UPLOAD_ERR_OK) {
        if (!move_uploaded_file($_FILES[PHOTO_FIELDNAME]['tmp_name'], $target)) {
            die("An error occured while uploading the image! Please try again later!");
        }
    }
}
?>