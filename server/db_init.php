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
    photo varchar(256),
    PRIMARY KEY(userid),
    FOREIGN KEY (userid) REFERENCES users(userid)
);

CREATE TABLE matches (
    matchid int(11) NOT NULL AUTO_INCREMENT,
    userid int(11) NOT NULL,
    likeid int(11) NOT NULL,
    likeStatus boolean NOT NULL,
    PRIMARY KEY(matchid),
    FOREIGN KEY(userid) REFERENCES users(userid)
);

INSERT INTO users (username, password) VALUES ("testUser", "' . password_hash("testPwd", PASSWORD_DEFAULT) . '");
INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES (1, "testFirst", "testLast", "testCity", "testBio", "testInterest_");

-- Put your test users below these:
INSERT INTO users (username, password) VALUES ("iMadeApple", "' . password_hash("ascii", PASSWORD_DEFAULT) . '");
INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES (2, "Steve", "Jobs", "testCity", "Steve Jobs, of Apple", "testInterest_");
INSERT INTO users (username, password) VALUES ("babyDriver", "' . password_hash("S3cur1tyIsMyP4ssi0n", PASSWORD_DEFAULT) . '");
INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES (3, "Baby", "Driver", "testCity", "Named after a movie", "testInterest_");
INSERT INTO users (username, password) VALUES ("w3schools", "' . password_hash("IsAGodSend", PASSWORD_DEFAULT) . '");
INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES (4, "W3", "Schools", "specifically not the test city", "Help me", "testInterest_");
INSERT INTO users (username, password) VALUES ("rjohn100", "' . password_hash("randolph", PASSWORD_DEFAULT) . '");
INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES (5, "Randolph", "Johnson", "testCity", "Just moved here, hoping to make some new friends", "testInterest_");
INSERT INTO users (username, password) VALUES ("LineMean", "' . password_hash("Password", PASSWORD_DEFAULT) . '");
INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES (6, "Emmaline", "Taylor", "City A", "Healing through Harmony", "Knitting_Reading_Hiking");
INSERT INTO users (username, password) VALUES ("JJameson", "' . password_hash("1234", PASSWORD_DEFAULT) . '");
INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES (7, "Josiah", "Jameson", "testCity", "Not interested in pictures of Spiderman", "Knitting_");
INSERT INTO users (username, password) VALUES ("TheBaker", "' . password_hash("4321", PASSWORD_DEFAULT) . '");
INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES (8, "Ester", "Baker", "testCity", "Down to Clown", "Walking_Reading_Eating_Movies_Art");
INSERT INTO users (username, password) VALUES ("SeeMoreMe", "' . password_hash("UnS3cur3P455w0rd", PASSWORD_DEFAULT) . '");
INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES (9, "Seymour", "Richards", "testCity", "Life is too short not to learn new things.", "Walking_Knitting_Reading_Eating_Snowboarding_Hiking_Boxing_Movies_Art");
INSERT INTO users (username, password) VALUES ("DaddyJoe", "' . password_hash("sloppyJoe", PASSWORD_DEFAULT) . '");
INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES (10, "Joe", "Dadinstein", "Detroit", "Joe, father to 3 kids and looking for someone to talk about with them and meet other dads.", "Cooking_Cleaning_Shooting");
INSERT INTO users (username, password) VALUES ("Joemama", "' . password_hash("supersloppyJoe", PASSWORD_DEFAULT) . '");
INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES (11, "Joe", "Murphey", "Seattle", "My name is Joe and I like cooking pizza. Im looking for people who share my interest, or are willing to have me teach them cooking, I love helping people learn new things.", "Cooking_Teaching");
INSERT INTO users (username, password) VALUES ("Dadbod", "' . password_hash("beerAndfries", PASSWORD_DEFAULT) . '");
INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES (12, "Jesse", "Briet", "Richmond", "I enjoy drinking with friends and playing video games. Specifically I enjoy playing Europa Universalis 4 and Hearts of iron, and if we have enough people I enjoy Valorant.", "Games_Drinking_Running");
INSERT INTO users (username, password) VALUES ("babyshark", "' . password_hash("dodododododo", PASSWORD_DEFAULT) . '");
INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES (13, "Kim", "Min", "Los Angeles", "I love traveling, sharing stories and going hiking. I enjoy exercising and encouraging my friends and I am looking for new people interested in that stuff!", "Hiking_running_storytelling");
INSERT INTO users (username, password) VALUES("JeffJeff", "' . password_hash("Jefferson", PASSWORD_DEFAULT) . '");
INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES (14, "Jeffery", "Jefferson", "Detroit", "My name is Jeff.", "gaming_lifting_water-polo");
INSERT INTO users (username, password) VALUES("BepisMan", "' . password_hash("CokeSucks420", PASSWORD_DEFAULT) . '");
INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES (15, "Cherry", "Pepsi", "Fresno", "I am a can of soda. I dont get out very often.", "drinking_chilling");
INSERT INTO users (username, password) VALUES("Spin2Win", "' . password_hash("YouSpinMeRightRoundBaby", PASSWORD_DEFAULT) . '");
INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES (16, "Hard", "Drive", "San Jose", "I am a Hard Drive. Look, data!", "reading_writing_improv-comedy");
INSERT INTO users (username, password) VALUES("LargeAndInCharge", "' . password_hash("burritoMaster123", PASSWORD_DEFAULT) . '");
INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES (17, "Hue", "Mongous", "Juneau", "I am Hue Mongous. I am very large. I enjoy movies and boardgames.", "board-games_eating_movies");
INSERT INTO users (username, password) VALUES ("z", "' . password_hash("z", PASSWORD_DEFAULT) . '");
INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES (18, "z", "z", "z", "zzzz", "z_");
INSERT INTO users (username, password) VALUES ("Davvv", "' . password_hash("qwerty", PASSWORD_DEFAULT) . '");
INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES (19, "Davey", "Daverson", "Davidland", "Davy\'s the name dav tha game", "daves_");
INSERT INTO users (username, password) VALUES ("uwubean", "' . password_hash("god", PASSWORD_DEFAULT) . '");
INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES (20, "Thoth", "UwU", "Hell", "Ra Ra Rasputin Russias smollest uwu bean", "Chaos_");
INSERT INTO users (username, password) VALUES ("tomato", "' . password_hash("tomatoSauce", PASSWORD_DEFAULT) . '");
INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES (21, "Meatbally", "spagettis", "Italy", "Angry Pasta nosies", "Germany_");
INSERT INTO users (username, password) VALUES ("peterpan", "' . password_hash("imalwaysyoung2", PASSWORD_DEFAULT) . '");
INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES (22, "Peter", "Pan", "Neverland", "Captain crunch is very scary i dont like that guy", "tinkerbell_");
INSERT INTO users (username, password) VALUES ("sgtBearjew", "' . password_hash("hanslandasmells1942", PASSWORD_DEFAULT) . '");
INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES (23, "Donny", "Donowitz", "Berlin", "he went yardo on that one, fenway on its feet", "baseball_");
INSERT INTO users (username, password) VALUES ("nmeade", "' . password_hash("sgvelocity", PASSWORD_DEFAULT) . '");
INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES (24, "Nicholas", "Meade", "Maple Meadeway", "nnnyeah", "racing_");
INSERT INTO users (username, password) VALUES ("MgodC", "' . password_hash("pastaisnice1972", PASSWORD_DEFAULT) . '");
INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES (25, "Michael", "Corleone", "Italy", "just when i thought i was out, they pull me BACK in", "whacking_");


INSERT INTO matches (userid, likeid) VALUES(1, 2);
INSERT INTO matches (userid, likeid) VALUES(2, 1);


';

if(mysqli_multi_query($conn, $sql)) {
  echo "Database has been populated correctly";
} else {
  echo "Error populating database: " . mysqli_error($conn);
}



mysqli_close($conn);

?>
