# sql isntall


create database if not exists demo;

use demo;

create table if not exists de_cat (
    id bigint auto_increment primary key,
    kod varchar(20) charset utf8,
    nev varchar(80) charset utf8,
    key name (nev(20))
) engine=InnoDB default charset latin1;

create table if not exists de_param (
    id bigint auto_increment primary key,
    kod varchar(20) charset utf8,
    key name (kod(20))
) engine=InnoDB default charset latin1;
