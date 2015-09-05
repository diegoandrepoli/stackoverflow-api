-- crate database app
CREATE DATABASE app;

-- create database questions
CREATE TABLE questions(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	question_id varchar(700),
	last_update varchar(700),	
	title  varchar(700),	
	owner_name  varchar(700),	
	score  varchar(700),	
	creation_date  varchar(700),	
	link  varchar(700),	
	is_answered  varchar(700)
);