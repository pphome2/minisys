# sql isntall

create database if not exists minifw;

use minifw;

create table if not exists mfw_users (
    id bigint unsigned auto_increment primary key,
    name varchar(40) charset utf8,
    pass varchar(255) charset utf8,
    role varchar(40) charset utf8,
    email varchar(80) charset utf8,
    comm  varchar(255) charset utf8,
    key name (name(20))
) engine=InnoDB default charset latin1;

create table if not exists mfw_params (
    id bigint unsigned auto_increment primary key,
    name varchar(20) charset utf8,
    data varchar(80) charset utf8,
    key name (name(20))
) engine=InnoDB default charset latin1;

replace into mfw_users (id, name, pass, role, email, comm) values (1, "admin", "$2y$10$EFa7AbDm9E79X9EmKBMxTeVNkIcXvj1ieeEAx/v4a54Dl5vyZXvSi", "0", "", "");

