CREATE DATABASE phpfileapi;
use phpfileapi;

CREATE TABLE users(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nickname VARCHAR(16) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(512) NOT NULL
);