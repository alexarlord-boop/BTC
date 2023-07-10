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
    name              VARCHAR(255),
    surname           VARCHAR(255),
    email             VARCHAR(255),
    password          VARCHAR(255),
    registration_date TIMESTAMP,
    avatar_img        VARCHAR(255),
    is_admin          BIT
);

CREATE TABLE `user_role`
(
    id      INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    role_id INT
);

CREATE TABLE `role`
(
    id   INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255)
);

CREATE TABLE `business_field`
(
    id   INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255)
);

CREATE TABLE `company_info`
(
    id                INT PRIMARY KEY AUTO_INCREMENT,
    name              VARCHAR(255),
    country           VARCHAR(255),
    city              VARCHAR(255),
    business_field_id INT
);

CREATE TABLE `member_info`
(
    id         INT PRIMARY KEY AUTO_INCREMENT,
    backend    INT,
    frontend   INT,
    analytics  INT,
    management INT,
    design     INT,
    db         INT
);

CREATE TABLE `user_company`
(
    id              INT PRIMARY KEY AUTO_INCREMENT,
    user_id         INT,
    company_info_id INT
);

CREATE TABLE `user_member`
(
    id             INT PRIMARY KEY AUTO_INCREMENT,
    user_id        INT,
    member_info_id INT
);

CREATE TABLE `team`
(
    id                INT PRIMARY KEY AUTO_INCREMENT,
    name              VARCHAR(255),
    organization_date TIMESTAMP,
    velocity          INT,
    likes             INT,
    is_open           BIT
);

CREATE TABLE `team_member`
(
    id        INT PRIMARY KEY AUTO_INCREMENT,
    team_id   INT,
    member_id INT
);

CREATE TABLE `purpose`
(
    id   INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255)
);

CREATE TABLE `event`
(
    id                INT PRIMARY KEY AUTO_INCREMENT,
    name              VARCHAR(255),
    date              TIMESTAMP,
    company_id        INT,
    business_field_id INT,
    purpose_id        INT,
    place             VARCHAR(255),
    reward            INT,
    entrance_lvl      INT,
    description       VARCHAR(255),
    status_id         INT,
    cover_img         VARCHAR(255),
    duration          VARCHAR(255),
    amount             INT
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

ALTER TABLE `user_role`
    ADD FOREIGN KEY (user_id) REFERENCES user (id),
    ADD FOREIGN KEY (role_id) REFERENCES role (id);

ALTER TABLE `company_info`
    ADD FOREIGN KEY (business_field_id) REFERENCES business_field (id);

ALTER TABLE `user_company`
    ADD FOREIGN KEY (user_id) REFERENCES user (id),
    ADD FOREIGN KEY (company_info_id) REFERENCES company_info (id);

ALTER TABLE `user_member`
    ADD FOREIGN KEY (user_id) REFERENCES user (id),
    ADD FOREIGN KEY (member_info_id) REFERENCES member_info (id);

ALTER TABLE `team_member`
    ADD FOREIGN KEY (team_id) REFERENCES team (id),
    ADD FOREIGN KEY (member_id) REFERENCES user_member (user_id);

ALTER TABLE `event`
    ADD FOREIGN KEY (status_id) REFERENCES status (id),
    ADD FOREIGN KEY (company_id) REFERENCES company_info (id),
    ADD FOREIGN KEY (business_field_id) REFERENCES business_field (id),
    ADD FOREIGN KEY (purpose_id) REFERENCES purpose (id);

ALTER TABLE `event_teams`
    ADD FOREIGN KEY (event_id) REFERENCES event (id),
    ADD FOREIGN KEY (team_id) REFERENCES team (id);



-- INSERTION

-- Inserting test data into the role table
INSERT INTO `role` (name)
VALUES ('Admin'),
       ('User');

-- Inserting test data into the business_field table
INSERT INTO `business_field` (name)
VALUES ('Technology'),
       ('Finance');

-- Inserting test data into the purpose table
INSERT INTO `purpose` (name)
VALUES ('Project'),
       ('Training');

-- Inserting test data into the status table
INSERT INTO `status` (name)
VALUES ('Pending'),
       ('Approved');



-- Inserting test data into the user table
INSERT INTO user (name, surname, email, password, registration_date, avatar_img, is_admin)
VALUES ('John', 'Doe', 'john.doe@example.com', 'password123', NOW(), 'avatar1.jpg', 0),
       ('Jane', 'Smith', 'jane.smith@example.com', 'password456', NOW(), 'avatar2.jpg', 1);


-- Inserting test data into the user_role table
INSERT INTO `user_role` (user_id, role_id)
VALUES (1, 1),
       (2, 2);


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
VALUES ('Event A', NOW(), 1, 1, 1, 'Venue A', 100, 1, 'Event A description', 1, 'cover1.jpg', '2 hours', 50),
       ('Event B', NOW(), 2, 2, 2, 'Venue B', 200, 2, 'Event B description', 2, 'cover2.jpg', '3 hours', 100);


-- Inserting test data into the event_teams table
INSERT INTO `event_teams` (event_id, team_id)
VALUES (1, 1),
       (2, 2);
