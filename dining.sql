CREATE TABLE user(
    username VARCHAR(12),
    firstname VARCHAR(12),
    lastname VARCHAR(12),
    email VARCHAR(40),
    password VARCHAR(50), /*Verifyemail*/
    active INT NOT NULL DEFAULT '0',
    datejoined DATE, 
    datesattended INT, 
    rating FLOAT,
    invitername VARCHAR(12),
    invitation INT NOT NULL DEFAULT '0',
    suggestedrestaurant VARCHAR(25),
    PRIMARY KEY (username)) ENGINE MyISAM;

CREATE TABLE restaurant(
    username1 VARCHAR(12) NOT NULL,
    id INT NOT NULL AUTO_INCREMENT,
    username2 VARCHAR(12),
    restaurantname VARCHAR(25),
    commentsforusername1 VARCHAR(50),
    paid INT NOT NULL DEFAULT '0',
    ratingforusername1 INT (11),
    seen INT NOT NULL DEFAULT '0',
    PRIMARY KEY (username1,id)) ENGINE MyISAM;    

CREATE TABLE dines(
    username VARCHAR(12),
    username1 VARCHAR(12),
    id INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (username,username1,id),
    FOREIGN KEY (username)
         REFERENCES user,
    FOREIGN KEY (username1,id)
         REFERENCES restaurant) ENGINE MyISAM;