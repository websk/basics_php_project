CREATE DATABASE programming_courses;

CREATE USER 'ranepauser'@'%' IDENTIFIED BY '12345';
GRANT ALL PRIVILEGES ON programming_courses.* TO 'ranepauser'@'%';
FLUSH PRIVILEGES;

CREATE TABLE programming_languages (
                                       id int NOT NULL AUTO_INCREMENT,
                                       language_name varchar(255) NOT NULL,
                                       short_language_name varchar(255) NOT NULL,
                                       PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE request_for_training (
                                      id int NOT NULL AUTO_INCREMENT,
                                      username varchar(100) NOT NULL,
                                      about_me text,
                                      time_for_learning_id int DEFAULT NULL,
                                      programming_language_id int NOT NULL,
                                      education_id int NOT NULL,
                                      email varchar(50) NOT NULL,
                                      PRIMARY KEY (id),
                                      UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB;

INSERT INTO programming_languages VALUES (1, 'GoLang', 'go');
INSERT INTO programming_languages (language_name, short_language_name) VALUES ('PHP', 'php');
INSERT INTO programming_languages SET language_name = 'Python', short_language_name = 'phyton';