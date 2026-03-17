CREATE DATABASE IF NOT EXISTS games;

USE games;

CREATE USER 'buscador'@'localhost' IDENTIFIED BY '12345';
GRANT SELECT ON games.* TO 'buscador'@'localhost';
FLUSH PRIVILEGES;

CREATE TABLE steam_games (
    app_id INT PRIMARY KEY,
    app_name VARCHAR(255),
    developer_name VARCHAR(255),
    publisher_name VARCHAR(255),
    score_rank INT NULL,
    positive_reviews INT,
    negative_reviews INT,
    user_score INT,
    owners_range VARCHAR(50),
    avg_playtime_forever INT,
    avg_playtime_2weeks INT,
    median_playtime_forever INT,
    median_playtime_2weeks INT,
    current_price DECIMAL(10,2),
    initial_price DECIMAL(10,2),
    discount_percent DECIMAL(5,2),
    peak_concurrent_users INT
);

LOAD DATA INFILE 'C:/ProgramData/MySQL/MySQL Server 8.0/Uploads/steam_games_dataset.csv'
IGNORE
INTO TABLE steam_games
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(app_id, app_name, developer_name, publisher_name, @score_rank, positive_reviews, negative_reviews, user_score, owners_range, avg_playtime_forever, avg_playtime_2weeks, median_playtime_forever, median_playtime_2weeks, current_price, initial_price, discount_percent, peak_concurrent_users)
SET score_rank = NULLIF(@score_rank, '');