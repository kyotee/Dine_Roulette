CREATE TABLE user(
    username VARCHAR(12),
    firstname VARCHAR(12),
    lastname VARCHAR(12),
    email VARCHAR(40),
    password VARCHAR(50),
    active INT NOT NULL DEFAULT '0',
    datejoined DATE, 
    datesattended INT, 
    rating FLOAT,
    extremerestaurant FLOAT,
    accomplisheddares INT,
    invitername VARCHAR(12),
    invitation INT NOT NULL DEFAULT '0',
    suggestedrestaurant VARCHAR(25),
    acceptinvite INT NOT NULL DEFAULT '0',
    PRIMARY KEY (username)) ENGINE MyISAM;

CREATE TABLE restaurant(
    username1 VARCHAR(12) NOT NULL,
    id INT NOT NULL AUTO_INCREMENT,
    username2 VARCHAR(12),
    restaurantname VARCHAR(25),
    dateofmeet DATETIME,
    paid INT NOT NULL DEFAULT '0',
    ratingforusername2 FLOAT,
    excitingrestaurant FLOAT,
    dareforusername2 VARCHAR(150),
    PRIMARY KEY (username1,id)) ENGINE MyISAM;    

CREATE TABLE dines(
    username VARCHAR(12),
    username1 VARCHAR(12),
    PRIMARY KEY (username,username1),
    FOREIGN KEY (username)
         REFERENCES user,
    FOREIGN KEY (username1)
         REFERENCES restaurant) ENGINE MyISAM;