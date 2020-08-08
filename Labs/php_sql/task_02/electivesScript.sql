CREATE DATABASE IF NOT EXISTS test;

CREATE TABLE electives (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(128),
  description VARCHAR(1024),
  lecturer VARCHAR(128)
);

INSERT INTO electives (title, description, lecturer)
VALUES
  ("Programming with Go", "Let's learn Go", "Nikolay Batchiyski"),
  ("AKDU", "Let's Graduate", "Svetlin Ivanov"),
  ("Web technologies", "Let's learn the web", "Milen Petrov");

ALTER TABLE electives
ADD created_at timestamp DEFAULT current_timestamp() ON UPDATE current_timestamp();