CREATE TABLE Movie (
    id int,
    title varchar(100),
    year int,
    rating varchar(10),
    company varchar(50),
    /*Every Movie has a unique id*/
    PRIMARY KEY(id)
) ENGINE=InnoDB;

CREATE TABLE Actor (
    id int,
    last varchar(20),
    first varchar(20),
    sex varchar(6),
    dob DATE,
    dod DATE,
    /*Every Actor has a unique id*/
    PRIMARY KEY(id)
) ENGINE=InnoDB;

CREATE TABLE Sales (
    mid int,
    ticketsSold int,
    totalIncome int,
    /*Every mid is references an id in the Movie table*/
    FOREIGN KEY (mid) REFERENCES Movie (id)
) ENGINE=InnoDB;

CREATE TABLE Director (
    id int,
    last varchar(20),
    first varchar(20),
    dob DATE,
    dod DATE,
    /*Every Director has a unique id*/
    PRIMARY KEY(id)
) ENGINE=InnoDB;

CREATE TABLE MovieGenre (
    mid int,
    genre varchar(20),
    /*Every mid references an id in the Movie table*/
    FOREIGN KEY (mid) REFERENCES Movie (id)
) ENGINE=InnoDB;

CREATE TABLE MovieDirector (
    mid int,
    did int,
    /*Every mid references an id in the Movie table*/
    FOREIGN KEY (mid) REFERENCES Movie (id),
    /*Every did references an id in the Director table*/
    FOREIGN KEY (did) REFERENCES Director (id)
) ENGINE=InnoDB;

CREATE TABLE MovieActor (
    mid int,
    aid int,
    role varchar(50),
    /*Every mid references an id in the Movie table*/
    FOREIGN KEY (mid) REFERENCES Movie (id),
    /*Every did references an id in the Actor table*/
    FOREIGN KEY (aid) REFERENCES Actor (id)
) ENGINE=InnoDB;

CREATE TABLE MovieRating (
    mid int,
    /*The highest possible imdb score is 100*/
    imdb int CHECK (imdb<=100),
    /*The highest possible rot score is 100*/
    rot int CHECK (rot<=100)
) ENGINE=InnoDB;

CREATE TABLE Review (
    name varchar(20),
    time TIMESTAMP,
    mid int,
    rating int CHECK (rating<=5),
    comment varchar(500)
) ENGINE=InnoDB;

CREATE TABLE MaxPersonID (
    id int
) ENGINE=InnoDB;

CREATE TABLE MaxMovieID (
    id int
) ENGINE=InnoDB;
