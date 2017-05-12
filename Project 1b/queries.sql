/* Gives Names of all the actors appearing in 'Die Another Day' */
SELECT CONCAT(Actor.first, ' ', Actor.last) as 'Actors Appearing in Die Another Day:'
FROM Actor, Movie, MovieActor
WHERE Movie.title = 'Die Another Day'
AND MovieActor.mid = Movie.id
AND Actor.id = MovieActor.aid;

/* Gives the count of number of actors who appear in multiple films */
SELECT COUNT(*) as 'Number of Actors Appearing in Multiple Films:'
FROM (
    SELECT aid, COUNT(*)
    FROM MovieActor
    GROUP BY aid
    HAVING COUNT(*) > 1
) sub;

/* Gives the Titles of Movies That Sold More than 1,000,000 Tickets */
SELECT Movie.title as 'Titles of Movies That Sold More Than 1,000,000 Tickets:'
FROM Movie, Sales
WHERE Movie.id=Sales.mid
AND Sales.ticketsSold > 1000000;

/* Gives the names of actors who appear in multiple films and the number of films that they've appeared in */
SELECT CONCAT(first, ' ', last, ': ', count) as 'Actors Appearing in More Than 2 Films and the Number They Have Appeared in:'
FROM Actor, (
    SELECT aid, COUNT(*) as count
    FROM MovieActor
    GROUP BY aid
    HAVING COUNT(*) > 1
) sub
WHERE Actor.id=sub.aid;

/* Gives the names of Actors who appeared in movies that have both an IMDB and ROT Score > 96 */
Select CONCAT(first, ' ', last) as 'Actors in Movies with both an IMDB and ROT Score > 96:'
FROM Actor, MovieActor,(
    Select Movie.id
    From Movie, MovieRating
    WHERE MovieRating.imdb > 96
    AND MovieRating.rot > 96
    AND MovieRating.mid=Movie.id
) movies
WHERE movies.id=MovieActor.mid 
AND Actor.id=MovieActor.aid;


