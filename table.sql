create table `user`(
	`id` int(11) unsigned not null auto_increment comment 'id',
	`username` varchar(128) not null default '' comment 'username',
	`password` varchar(128) not null default '' comment 'password',
	`type` tinyint(4) not null default '0' comment 'user type 1.normal 2.admin',
	`create_time` datetime not null default '0000-00-00 00:00' comment 'create_time',
	`update_time` datetime not null default '0000-00-00 00:00' comment 'update_time',
	`is_del` tinyint(2) not null default '0' comment '1. is del',
	primary key (`id`)
)ENGINE=InnoDB DEFAULT CHARSET='utf8' comment='user';

create table `resource`(
	`id` int(11) unsigned not null auto_increment comment 'id',
	`host_name` varchar(128) not null default '' comment 'host',
	`detail` varchar(1024) not null default '' comment 'detail',
	`price` float(5,2) not null default '0.00' comment 'price yuan/month',
	`user_id` int(11) unsigned not null default '0' comment 'user_id',
	`create_time` datetime not null default '0000-00-00 00:00' comment 'create_time',
	`update_time` datetime not null default '0000-00-00 00:00' comment 'update_time',
	`is_del` tinyint(2) not null default '0' comment '1 is del',
	primary key (`id`)
)ENGINE=InnoDB DEFAULT CHARSET='utf8' comment='resource';
