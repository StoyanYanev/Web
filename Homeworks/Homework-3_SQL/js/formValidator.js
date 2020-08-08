const INVALID_FIRSTNAME_ID = "invalid-firstname";
const INVALID_LASTNAME_ID = "invalid-lastname";
const INVALID_COURSE_ID = "invalid-course";
const INVALID_SPECIALITY_ID = "invalid-speciality";
const INVALID_FACULTY_NUMBER_ID = "invalid-faculty-number";
const INVALID_GROUP_ID = "invalid-group";
const INVALID_SOCIAL_LINK_ID = "invalid-social-link";
const INVALID_MOTIVATION_ID = "invalid-motivation";

const NAME_REGEX = /^[a-zA-Z-]{2,20}$/;
const COURSE_REGEX = /^[1-6]$/;
const SPECIALITY_REGEX = /^[a-zA-Z-]{2,50}$/;
const FACULTY_NUMBER_REGEX = /^[1-9][0-9]{4,10}$/;
const GROUP_REGEX = /^([1-9]|10)$/;
const SOCIAL_LINK_REGEX = /.{15,255}/;
const MOTIVATION_REGEX = /.{30,1024}/;

const ERROR_FIRSTNAME_MESSAGE = "Please insert correct firstname without any special signs!";
const ERROR_LASTNAME_MESSAGE = "Please insert correct lastname without any special signs!";
const ERROR_COURSE_MESSAGE = "Please insert a number which represents your academic year!";
const ERROR_SPECIALITY_MESSAGE = "Please insert correct specialty name without any special signs!";
const ERROR_FACULTY_NUMBER_MESSAGE = "Please insert correct faculty number!";
const ERROR_GROUP_MESSAGE = "Please insert a number which represents your course group!";
const ERROR_SOCIAL_LINK_MESSAGE = "Please insert a correct social link!";
const ERROR_MOTIVATION_MESSAGE = "Please write your motivation with length between 30 and 1024 symbols!";

const months = {
    JANUARY: 1,
    FEBRUARY: 2,
    MARCH: 3,
    APRIL: 4,
    MAY: 5,
    JUNE: 6,
    JULY: 7,
    AUGUST: 8,
    SEPTEMBER: 9,
    OCTOBER: 10,
    NOVEMBER: 11,
    DECEMBER: 12,
};

const zodiacs = {
    SAGITTARIUS: "Sagittarius",
    CAPRICORN: "Capricorn",
    AQUARIUS: "Aquarius",
    PISCES: "Pisces",
    ARIES: "Aries",
    TAURUS: "Taurus",
    GEMINI: "Gemini",
    CANCER: "Cancer",
    LEO: "Leo",
    VIRGO: "Virgo",
    LIBRA: "Libra",
    SCORPIO: "Scorpio",
};

function validateFields() {

    return isFirstnameValid() &&
        isLastnameValid() &&
        isCourseValid() &&
        isSpecialityValid() &&
        isFacultyNumberValid() &&
        isGroupValid() &&
        isSocialLinkValid() &&
        isMotivationValid();
}

function getElementByIdFromDocument(elementName) {
    return document.getElementById(elementName);
}

function isFirstnameValid() {
    let firstname = getElementByIdFromDocument("firstname").value;
    return validateField(firstname, NAME_REGEX, INVALID_FIRSTNAME_ID, ERROR_FIRSTNAME_MESSAGE);
}

function isLastnameValid() {
    let lastname = getElementByIdFromDocument("lastname").value;
    return validateField(lastname, NAME_REGEX, INVALID_LASTNAME_ID, ERROR_LASTNAME_MESSAGE);
}

function isCourseValid() {
    let course = getElementByIdFromDocument("course").value;
    return validateField(course, COURSE_REGEX, INVALID_COURSE_ID, ERROR_COURSE_MESSAGE);
}

function isSpecialityValid() {
    let speciality = getElementByIdFromDocument("speciality").value;
    return validateField(speciality, SPECIALITY_REGEX, INVALID_SPECIALITY_ID, ERROR_SPECIALITY_MESSAGE);
}

function isFacultyNumberValid() {
    let facultyNumber = getElementByIdFromDocument("faculty-number").value;
    return validateField(facultyNumber, FACULTY_NUMBER_REGEX, INVALID_FACULTY_NUMBER_ID, ERROR_FACULTY_NUMBER_MESSAGE);
}

