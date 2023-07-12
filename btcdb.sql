-- -- phpMyAdmin SQL Dump
-- -- version 5.2.0
-- -- https://www.phpmyadmin.net/
-- --
-- -- Host: localhost
-- -- Generation Time: Jul 07, 2023 at 02:55 PM
-- -- Server version: 10.4.27-MariaDB
-- -- PHP Version: 8.2.0
--
-- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- START TRANSACTION;
-- SET time_zone = "+00:00";
--
--
-- /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
-- /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
-- /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
-- /*!40101 SET NAMES utf8mb4 */;
--
-- --
-- -- Database: `btcdb`
-- --
--
-- -- --------------------------------------------------------
--
-- --
-- -- Table structure for table `test`
-- --
--
-- CREATE TABLE `test` (
--   `test` varchar(30) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --
-- -- Dumping data for table `test`
-- --
--
-- INSERT INTO `test` (`test`) VALUES
-- ('value-1');
-- COMMIT;
--
-- /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
-- /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
-- /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Create tables without foreign key constraints

CREATE TABLE `user`
(
    id                INT PRIMARY KEY AUTO_INCREMENT,
    name              VARCHAR(100) NOT NULL,
    surname           VARCHAR(100) NOT NULL,
    email             VARCHAR(100) NOT NULL,
    password          VARCHAR(60)  NOT NULL,
    registration_date datetime     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    avatar_img        VARCHAR(255),
    country           VARCHAR(60) NULL DEFAULT '',
    city              VARCHAR(60) NULL DEFAULT ''

# is_admin remove -> admin role add
);

CREATE TABLE `user_role`
(
    id      INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    role_id INT DEFAULT 4
);

CREATE TABLE `role`
(
    id   INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(60) NOT NULL
);

CREATE TABLE `business_field`
(
    id   INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(60) NOT NULL
);

CREATE TABLE `company_info`
(
    id                INT PRIMARY KEY AUTO_INCREMENT,
    name              VARCHAR(60) NOT NULL,
    country           VARCHAR(60) NOT NULL,
    city              VARCHAR(60) NOT NULL,
    business_field_id INT         NOT NULL
);

CREATE TABLE `member_info`
(
    id         INT PRIMARY KEY AUTO_INCREMENT,
    backend    INT NOT NULL DEFAULT 0,
    frontend   INT NOT NULL DEFAULT 0,
    analytics  INT NOT NULL DEFAULT 0,
    management INT NOT NULL DEFAULT 0,
    design     INT NOT NULL DEFAULT 0,
    db         INT NOT NULL DEFAULT 0
);

CREATE TABLE `user_company`
(
    id              INT PRIMARY KEY AUTO_INCREMENT,
    user_id         INT NOT NULL,
    company_info_id INT NOT NULL
);

CREATE TABLE `user_member`
(
    id             INT PRIMARY KEY AUTO_INCREMENT,
    user_id        INT NOT NULL,
    member_info_id INT NOT NULL
);

CREATE TABLE `team`
(
    id                INT PRIMARY KEY AUTO_INCREMENT,
    name              VARCHAR(100) NOT NULL,
    organization_date TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    velocity          INT          NOT NULL DEFAULT 0,
    likes             INT          NOT NULL DEFAULT 0,
    is_open           BIT          NOT NULL DEFAULT 1
);

CREATE TABLE `team_member`
(
    id        INT PRIMARY KEY AUTO_INCREMENT,
    team_id   INT NOT NULL,
    member_id INT NOT NULL
);

CREATE TABLE `purpose`
(
    id   INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255)
);

CREATE TABLE `event`
(
    id                INT PRIMARY KEY AUTO_INCREMENT,
    name              VARCHAR(100) NOT NULL,
    date              TIMESTAMP    NOT NULL,
    company_id        INT          NOT NULL,
    business_field_id INT          NOT NULL,
    purpose_id        INT          NOT NULL,
    place             VARCHAR(100),
    reward            INT,
    entrance_lvl      INT          NOT NULL,
    description       VARCHAR(255) NOT NULL,
    status_id         INT          NOT NULL,
    cover_img         VARCHAR(100),
    duration          VARCHAR(60)  NOT NULL,
    amount            INT          NOT NULL
);

CREATE TABLE `status`
(
    id   INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255)
);

CREATE TABLE `event_teams`
(
    id       INT PRIMARY KEY AUTO_INCREMENT,
    event_id INT,
    team_id  INT
);

