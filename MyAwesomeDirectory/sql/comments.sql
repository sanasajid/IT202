CREATE TABLE `Comments` (
	`id` int auto_increment not null,  
	`comments_string'` varchar(255) not null,
	`poll_id` int not null, 
	`date_created` timestamp not null default current_timestamp,
        `date_modified` timestamp not null default current_timestamp on update current_timestamp,
	PRIMARY KEY (`id`)
)

