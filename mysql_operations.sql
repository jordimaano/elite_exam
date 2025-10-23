--command below executes the file. Should have a data_references database
--mysql -t -u <username> -p data_references < mysql_operations.sql

CREATE DATABASE IF NOT EXISTS data_references;

CREATE TABLE IF NOT EXISTS album_sales (
id INT AUTO_INCREMENT,
artist VARCHAR(100),
album VARCHAR(100),
2022_sales DECIMAL(10,2),
date_released DATE,
last_update DATE,
PRIMARY KEY (id)
);
--file path should be changed based on the location of the file
LOAD DATA INFILE 'C:\\laragon\\www\\elite_exam\\Data Reference (ALBUM SALES).csv' INTO TABLE album_sales
  FIELDS TERMINATED BY ',' ENCLOSED BY '"'
  LINES TERMINATED BY '\r\n'
  IGNORE 1 LINES
  (artist, album, 2022_sales, date_released, last_update);

--1. Display total number of albums sold per artist
SELECT artist, COUNT(album) FROM album_sales GROUP BY artist;

--2. Display combined album sales per artist
SELECT artist, SUM(2022_sales) FROM album_sales GROUP BY artist;

--3. Display the top 1 artist who sold most combined album sales
SELECT artist, SUM(2022_sales) AS total_album_sales FROM album_sales GROUP BY artist ORDER BY total_album_sales DESC LIMIT 1;

--4. Display the top 10 albums per year based on their number of sales
SELECT artist, SUM(2022_sales) AS total_album_sales FROM album_sales GROUP BY artist ORDER BY total_album_sales DESC LIMIT 10;

--5. Display list of albums based on the searched artist
SELECT DISTINCT album FROM album_sales WHERE artist="Monsta X";
 


