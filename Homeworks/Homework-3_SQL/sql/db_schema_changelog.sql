-- To connect with database I use username=root and EMPTY password
CREATE DATABASE IF NOT EXISTS `62240_Stoyan_Yanev` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `62240_Stoyan_Yanev`;

CREATE TABLE candidate (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(20) NOT NULL,
    lastname VARCHAR(20) NOT NULL,
    course INT NOT NULL,
    speciality VARCHAR(50) NOT NULL,
    faculty_number INT NOT NULL,
    course_group INT NOT NULL,
    date_of_birth DATE NOT NULL,
    zodiac_sign enum(
        'SAGITTARIUS',
        'CAPRICORN',
        'AQUARIUS',
        'PISCES',
        'ARIES',
        'TAURUS',
        'GEMINI',
        'CANCER',
        'LEO',
        'VIRGO',
        'LIBRA',
        'SCORPIO'
    ) NOT NULL,
    social_link VARCHAR(255) NOT NULL,
    photo VARCHAR(20) NOT NULL,
    motivation VARCHAR(1024) NOT NULL
);