CREATE DATABASE programming_courses;

CREATE USER 'ranepauser'@'%' IDENTIFIED BY '12345';
GRANT ALL PRIVILEGES ON programming_courses.* TO 'ranepauser'@'%';
FLUSH PRIVILEGES;

CREATE TABLE `educations`
(
    `id`         int          NOT NULL AUTO_INCREMENT,
    `title`      varchar(255) NOT NULL,
    `short_name` varchar(50)  NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `education_short_name` (`short_name`)
) ENGINE = InnoDB;

INSERT INTO `educations` (`id`, `title`, `short_name`)
VALUES (1, 'Среднее', 'school'),
       (2, 'Высшее', 'higher'),
       (3, 'Другое', 'other');

CREATE TABLE `learning_times`
(
    `id`         int          NOT NULL AUTO_INCREMENT,
    `title`      varchar(255) NOT NULL,
    `short_name` varchar(50)  NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `short_name` (`short_name`)
) ENGINE = InnoDB;

INSERT INTO `learning_times` (`id`, `title`, `short_name`)
VALUES (1, 'Утро, 09:00 - 12:00', 'morning'),
       (2, 'День, 12:00 - 17:00', 'day'),
       (3, 'Вечер, 17:00 - 21:00', 'evening');

CREATE TABLE `programming_languages`
(
    `id`                  int          NOT NULL AUTO_INCREMENT,
    `language_name`       varchar(100) NOT NULL,
    `short_language_name` varchar(50)  NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `short_language_name` (`short_language_name`)
) ENGINE = InnoDB;

INSERT INTO `programming_languages` (`id`, `language_name`, `short_language_name`)
VALUES (1, 'PHP', 'php'),
       (2, 'GoLang', 'go'),
       (3, 'Phyton', 'phyton');

CREATE TABLE `request_for_training`
(
    `id`                      int          NOT NULL AUTO_INCREMENT,
    `username`                varchar(100) NOT NULL,
    `about_me`                text,
    `learning_time_id`        int DEFAULT NULL,
    `programming_language_id` int          NOT NULL,
    `education_id`            int          NOT NULL,
    `email`                   varchar(50)  NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`),
    KEY `programming_language_id` (`programming_language_id`)
) ENGINE = InnoDB;
