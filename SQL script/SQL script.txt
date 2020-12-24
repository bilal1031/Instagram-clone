create database insta_db;
use insta_db;

create table users(
    username VARCHAR(25) PRIMARY KEY,
    password VARCHAR(25) NOT NULL,
    profile_name VARCHAR(25) NOT NULL,
    profile_picture BLOB,
    followings INT DEFAULT 0,
    followers INT DEFAULT 0,
    posts INT DEFAULT 0,
    email VARCHAR(50) NOT NULL,
    bio VARCHAR(1000),
    time_stamp DATETIME DEFAULT now()
);

CREATE TABLE posts (
	post_id INT PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(25),
	photo BLOB NOT NULL,
    description varchar(100),
	likes INT DEFAULT 0,
	comments INT DEFAULT 0,
    time_stamp DATETIME DEFAULT now(),
    
    FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE
);

CREATE TABLE followings (
	username VARCHAR(25) NOT NULL,
    following VARCHAR(25) NOT NULL,
    
    FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE,
    PRIMARY KEY (username, following)
);

CREATE TABLE likes(
	post_id INT NOT NULL,
	likername VARCHAR(25) NOT NULL,
	time_stamp DATETIME DEFAULT now(),
    
    FOREIGN KEY (post_id) REFERENCES posts(post_id) ON DELETE CASCADE    
);

CREATE TABLE comments(
	commentername VARCHAR(25) NOT NULL,
    comment_id INT PRIMARY KEY AUTO_INCREMENT,
    post_id INT NOT NULL, 
    comment_text varchar(100) NOT NULL,
    time_stamp DATETIME DEFAULT now(),
    
    FOREIGN KEY (post_id) REFERENCES posts(post_id) ON DELETE CASCADE
);

select * from users;
select * from posts;
select * from comments;
select * from likes;
select * from followings;
