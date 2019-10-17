create table Student(
tid integer AUTO_INCREMENT PRIMARY KEY,
loginid varchar(15),
lastname varchar(40),
firstname varchar(40),
token varchar(40),
deleted boolean);

create table Professor(
tid integer AUTO_INCREMENT PRIMARY KEY,
loginid varchar(15),
title varchar(24),
lastname varchar(40),
firstname varchar(40),
token varchar(40),
deleted boolean);

create table Course(
tid integer AUTO_INCREMENT PRIMARY KEY,
courseid varchar(40),
coursename varchar(40),
deleted boolean);

create table Section(
tid integer AUTO_INCREMENT PRIMARY KEY,
courseid integer,
professorid integer,
section integer,
FOREIGN KEY(professorid) references Professor(tid),
FOREIGN KEY(courseid) references Course(tid),
deleted boolean);

create table Roll(
tid integer AUTO_INCREMENT PRIMARY KEY,
sectionid integer,
studentid integer,
FOREIGN KEY(sectionid) references Section(tid),
FOREIGN KEY(studentid) references Student(tid),
deleted boolean);

create table Login(
tid integer AUTO_INCREMENT PRIMARY KEY,
rollid integer,
ipaddress varchar(24),
latitude float,
longitude float,
verifycode varchar(40),
logindate datetime,
result integer,
token varchar(40),
FOREIGN KEY(rollid) references Roll(tid),
deleted boolean);

create table Verify(
tid integer AUTO_INCREMENT PRIMARY KEY,
sectionid integer,
verifycode varchar(40),
datetimeset datetime,
token varchar(40),
FOREIGN KEY(sectionid) references Section(tid),
deleted boolean);

create table SetCourse(
tid integer AUTO_INCREMENT PRIMARY KEY,
sectionid integer,
professorid integer,
classset datetime,
verifycode varchar(40),
FOREIGN KEY(sectionid) references Section(tid),
FOREIGN KEY(professorid) references Professor(tid),
deleted boolean);

