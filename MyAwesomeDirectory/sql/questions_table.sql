CREATE TABLE `Questions` (
		`user_id` int not null, 
		`category` varchar(50) not null,  
		`question` varchar(255) not null,
		`answer_id` int not null,
		`date_created` timestamp not null default current_timestamp,
                `date_modified` timestamp not null default current_timestamp on update current_timestamp,
		) 