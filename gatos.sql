-- Crear y poblar tabla `gatos`
CREATE DATABASE IF NOT EXISTS mydb;
USE mydb;

DROP TABLE IF EXISTS gatos;
CREATE TABLE gatos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL
);

INSERT INTO gatos (nombre) VALUES
  ('Michi'),
  ('Naranjo'),
  ('Luna'),
  ('Simón');

SELECT * FROM gatos;