-- Add foreign key constraints using table alteration
#
# ALTER TABLE `user_role`
#     ADD FOREIGN KEY (user_id) REFERENCES user (id),
#     ADD FOREIGN KEY (role_id) REFERENCES role (id);
#
# ALTER TABLE `company_info`
#     ADD FOREIGN KEY (business_field_id) REFERENCES business_field (id);
#
# ALTER TABLE `user_company`
#     ADD FOREIGN KEY (user_id) REFERENCES user (id),
#     ADD FOREIGN KEY (company_info_id) REFERENCES company_info (id);
#
# ALTER TABLE `user_member`
#     ADD FOREIGN KEY (user_id) REFERENCES user (id),
#     ADD FOREIGN KEY (member_info_id) REFERENCES member_info (id);
#
# ALTER TABLE `team_member`
#     ADD FOREIGN KEY (team_id) REFERENCES team (id),
#     ADD FOREIGN KEY (member_id) REFERENCES user_member (user_id);
#
# ALTER TABLE `event`
#     ADD FOREIGN KEY (status_id) REFERENCES status (id),
#     ADD FOREIGN KEY (company_id) REFERENCES company_info (id),
#     ADD FOREIGN KEY (business_field_id) REFERENCES business_field (id),
#     ADD FOREIGN KEY (purpose_id) REFERENCES purpose (id);
#
# ALTER TABLE `event_teams`
#     ADD FOREIGN KEY (event_id) REFERENCES event (id),
#     ADD FOREIGN KEY (team_id) REFERENCES team (id);
#

ALTER TABLE `user_role`
    ADD FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE,
    ADD FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE;

ALTER TABLE `company_info`
    ADD FOREIGN KEY (business_field_id) REFERENCES business_field (id);

ALTER TABLE `user_company`
    ADD FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE,
    ADD FOREIGN KEY (company_info_id) REFERENCES company_info (id);

ALTER TABLE `user_member`
    ADD FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE,
    ADD FOREIGN KEY (member_info_id) REFERENCES member_info (id);

ALTER TABLE `team_member`
    ADD FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE,
    ADD FOREIGN KEY (member_id) REFERENCES user_member (user_id) ON DELETE CASCADE;

ALTER TABLE `event`
    ADD FOREIGN KEY (status_id) REFERENCES status (id),
    ADD FOREIGN KEY (company_id) REFERENCES company_info (id) ON DELETE CASCADE,
    ADD FOREIGN KEY (business_field_id) REFERENCES business_field (id),
    ADD FOREIGN KEY (purpose_id) REFERENCES purpose (id);

ALTER TABLE `event_teams`
    ADD FOREIGN KEY (event_id) REFERENCES event (id),
    ADD FOREIGN KEY (team_id) REFERENCES team (id);


-- INSERTION

-- Inserting test data into the role table
INSERT INTO `role` (name)
VALUES ('company'),
       ('member'),
       ('admin'),
       ('visitor');

-- Inserting test data into the business_field table
INSERT INTO `business_field` (name)
VALUES ('Consulting'),
       ('Health Tech'),
       ('Clean Tech'),
       ('Social');

-- Inserting test data into the purpose table
INSERT INTO `purpose` (name)
VALUES ('Internship'),
       ('Conference'),
       ('Hackathon'),
       ('Outsource');

-- Inserting test data into the status table
INSERT INTO `status` (name)
VALUES ('Ongoing'),
       ('Cancelled'),
       ('Finished');


-- Inserting test data into the user table
INSERT INTO user (name, surname, email, password, registration_date, avatar_img)
VALUES ('John', 'Doe', 'john.doe@example.com', '$2y$10$MzODb73kMUWInjLeU7kwS.llnqNdNe1JKpUtKIC3GwKOCj2CVr42O', NOW(),
        'https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1160&q=80'),
       ('Jane', 'Smith', 'jane.smith@example.com', '$2y$10$ho5biNh9zoYCxmNLQPPCEOcnBFD27pMP.EDS6OyVeqSVg623A6uqC',
        NOW(),
        'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80');


-- Inserting test data into the user_role table
INSERT INTO `user_role` (user_id, role_id)
VALUES (1, 3),
       (2, 3);


-- Inserting test data into the company_info table
INSERT INTO `company_info` (name, country, city, business_field_id)
VALUES ('Company A', 'USA', 'New York', 1),
       ('Company B', 'UK', 'London', 2);


-- Inserting test data into the member_info table
INSERT INTO `member_info` (backend, frontend, analytics, management, design, db)
VALUES (1, 1, 1, 1, 1, 1),
       (0, 1, 0, 1, 0, 1);


-- Inserting test data into the user_company table
INSERT INTO `user_company` (user_id, company_info_id)
VALUES (1, 1),
       (2, 2);


-- Inserting test data into the user_member table
INSERT INTO `user_member` (user_id, member_info_id)
VALUES (1, 1),
       (2, 2);


-- Inserting test data into the team table
INSERT INTO `team` (name, organization_date, velocity, likes, is_open)
VALUES ('Team A', NOW(), 10, 5, 1),
       ('Team B', NOW(), 15, 8, 0);


-- Inserting test data into the team_member table
INSERT INTO `team_member` (team_id, member_id)
VALUES (1, 1),
       (2, 2);


-- Inserting test data into the event table
INSERT INTO `event` (name, date, company_id, business_field_id, purpose_id, place, reward, entrance_lvl, description,
                     status_id, cover_img, duration, amount)
VALUES ('Event A', NOW(), 1, 1, 1, 'Venue A', 10000, 1, 'Event A description', 1, 'cover1.jpg', '2 weeks', 50),
       ('Event B', NOW(), 2, 2, 2, 'Venue B', 2000, 2, 'Event B description', 2, 'cover2.jpg', '1 week', 100);


-- Inserting test data into the event_teams table
INSERT INTO `event_teams` (event_id, team_id)
VALUES (1, 1),
       (2, 2);
