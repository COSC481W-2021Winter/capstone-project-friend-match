<?php

$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);
if(!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = 'CREATE DATABASE `friend-match`;';

if(mysqli_query($conn, $sql)) {
  echo "Database has been created";
} else {
  echo "Error creating database: " . mysqli_error($conn);
}
mysqli_close($conn);

$dbname = "friend-match";

$conn = new mysqli($servername, $username, $password, $dbname);
if(!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = 'CREATE TABLE users (
    userid int(11) NOT NULL AUTO_INCREMENT,
    username varchar(256) NOT NULL,
    password varchar(256) NOT NULL,
    PRIMARY KEY(userid)
);

CREATE TABLE profiles (
    userid int(11) NOT NULL,
    firstName varchar(256) NOT NULL,
    lastName varchar(256) NOT NULL,
    city varchar(256) NOT NULL,
    bio varchar(512),
    interests varchar(512),
    PRIMARY KEY(userid),
    FOREIGN KEY (userid) REFERENCES users(userid)
);

CREATE TABLE matches (
    matchid int(11) NOT NULL,
    userid int(11) NOT NULL,
    likeid int(11) NOT NULL,
    PRIMARY KEY(matchid),
    FOREIGN KEY(userid) REFERENCES users(userid)
);

INSERT INTO users (username, password) VALUES ("testUser", "testPwd");
INSERT INTO profiles VALUES (1, "testFirst", "testLast", "testCity", "testBio", "testInterest");

-- Put your test users below these:
INSERT INTO users (username, password) VALUES ("iMadeApple", "ascii");
INSERT INTO profiles VALUES (2, "Steve", "Jobs", "testCity", "Steve Jobs, of Apple", "testInterest");
INSERT INTO users (username, password) VALUES ("babyDriver", "S3cur1tyIsMyP4ssi0n");
INSERT INTO profiles VALUES (3, "Baby", "Driver", "testCity", "Named after a movie", "testInterest");
INSERT INTO users (username, password) VALUES ("w3schools", "IsAGodSend");
INSERT INTO profiles VALUES (4, "W3", "Schools", "specifically not the test city", "Help me", "testInterest");
INSERT INTO users (username, password) VALUES ("rjohn100", "randolph");
INSERT INTO profiles VALUES (5, "Randolph", "Johnson", "testCity", "Just moved here, hoping to make some new friends", "testInterest");
INSERT INTO users (username, password) VALUES ("LineMean", "Password");
INSERT INTO profiles VALUES (6, "Emmaline", "Taylor", "City A", "Healing through Harmony", "Knitting_Reading_Hiking");
INSERT INTO users (username, password) VALUES ("JJameson", "1234");
INSERT INTO profiles VALUES (7, "Josiah", "Jameson", "testCity", "Not interested in pictures of Spiderman", "Knitting");
INSERT INTO users (username, password) VALUES ("TheBaker", "4321");
INSERT INTO profiles VALUES (8, "Ester", "Baker", "testCity", "Down to Clown", "Walking_Reading_Eating_Movies_Art");
INSERT INTO users (username, password) VALUES ("SeeMoreMe", "UnS3cur3P455w0rd");
INSERT INTO profiles VALUES (9, "Seymour", "Richards", "testCity", "Life is too short not to learn new things.", "Walking_Knitting_Reading_Eating_Snowboarding_Hiking_Boxing_Movies_Art");
INSERT INTO users (username, password) VALUES ("DaddyJoe", "sloppyJoe");
INSERT INTO profiles VALUES (10, "Joe", "Dadinstein", "Detroit", "Joe, father to 3 kids and looking for someone to talk about with them and meet other dads.", "Cooking_Cleaning_Shooting");
INSERT INTO users (username, password) VALUES ("Joemama", "supersloppyJoe");
INSERT INTO profiles VALUES (11, "Joe", "Murphey", "Seattle", "My name is Joe and I like cooking pizza. Im looking for people who share my interest, or are willing to have me teach them cooking, I love helping people learn new things.", "Cooking_Teaching");
INSERT INTO users (username, password) VALUES ("Dadbod", "beerAndfries");
INSERT INTO profiles VALUES (12, "Jesse", "Briet", "Richmond", "I enjoy drinking with friends and playing video games. Specifically I enjoy playing Europa Universalis 4 and Hearts of iron, and if we have enough people I enjoy Valorant.", "Games_Drinking_Running");
INSERT INTO users (username, password) VALUES ("babyshark", "dodododododo");
INSERT INTO profiles VALUES (13, "Kim", "Min", "Los Angeles", "I love traveling, sharing stories and going hiking. I enjoy exercising and encouraging my friends and I am looking for new people interested in that stuff!", "Hiking_");





';


if(mysqli_multi_query($conn, $sql)) {
  echo "Database has been populated correctly";
} else {
  echo "Error creating database: " . mysqli_error($conn);
}
mysqli_close($conn);

?>
