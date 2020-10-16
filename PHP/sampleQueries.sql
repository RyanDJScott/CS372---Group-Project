CREATE TABLE Users (
    UID INT NOT NULL AUTO_INCREMENT,
    FirstName VARCHAR(20) NOT NULL,
    LastName VARCHAR(20) NOT NULL,
    Email VARCHAR(50) NOT NULL,
    Password VARCHAR(20) NOT NULL,
    PictureURL VARCHAR(30),
    ProfileBio TEXT,
    managerID INT,
    PRIMARY KEY (UID)
);

CREATE TABLE CPs (
    CPID INT NOT NULL AUTO_INCREMENT,
    UID INT,
    CodingLang VARCHAR(20) NOT NULL,
    PRIMARY KEY (CPID),
    FOREIGN KEY (UID) REFERENCES Users (UID) ON DELETE CASCADE
);

CREATE TABLE ProjectTeams (
    UID INT,
    PID INT,
    PRIMARY KEY (UID, PID),
    FOREIGN KEY (UID) REFERENCES Users (UID),
    FOREIGN KEY (PID) REFERENCES Projects (PID)
);

CREATE TABLE Projects (
    PID INT NOT NULL AUTO_INCREMENT,
    Title VARCHAR(30),
    Description TEXT,
    PRIMARY KEY (PID)
);

CREATE TABLE Tasks (
    TID INT NOT NULL AUTO_INCREMENT,
    UID INT,
    PID INT,
    TDescription TEXT NOT NULL,
    Deadline DATE NOT NULL,
    PRIMARY KEY (TID),
    FOREIGN KEY (UID) REFERENCES Users (UID) ON DELETE CASCADE,
    FOREIGN KEY (PID) REFERENCES Projects (PID) ON DELETE CASCADE
);

--<-----------Start Test Information------------->
--Ryan Scott, Manager
INSERT INTO Users (FirstName, LastName, Email, Password, PictureURL, ProfileBio, managerID)
VALUES ('Ryan', 'Scott', 'scott23r@uregina.ca', 'myHumps2020', 'ryanScottID.jpg', 'Hello! My name is Ryan Scott, and I am very excited to be working here at Devonian Software Development!', 1);

INSERT INTO CPs (UID, CodingLang)
VALUES (2, 'C++');

INSERT INTO CPs (UID, CodingLang)
VALUES (2, 'HTML');

INSERT INTO CPs (UID, CodingLang)
VALUES (2, 'CSS');

INSERT INTO CPs (UID, CodingLang)
VALUES (2, 'JavaScript');

INSERT INTO CPs (UID, CodingLang)
VALUES (2, 'PHP');

--Leanne Chung, fully filled out employee
INSERT INTO Users (FirstName, LastName, Email, Password, PictureURL, ProfileBio, managerID)
VALUES ('Leanne', 'Chung', 'leanne.chung@yahoo.ca', 'dilfDaddyFTW26', 'leanneChungID.jpg', 'My name is Leanne, and Im a recent hire here at the company! Im a non smoker who loves to laugh!', NULL);

INSERT INTO CPs (UID, CodingLang)
VALUES (3, 'C++');

INSERT INTO CPs (UID, CodingLang)
VALUES (3, 'Java');

INSERT INTO CPs (UID, CodingLang)
VALUES (3, 'JavaScript');

INSERT INTO CPs (UID, CodingLang)
VALUES (3, 'Python');

--Nathan Slaney, fully filled out employee
INSERT INTO Users (FirstName, LastName, Email, Password, PictureURL, ProfileBio, managerID)
VALUES ('Nathan', 'Slaney', 'nathanslaney@gmail.com', 'bigVULUPslut69', 'nathanSlaneyID.jpg', 'My name is Nathan and dont you dare look me in the face unless you plan on widening my slut circumference by 10 inches', NULL);

INSERT INTO CPs (UID, CodingLang)
VALUES (4, 'C#');

INSERT INTO CPs (UID, CodingLang)
VALUES (4, 'Java');

INSERT INTO CPs (UID, CodingLang)
VALUES (4, 'PROLOG');

INSERT INTO CPs (UID, CodingLang)
VALUES (4, 'FORTRAN');

--Red Shirt, partially filled out employee (no proficiencies yet)
INSERT INTO Users (FirstName, LastName, Email, Password)
VALUES ('Red', 'Shirt', 'redShirtGuy2020@gmail.com', 'gonnaDieFirst~!');

--Basic Biotch, partially filled out employee (no proficiencies yet)
INSERT INTO Users (FirstName, LastName, Email, Password)
VALUES ('Basic', 'Biotch', 'cantCodeKathy@hotmail.com', 'thankGodImPretty**!!');

--Project 1: CS372 Software Project
--Step 1: create basic project and get PID
INSERT INTO Projects (Title, Description)
VALUES ('CS372 Term Project', 'A project that was given to us by Tanzina and Nathan is very angry about it');

--Step 2: create team by inserting users into the project
--Manager: Ryan
--Team: Leanne, Nathan, Red Shirt
INSERT INTO ProjectTeams (PID, UID)
VALUES (1, 2);

INSERT INTO ProjectTeams (PID, UID)
VALUES (1, 3);

INSERT INTO ProjectTeams (PID, UID)
VALUES (1, 4);

INSERT INTO ProjectTeams (PID, UID)
VALUES (1, 5);

