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
    `is_occupy` tinyint(2) not null default '0' comment 'is_occupy',
	`create_time` datetime not null default '0000-00-00 00:00' comment 'create_time',
	`update_time` datetime not null default '0000-00-00 00:00' comment 'update_time',
	`is_del` tinyint(2) not null default '0' comment '1 is del',
	primary key (`id`)
)ENGINE=InnoDB DEFAULT CHARSET='utf8' comment='resource';

create table `history`(
	`id` int(11) unsigned not null auto_increment comment 'id',
	`resource_id` int(11) unsigned not null default '0' comment 'resource_id',
	`user_id` int(11) unsigned not null default '0' comment 'user_id',
	`month_num` int(11) unsigned not null default '0' comment 'use_month_num',
	`util_time` datetime not null default '0000-00-00 00:00' comment 'util_time',
	`create_time` datetime not null default '0000-00-00 00:00' comment 'create_time',
	`update_time` datetime not null default '0000-00-00 00:00' comment 'update-time',
	`is_del` tinyint(2) not null default '0' comment '1 is del',
	primary key (`id`)
)ENGINE=InnoDB DEFAULT CHARSET='utf8' comment='history';
