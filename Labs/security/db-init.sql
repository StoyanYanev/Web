CREATE DATABASE IF NOT EXISTS `hello-security`;

use `hello-security`;

create table Person (email varchar(255), firstname varchar(255), password varchar(255), role varchar(255));

INSERT INTO person (email, firstname, password, role) values ('asdf@asd', 'kir4o', 'pass', 'student');
INSERT INTO person (email, firstname, password, role) values ('email@lll', 'k2', 'ddd', 'teacher');

ALTER TABLE person 
MODIFY firstname varchar(255) NOT NULL;

ALTER TABLE person 
MODIFY password varchar(255) NOT NULL;

ALTER TABLE person 
MODIFY role varchar(255) NOT NULL;

ALTER TABLE person 
MODIFY email varchar(255) NOT NULL;

ALTER TABLE person
ADD UNIQUE (email);