## STRUCTURE ################################################
CREATE TABLE user(
    userId INT(11) not null auto_increment,
    username varchar(255) default null,
    password varchar(255) default null,
    PRIMARY KEY(userId)
);

CREATE TABLE topic(
    topicId INT(11) not null auto_increment,
    title varchar(255) default null,
    created_at timestamp default CURRENT_TIMESTAMP,
    userId INT(11) not null,
    PRIMARY KEY(topicId)
);

CREATE TABLE message(
    messageId INT(11) not null auto_increment,
    body blob default null,
    created_at timestamp default CURRENT_TIMESTAMP,
    topicId INT(11) default null,
    userId INT(11) default null,
    PRIMARY KEY(messageId)
);


## DATA ################################################

INSERT INTO user VALUES (1,'user1','user1');
INSERT INTO user VALUES (2,'user2','user2');
INSERT INTO user VALUES (3,'user3','user3');
INSERT INTO user VALUES (4,'user4','user4');

INSERT INTO topic VALUES (1,'Topic 1','2020-01-02 15:30:01',1);
INSERT INTO topic VALUES (2,'Topic 2','2020-01-03 13:10:04',2);
INSERT INTO topic VALUES (3,'Topic 3','2020-01-05 04:14:24',3);
INSERT INTO topic VALUES (4,'Topic 4','2020-01-09 18:01:29',3);
INSERT INTO topic VALUES (5,'Topic 5','2020-01-14 20:52:52',4);
INSERT INTO topic VALUES (6,'Topic 6','2020-01-20 01:44:32',2);
INSERT INTO topic VALUES (7,'Topic 7','2020-02-01 12:31:04',1);
INSERT INTO topic VALUES (8,'Topic 8','2020-02-02 11:49:08',3);
INSERT INTO topic VALUES (9,'Topic 9','2020-02-08 19:28:23',1);
INSERT INTO topic VALUES (10,'My wonderful topic','2020-03-12 23:27:20',4);
INSERT INTO topic VALUES (11,'Topic 11','2020-03-12 22:30:18',4);
INSERT INTO topic VALUES (12,'Topic 12','2020-04-15 01:10:11',1);
INSERT INTO topic VALUES (13,'Topic 13','2020-04-18 20:14:02',2);
INSERT INTO topic VALUES (14,'Topic 14','2020-04-22 05:01:40',3);
INSERT INTO topic VALUES (15,'Topic 15','2020-04-25 07:10:59',4);
INSERT INTO topic VALUES (16,'Topic 16','2020-05-03 09:30:52',4);
INSERT INTO topic VALUES (17,'Topic 17','2020-05-06 11:14:37',4);
INSERT INTO topic VALUES (18,'Topic 18','2020-05-07 10:30:20',3);
INSERT INTO topic VALUES (19,'Topic 19','2020-06-08 12:10:19',1);
INSERT INTO topic VALUES (20,'Topic 20','2020-06-15 15:52:53',2);
INSERT INTO topic VALUES (21,'Topic 21','2020-06-17 02:14:24',2);
INSERT INTO topic VALUES (22,'Topic 22','2020-06-20 02:10:52',1);
INSERT INTO topic VALUES (23,'Topic 23','2020-06-26 16:44:21',1);
INSERT INTO topic VALUES (24,'Topic 24','2020-07-01 14:31:04',4);
INSERT INTO topic VALUES (25,'Topic 25','2020-07-01 21:10:42',3);
INSERT INTO topic VALUES (26,'Topic 26','2020-07-07 23:14:45',2);
INSERT INTO topic VALUES (27,'Topic 27','2020-07-08 00:49:55',1);
INSERT INTO topic VALUES (28,'Topic 28','2020-07-08 18:27:09',3);

INSERT INTO message VALUES (1,'Message 1 for Topic 1','2020-07-08 18:30:21',28,1);
INSERT INTO message VALUES (2,'Message 2 for Topic 1','2020-07-08 18:35:53',28,1);
INSERT INTO message VALUES (3,'Message 3 for Topic 1','2020-07-08 18:52:11',28,1);
INSERT INTO message VALUES (4,'Message 4 for Topic 1','2020-07-08 18:59:25',28,1);

INSERT INTO message VALUES (5,'Message 1 for My wonderful topic ','2020-03-12 23:30:21',10,4);
INSERT INTO message VALUES (6,'Message 2 for My wonderful topic','2020-03-12 23:35:53',10,3);
INSERT INTO message VALUES (7,'Message 3 for My wonderful topic','2020-03-12 23:52:11',10,1);
INSERT INTO message VALUES (8,'Message 4 for My wonderful topic','2020-03-12 23:59:25',10,2);
INSERT INTO message VALUES (9,'Message 5 for My wonderful topic','2020-03-13 00:30:21',10,1);
INSERT INTO message VALUES (10,'Message 6 for My wonderful topic','2020-03-13 00:35:53',10,4);
INSERT INTO message VALUES (11,'Message 7 for My wonderful topic','2020-03-13 00:52:11',10,2);
INSERT INTO message VALUES (12,'Message 8 for My wonderful topic','2020-03-13 00:59:25',10,1);
INSERT INTO message VALUES (13,'Message 9 for My wonderful topic','2020-03-14 13:30:21',10,4);
INSERT INTO message VALUES (14,'Message 10 for My wonderful topic','2020-03-14 19:35:53',10,3);
INSERT INTO message VALUES (15,'Message 11 for My wonderful topic','2020-03-14 20:52:11',10,1);
INSERT INTO message VALUES (16,'Message 12 for My wonderful topic','2020-03-14 22:59:25',10,2);
INSERT INTO message VALUES (17,'Message 13 for My wonderful topic','2020-03-18 05:30:21',10,1);
INSERT INTO message VALUES (18,'Message 14 for My wonderful topic','2020-03-19 09:35:53',10,4);
INSERT INTO message VALUES (19,'Message 15 for My wonderful topic','2020-03-20 14:52:11',10,2);
INSERT INTO message VALUES (20,'Message 16 for My wonderful topic','2020-03-20 12:59:25',10,1);
INSERT INTO message VALUES (21,'Message 17 for My wonderful topic','2020-03-26 07:52:11',10,2);
INSERT INTO message VALUES (22,'Message 18 for My wonderful topic','2020-03-28 20:59:25',10,1);