--Step 3: create tasks by tying tasks/project to a specific task
INSERT INTO Tasks (UID, PID, TDescription, Deadline)
VALUES (3, 1, 'Create the UI using your vast UI knowledge', '2020-10-15');
INSERT INTO Tasks (UID, PID, TDescription, Deadline)
VALUES (3, 1, 'Fiddle with the CSS sheet to make it look pretty', '2020-10-31');
INSERT INTO Tasks (UID, PID, TDescription, Deadline)
VALUES (3, 1, 'Tell Nathan to do his damn job!', '2020-09-01');

INSERT INTO Tasks (UID, PID, TDescription, Deadline)
VALUES (4, 1, 'Remember how to write JavaScript code', '2020-09-01');
INSERT INTO Tasks (UID, PID, TDescription, Deadline)
VALUES (4, 1, 'Validate user login page', '2020-10-16');
INSERT INTO Tasks (UID, PID, TDescription, Deadline)
VALUES (4, 1, 'Validate all other fields in the site', '2020-10-31');
INSERT INTO Tasks (UID, PID, TDescription, Deadline)
VALUES (4, 1, 'Help Ryan with AJAX', '2020-11-10');

INSERT INTO Tasks (UID, PID, TDescription, Deadline)
VALUES (5, 1, 'Try not to die today', '2020-12-31');

--<----------Start Sample Queries For Users Information--------------->
--1: On user login, return UID for the session 
--Get a managers info. Should return UID = 2 and managerID = 1
--Result: works
SELECT UID, managerID
FROM Users 
WHERE Email = 'scott23r@uregina.ca' AND Password = 'myHumps2020';

--Get a users info who is fully filled out; should return UID = 4 and managerID = NULL
--Result: works
SELECT UID, managerID
FROM Users
WHERE Email = 'nathanslaney@gmail.com' AND Password = 'bigVULUPslut69';

--Get a users info who is not fully filled out; should return UID = 6 and managerID = NULL
--Result: works
SELECT UID, managerID
FROM Users
WHERE Email = 'cantCodeKathy@hotmail.com' AND Password = 'thankGodImPretty**!!';

--Get a negative result by using a wrong password etc
--Result: works, empty set returned
SELECT UID, managerID
FROM Users
WHERE Email = 'ryan.dj.scott@gmail.com' AND Password = 'thankGodImPretty**!!';

--2: Upon user request (via editing their profile, coming up in a employee search), send ALL information
--Get all of a managers information (Ryan Scott, scott23r@uregina.ca, ryanScottID.jpg, profileBio, 1, coding proficiencies)
--Result: works, creates 5 tuples for each language. Could separate if we want.
SELECT Users.UID, FirstName, LastName, Email, PictureURL, ProfileBio, managerID, CodingLang
FROM Users LEFT JOIN CPs ON Users.UID = CPs.UID
WHERE Users.UID = 2;

--Get a employees information (Leanne Chung, leanne.chung@yahoo.ca, leanneChungID.jpg, profileBio, NULL)
--Result: works
SELECT Users.UID, FirstName, LastName, Email, PictureURL, ProfileBio, managerID, CodingLang
FROM Users LEFT JOIN CPs ON Users.UID = CPs.UID
WHERE Users.UID = 3;

--Get an employees information (Red Shirt, redShirtGuy2020@gmail.com, NULL, NULL, NULL)
--Result: works even when they have no coding proficiencies listed
SELECT Users.UID, FirstName, LastName, Email, PictureURL, ProfileBio, managerID, CodingLang
FROM Users LEFT JOIN CPs ON Users.UID = CPs.UID
WHERE Users.UID = 5;

--Get all employees information when going to the search page (all employees should show up)
--Result: works
SELECT Users.UID, FirstName, LastName, Email, PictureURL, ProfileBio, managerID, CodingLang
FROM Users LEFT JOIN CPs ON Users.UID = CPs.UID
WHERE Users.UID > 0;

--3: Find all users who have a specific coding proficiency (or set of proficiencies just incase)
--Get everyone who knows C++ (Ryan and Leanne)
--Result: works
SELECT Users.UID, FirstName, LastName, Email, PictureURL, ProfileBio, managerID
FROM Users LEFT JOIN CPs ON Users.UID = CPs.UID
WHERE CPs.CodingLang = 'C++';

--Get everyone who knows Java (Leanne and Nathan)
--Result: works
SELECT Users.UID, FirstName, LastName, Email, PictureURL, ProfileBio, managerID
FROM Users LEFT JOIN CPs ON Users.UID = CPs.UID
WHERE CPs.CodingLang = 'Java';

--Get everyone who knows FORTRAN (Nathan)
--Result: works
SELECT Users.UID, FirstName, LastName, Email, PictureURL, ProfileBio, managerID
FROM Users LEFT JOIN CPs ON Users.UID = CPs.UID
WHERE CPs.CodingLang = 'FORTRAN';

--Get everyone who knows LISP (Nobody)
--Result: works, empty set
SELECT Users.UID, FirstName, LastName, Email, PictureURL, ProfileBio, managerID
FROM Users LEFT JOIN CPs ON Users.UID = CPs.UID
WHERE CPs.CodingLang = 'LISP';

--<------------------Start Project Queries for Project Information------------------>
--Get all the information about the project that is needed to be displayed
--Results: works, even the manager who has no duties is displayed in the table.
SELECT Projects.Title, Projects.Description, Users.UID, Users.managerID, Users.FirstName, Users.LastName, Tasks.TDescription, Tasks.Deadline
FROM Projects INNER JOIN ProjectTeams ON Projects.PID = ProjectTeams.PID
INNER JOIN Users ON ProjectTeams.UID = Users.UID
LEFT JOIN Tasks ON ProjectTeams.UID = Tasks.UID
WHERE Projects.PID = 1;
