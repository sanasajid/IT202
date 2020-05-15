CREATE TABLE `Answers` (
	`id` int auto_increment not null,
	`user_id` int not null,
	`poll_id` int not null,
	`answer_text` varchar(255) not null,
	`date_created` timestamp not null default current_timestamp,
        `date_modified` timestamp not null default current_timestamp on update current_timestamp,
	PRIMARY KEY (`id`)
	)  
	