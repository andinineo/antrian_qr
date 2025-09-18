-- create_db.sql
CREATE DATABASE IF NOT EXISTS db_antrian CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_antrian;

CREATE TABLE IF NOT EXISTS users (
  id_user INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','user') NOT NULL DEFAULT 'admin'
);

INSERT INTO users (username, password, role) VALUES
('admin', '$2y$10$z0r1c2LqvE1q6p9O1GQ3Iu0Yw8ZK8a3Vx2FzWZqHf6G5s1a2bC3e', 'admin'); 
-- password hash for "admin123" (you can change)

CREATE TABLE IF NOT EXISTS queue (
  id_queue INT AUTO_INCREMENT PRIMARY KEY,
  no_antrian INT NOT NULL,
  nama VARCHAR(100) DEFAULT NULL,
  loket VARCHAR(50) DEFAULT NULL,
  status ENUM('menunggu','dipanggil','selesai') NOT NULL DEFAULT 'menunggu',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);