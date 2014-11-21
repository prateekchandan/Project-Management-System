drop table IF EXISTS working_on cascade;
drop table IF EXISTS skills cascade;
drop table IF EXISTS tagmap cascade;
drop table IF EXISTS project cascade;
drop table IF EXISTS  USERS cascade;
drop table IF EXISTS tags cascade;

create table USERS (
	userid varchar(100) primary key,
	name varchar(200) not null,
	password varchar(200) not null,
	roll_number varchar(100),
	phone varchar(50),
	email varchar(200) not null,
	institute varchar(400),
	type varchar(50) check (type in ('student','alumni','professor','other'))
);

create table project(
	project_id serial primary key,
	project_name varchar(500) not null,
	addedby varchar(100) not null,
	description text,
	detailed_description text,
	status varchar(50) check (status in ('completed','in progress','hold')) not null,
	foreign key (addedby) references USERS(userid) on delete cascade
);

create table tags(
	tagname varchar(200) primary key
);

create table tagmap(
	tagname varchar(200) not null,
	project_id int not null,
	requirement int DEFAULT 0,
	foreign key (tagname) references tags on delete cascade,
	foreign key (project_id) references project on delete cascade,
	primary key (project_id,tagname)
);

create table skills(
	userid varchar(100) not null,
	tagname varchar(200) not null,
	foreign key (userid) references USERS on delete cascade,
	foreign key (tagname) references tags on delete cascade,
	primary key (userid,tagname)
);

create table working_on(
	userid varchar(100) not null,
	project_id int not null,
	status varchar(50) check (status in ('completed','working','hold','applied')) not null,
	start_time timestamp,
	end_time date,
	remarks text,
	foreign key (project_id) references project on delete cascade,
	foreign key (userid) references USERS on delete cascade,
	primary key (userid,project_id)
);

insert into users values ('prateek','Prateek Chandan','1234','120050042','9619730024','prateekchandan5545@gmail.com','IIT Bombay','student');
insert into users values ('anurag','Anurag Shirolkar','1234','120050003','9730033780','ashirolkar47@gmail.com','IIT Bombay','student');
insert into users values ('jvs','JVS Shyam','120050052','1234','9769187071','shyam123.jvs95@gmail.com','IIT Bombay','student');
insert into users values ('nls','NL Sarda','1234','','','nls@cse.iitb.ac.in','IIT Bombay','professor');

insert into project values ('1','Project Management System','nls','Project Management system where students and professors from a particular institute or different institutes can list up the current projects they are working on or have previously worked upon or planning to work. The system will work as a platform where people can post requirements for their project and other people looking for some work opportunity can get a related work for themselves','','in progress');

insert into tags values ('C++');
insert into tags values ('java');
insert into tags values ('PostgreSQL');
insert into tags values ('HTML');
insert into tags values ('CSS');
insert into tags values ('JavaScript');

insert into tagmap values ('java','1');
insert into tagmap values ('PostgreSQL','1');
insert into tagmap values ('HTML','1');
insert into tagmap values ('CSS','1');
insert into tagmap values ('JavaScript','1');

insert into skills values ('prateek','java');
insert into skills values ('prateek','PostgreSQL');
insert into skills values ('prateek','HTML');
insert into skills values ('prateek','CSS');
insert into skills values ('prateek','JavaScript');
insert into skills values ('prateek','C++');

insert into skills values ('anurag','java');
insert into skills values ('anurag','PostgreSQL');
insert into skills values ('anurag','HTML');
insert into skills values ('anurag','CSS');
insert into skills values ('anurag','JavaScript');
insert into skills values ('anurag','C++');

insert into skills values ('jvs','java');
insert into skills values ('jvs','PostgreSQL');
insert into skills values ('jvs','HTML');
insert into skills values ('jvs','CSS');
insert into skills values ('jvs','JavaScript');
insert into skills values ('jvs','C++');

insert into skills values ('nls','java');
insert into skills values ('nls','PostgreSQL');
insert into skills values ('nls','HTML');
insert into skills values ('nls','CSS');
insert into skills values ('nls','JavaScript');
insert into skills values ('nls','C++');

insert into working_on values('prateek','1','working',current_timestamp,NULL,'');
insert into working_on values('anurag','1','working',current_timestamp,NULL,'');
insert into working_on values('jvs','1','working',current_timestamp,NULL,'');
