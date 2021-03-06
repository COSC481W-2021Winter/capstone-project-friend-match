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


';

if(mysqli_multi_query($conn, $sql)) {
  echo "Database has been populated correctly";
} else {
  echo "Error creating database: " . mysqli_error($conn);
}
mysqli_close($conn);

?>
