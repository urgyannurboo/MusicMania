#CREATE DATABASE musicmania;
USE musicmania;
CREATE TABLE songs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    song_name VARCHAR(100),
    file_path VARCHAR(100),
    cover_path VARCHAR(100),
    category_id INT
);
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100)
);
INSERT INTO songs (song_name, file_path, cover_path, category_id) VALUES ('Rangisari', 'songs/1.mp3', 'covers/rangisari_cover.jpg', 1);
