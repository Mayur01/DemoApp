CREATE DATABASE IF NOT EXISTS user_db;

USE user_db;

CREATE TABLE IF NOT EXISTS users (
  email VARCHAR(30),
  password VARCHAR(30),
  PRIMARY_KEY(email)
);
