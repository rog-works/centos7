create database test DEFAULT CHARACTER SET utf8;

use test;

create table user(
  id int(11) unsigned not null auto_increment,
  name varchar(32) not null,
  primary key (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into user values (1, 'hoge'), (2, 'fuga'), (3, 'piyo');