function isGroupValid() {
    let group = getElementByIdFromDocument("group").value;
    return validateField(group, GROUP_REGEX, INVALID_GROUP_ID, ERROR_GROUP_MESSAGE);
}

function isSocialLinkValid() {
    let socialLink = getElementByIdFromDocument("social-link").value;
    return validateField(socialLink, SOCIAL_LINK_REGEX, INVALID_SOCIAL_LINK_ID, ERROR_SOCIAL_LINK_MESSAGE);
}

function isMotivationValid() {
    let motivation = getElementByIdFromDocument("motivation").value;
    return validateField(motivation, MOTIVATION_REGEX, INVALID_MOTIVATION_ID, ERROR_MOTIVATION_MESSAGE);
}

function showZodiacSign() {
    let birthDate = getElementByIdFromDocument("birth-date").value;
    let date = new Date(birthDate);

    let month = date.getMonth() + 1;
    let day = date.getDate();
    var zodiacSign = "";

    if (month == months.DECEMBER) {
        if (day < 22) {
            zodiacSign = zodiacs.SAGITTARIUS;
        } else {
            zodiacSign = zodiacs.CAPRICORN;
        }
    } else if (month == months.JANUARY) {
        if (day < 20) {
            zodiacSign = zodiacs.CAPRICORN;
        } else {
            zodiacSign = zodiacs.AQUARIUS;
        }
    } else if (month == months.FEBRUARY) {
        if (day < 19) {
            zodiacSign = zodiacs.AQUARIUS
        } else {
            zodiacSign = zodiacs.PISCES
        }
    } else if (month == months.MARCH) {
        if (day < 21) {
            zodiacSign = zodiacs.PISCES
        } else {
            zodiacSign = zodiacs.ARIES;
        }
    } else if (month == months.APRIL) {
        if (day < 20) {
            zodiacSign = zodiacs.ARIES;
        } else {
            zodiacSign = zodiacs.TAURUS;
        }
    } else if (month == months.MAY) {
        if (day < 21) {
            zodiacSign = zodiacs.TAURUS;
        } else {
            zodiacSign = zodiacs.GEMINI;
        }
    } else if (month == months.JUNE) {
        if (day < 21) {
            zodiacSign = zodiacs.GEMINI;
        } else {
            zodiacSign = zodiacs.CANCER;
        }
    } else if (month == months.JULY) {
        if (day < 23) {
            zodiacSign = zodiacs.CANCER;
        } else {
            zodiacSign = zodiacs.LEO;
        }
    } else if (month == months.AUGUST) {
        if (day < 23) {
            zodiacSign = zodiacs.LEO;
        } else {
            zodiacSign = zodiacs.VIRGO;
        }
    } else if (month == months.SEPTEMBER) {
        if (day < 23) {
            zodiacSign = zodiacs.VIRGO;
        } else {
            zodiacSign = zodiacs.LIBRA;
        }
    } else if (month == months.OCTOBER) {
        if (day < 23) {
            zodiacSign = zodiacs.LIBRA;
        } else {
            zodiacSign = zodiacs.SCORPIO;
        }
    } else if (month == months.NOVEMBER) {
        if (day < 22) {
            zodiacSign = zodiacs.SCORPIO;
        } else {
            zodiacSign = zodiacs.SAGITTARIUS;
        }
    }
    let zodiacSignField = getElementByIdFromDocument("zodiac-sign");
    zodiacSignField.value = zodiacSign;
}

function validateField(field, regex, invalidFieldId, message) {
    if (field.length == 0) {
        showErrorMessage("The field is required!", invalidFieldId);
        return false;
    }
    if (!field.match(regex)) {
        showErrorMessage(message, invalidFieldId);
        return false;
    }
    hideErrorMessag(invalidFieldId);
    return true;
}

function showErrorMessage(message, elementName) {
    let invalidLabel = getElementByIdFromDocument(elementName);
    invalidLabel.innerHTML = message;
}

function hideErrorMessag(elementName) {
    let invalidLabel = getElementByIdFromDocument(elementName);

    if (invalidLabel.innerHTML !== "") {
        invalidLabel.innerHTML = "";
    }
}