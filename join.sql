CREATE DATABASE db_kampus;

USE db_kampus;

CREATE TABLE jurusan (
    id_jurusan VARCHAR(20) PRIMARY KEY,
    nama_jurusan VARCHAR(100) NOT NULL
);

CREATE TABLE mahasiswa (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    id_jurusan VARCHAR(20),
    FOREIGN KEY (id_jurusan) REFERENCES jurusan(id_jurusan)
);

INSERT INTO jurusan (id_jurusan, nama_jurusan) 
VALUES 
('TI01', 'Teknik Informatika'),
('MN02', 'Manajemen'),
('DKV03', 'Desain Komunikasi Visual');
