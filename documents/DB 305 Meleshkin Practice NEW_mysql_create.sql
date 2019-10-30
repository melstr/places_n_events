CREATE TABLE `users` (
	`user_id` INT(11) NOT NULL AUTO_INCREMENT,
	`login` varchar(100) NOT NULL UNIQUE,
	`password` varchar(32) NOT NULL,
	`first_name` varchar(100) NOT NULL,
	`second_name` varchar(100) NOT NULL,
	`middle_name` varchar(100) NOT NULL,
	`user_type` INT(1) NOT NULL,
	PRIMARY KEY (`user_id`)
);

CREATE TABLE `events` (
	`event_id` INT(11) NOT NULL AUTO_INCREMENT,
	`title` varchar(255) NOT NULL,
	`address` TEXT NOT NULL,
	`description` TEXT NOT NULL,
	`author_id` INT(11) NOT NULL,
	`pubdate` DATETIME NOT NULL,
	`views` INT NOT NULL,
	`event_type` INT(1) NOT NULL,
	`meeting_begin` DATETIME NOT NULL,
	`meeting_end` DATETIME NOT NULL,
	PRIMARY KEY (`event_id`)
);

CREATE TABLE `categories` (
	`category_id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	PRIMARY KEY (`category_id`)
);

CREATE TABLE `user_perms` (
	`id` INT(1) NOT NULL AUTO_INCREMENT,
	`type` varchar(20) NOT NULL,
	`description` TEXT NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `event_news` (
	`news_id` INT(11) NOT NULL AUTO_INCREMENT,
	`text` TEXT NOT NULL AUTO_INCREMENT,
	`pubdate` DATETIME NOT NULL,
	`views` INT NOT NULL,
	`event_id` INT(11) NOT NULL,
	PRIMARY KEY (`news_id`)
);

CREATE TABLE `event_news_comments` (
	`comment` INT(11) NOT NULL AUTO_INCREMENT,
	`text` TEXT NOT NULL AUTO_INCREMENT,
	`pubdate` DATETIME NOT NULL,
	`event_news_id` INT(11) NOT NULL,
	`author_id` INT(11) NOT NULL,
	PRIMARY KEY (`comment`)
);

CREATE TABLE `wanna_go` (
	`event_id` INT(11) NOT NULL,
	`user_id` INT(11) NOT NULL
);

CREATE TABLE `event_category` (
	`category_id` INT NOT NULL,
	`event_id` INT NOT NULL
);

ALTER TABLE `users` ADD CONSTRAINT `users_fk0` FOREIGN KEY (`user_type`) REFERENCES `user_perms`(`id`);

ALTER TABLE `events` ADD CONSTRAINT `events_fk0` FOREIGN KEY (`author_id`) REFERENCES `users`(`user_id`);

ALTER TABLE `event_news` ADD CONSTRAINT `event_news_fk0` FOREIGN KEY (`event_id`) REFERENCES `events`(`event_id`);

ALTER TABLE `event_news_comments` ADD CONSTRAINT `event_news_comments_fk0` FOREIGN KEY (`event_news_id`) REFERENCES `event_news`(`news_id`);

ALTER TABLE `event_news_comments` ADD CONSTRAINT `event_news_comments_fk1` FOREIGN KEY (`author_id`) REFERENCES `users`(`user_id`);

ALTER TABLE `wanna_go` ADD CONSTRAINT `wanna_go_fk0` FOREIGN KEY (`event_id`) REFERENCES `events`(`event_id`);

ALTER TABLE `wanna_go` ADD CONSTRAINT `wanna_go_fk1` FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`);

ALTER TABLE `event_category` ADD CONSTRAINT `event_category_fk0` FOREIGN KEY (`category_id`) REFERENCES `categories`(`category_id`);

ALTER TABLE `event_category` ADD CONSTRAINT `event_category_fk1` FOREIGN KEY (`event_id`) REFERENCES `events`(`event_id`);

