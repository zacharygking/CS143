/*This violates the schema by attempting to have 2 of the same
values for id in Movie, which is a primary key so much be unique*/
INSERT INTO Movie VALUES (2, 'foobar', 1776, 'PG', 'foobar');
INSERT INTO Movie VALUES (2, 'barfoo', 1776, 'G', 'foobar');
/*ERROR 1062 (23000) at line 4: Duplicate entry '2' for key 'PRIMARY'*/

/*This violates the schema by attempting to have 2 of the same
values for id in Actor, which is a primary key so much be unique*/
INSERT INTO Actor VALUES (2, 'foo', 'bar', 'M', NULL, NULL);
INSERT INTO Actor VALUES (2, 'bar', 'bar', 'M', NULL, NULL);
/*ERROR 1062 (23000) at line 11: Duplicate entry '2' for key 'PRIMARY'*/

/*This violates the schema by attempting to have 2 of the same
values for id in Movie, which is a primary key so much be unique*/
INSERT INTO Director VALUES (1, 'foo', 'bar', NULL, NULL);
INSERT INTO Director VALUES (1, 'bar', 'bar', NULL, NULL);
/*ERROR 1062 (23000) at line 17: Duplicate entry '1' for key 'PRIMARY'*/

/*This violates the foreign key constraint set from the mid in the Sales table to id in the Movie table*/
INSERT INTO Sales VALUES (1, 0, 0);
/*ERROR 1452 (23000) at line 20: Cannot add or update a child row: a foreign key constraint fails
(`TEST`.`Sales`, CONSTRAINT `Sales_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))*/

/*This violates the foreign key constraint set from the mid in the MovieGenre table to id in the Movie table*/
INSERT INTO MovieGenre VALUES (1, 'foobar');
/*ERROR 1452 (23000) at line 24: Cannot add or update a child row: a foreign key constraint fails
(`TEST`.`MovieGenre`, CONSTRAINT `MovieGenre_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))*/

/*This violates the foreign key constraint set from the mid in the MovieDirector table to id in the Movie table*/
INSERT INTO MovieDirector VALUES (1, 16);
/*ERROR 1452 (23000) at line 28: Cannot add or update a child row: a foreign key constraint fails
(`TEST`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))*/

/*This violates the foreign key constraint set from the did in the MovieDirector table to id in the Director table*/
INSERT INTO MovieDirector VALUES (2, 0);
/*ERROR 1452 (23000) at line 32: Cannot add or update a child row: a foreign key constraint fails
(`TEST`.`MovieGenre`, CONSTRAINT `MovieGenre_ibfk_2` FOREIGN KEY (`did`) REFERENCES `Director` (`id`))*/

/*This violates the foreign key constraint set from the mid in the MovieActor table to id in the Movie table*/
INSERT INTO MovieActor VALUES (1, 16, 'foo');
/*ERROR 1452 (23000) at line 36: Cannot add or update a child row: a foreign key constraint fails
(`TEST`.`MovieActor`, CONSTRAINT `MovieDirector_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))*/

/*This violates the foreign key constraint set from the aid in the MovieActor table to id in the Actortable*/
INSERT INTO MovieActor VALUES (2, 0, 'foo');
/*ERROR 1452 (23000) at line 40: Cannot add or update a child row: a foreign key constraint fails
(`TEST`.`MovieGenre`, CONSTRAINT `MovieActor_ibfk_2` FOREIGN KEY (`aid`) REFERENCES `Actor` (`id`))*/


INSERT INTO MovieRating VALUES (2, 101, 50);
/* Breaks the CHECK statement on the imdb column of MovieRating (must be less than 101) */
INSERT INTO MovieRating VALUES (2, 50, 101);
/* Breaks the CHECK statement on the rot column of MovieRating (must be less than 101) */
INSERT INTO Review VALUES ('foo bar', NULL, 2, 6, 'bar foo');
/* Breaks the CHECK statement on the rating column of Review (must be less than 6) */