--framework for SP
/*
DELIMITER $$

CREATE PROCEDURE name(
    IN var1 varchar(15),
    IN var2 varchar(40),
    IN var3 integer,
    IN fn float,
)

BEGIN
    COMMAND Table(field1, field2, field3, field4)
    VALUES (var1, var2, var3,var4);
    SELECT return_info --LAST_INSERT_ID() object from table, etc;
END $$

DELIMITER ;
--End
*/

DELIMITER $$

CREATE PROCEDURE addStudent(
    IN _loginid varchar(15),
    IN _lastname varchar(40),
    IN _firstname varchar (40),
    IN _token varchar(40)
)

BEGIN
    INSERT INTO Student(loginid, lastname, firstname, token)
    VALUES (_loginid, _lastname, _firstname, _token);
    SELECT LAST_INSERT_ID();
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE addProfessor(
    IN _loginid varchar(15),
    IN _title varchar(24),
    IN _lastname varchar(40),
    IN _firstname varchar (40),
    IN _token varchar(40)
)

BEGIN
    INSERT INTO Professor(loginid, title, lastname, firstname, token)
    VALUES (_loginid, _title, _lastname, _firstname, _token);
    SELECT LAST_INSERT_ID();
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE getStudentByTid(
    IN _tid integer
)

BEGIN
    SELECT loginid, lastname, firstname, token from Student
    WHERE tid = _tid;
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE getStudentByLoginid(
    IN _loginid varchar(40)
)

BEGIN
    SELECT tid, loginid, lastname, firstname, token from Student
    WHERE loginid = _loginid
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE getProfessorByTid(
    IN _tid integer
)

BEGIN
    SELECT loginid, title, lastname, firstname, token from Professor
    WHERE tid = _tid;
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE getProfessorByLoginid(
    IN _loginid varchar(40)
)

BEGIN
    SELECT tid, loginid, title, lastname, firstname, token from Professor
    WHERE loginid = _loginid
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE addCourse(
    IN _courseid varchar(40),
    IN _coursename varchar(40)
)

BEGIN
    INSERT INTO Course(courseid, coursename)
    VALUES (_courseid, _coursename);
    SELECT LAST_INSERT_ID();
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE addSection(
    IN _courseid integer,
    IN _professorid integer,
    in _section integer
)

BEGIN
    INSERT INTO Section(courseid, professorid, section)
    VALUES (_courseid, _professorid, _section);
    SELECT LAST_INSERT_ID();
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE addRoll(
    IN _sectionid integer,
    IN _studentid integer
)

BEGIN
    INSERT INTO Roll(sectionid, studentid)
    VALUES (_sectionid, _studentid);
    SELECT LAST_INSERT_ID();
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE addLogin(
    IN _rollid integer,
    IN _ipaddress varchar(24),
    IN _latitude float,
    IN _longitude float,
    IN _verifycode varchar(40),
    IN _logindate datetime,
    IN _result integer,
    IN _token varchar(40)
)

BEGIN
    INSERT INTO Login( rollid, ipaddress, latitude, longitude, verifycode, logindate, result, token)
    VALUES (_rollid, _ipaddress, _latitude, _longitude, _verifycode, _logindate, _result, _token);
    SELECT LAST_INSERT_ID();
END $$

DELIMITER ;

DROP PROCEDURE IF EXISTS addSetCourse;
DELIMITER $$

CREATE PROCEDURE addSetCourse(
    IN _sectionid integer,
    IN _professorid integer,
    IN _classset datetime,
    IN _verifycode varchar(40)
)

BEGIN
    INSERT INTO SetCourse(sectionid, professorid, classset, verifycode)
    VALUES (_sectionid, _professorid, _classset, _verifycode);
    SELECT LAST_INSERT_ID();
END $$

DELIMITER ;

DROP PROCEDURE IF EXISTS getClassListByProfessorTid;
DELIMITER $$

CREATE PROCEDURE getClassListByProfessorTid(
    IN _professorid integer
)

BEGIN
SELECT c.tid as courseid, c.coursename, s.tid as sectionid, s.section, p.tid as professorid, concat(p.lastname, ', ', p.firstname) as professor
from Course c INNER JOIN Section s ON
	c.tid = s.courseid INNER JOIN Professor p ON
    s.professorid = p.tid
WHERE professorid = _professorid;
END $$

DELIMITER ;

DROP PROCEDURE IF EXISTS getClassListByStudentTid;
DELIMITER $$

CREATE PROCEDURE getClassListByStudentTid(
    IN _studentid integer
)

BEGIN
SELECT c.tid as courseid, c.coursename, s.tid as sectionid, s.section, p.tid as professorid, concat(p.lastname, ', ', p.firstname) as professor
from Course c INNER JOIN Section s ON
	c.tid = s.courseid INNER JOIN Professor p ON
    s.professorid = p.tid INNER JOIN Roll r ON
    r.sectionid = s.tid
WHERE r.studentid = _studentid;
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE getAttendanceBySectionDate(
    IN _sectionid integer,
    IN _date date
)

BEGIN
SELECT  r.studentid, s.lastname, s.firstname, l.result
FROM Roll r INNER JOIN Student s ON
    r.studentid = s.tid LEFT JOIN Login l ON
    l.rollid = r.tid
WHERE r.sectionid = _sectionid AND
    l.logindate = _date;
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE updateStudentToken(
    IN _tid integer,
    IN _token varchar(40)
)

BEGIN
UPDATE Student
SET token = _token
WHERE tid = _tid;
SELECT token from Student WHERE tid = _tid;
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE updateProfessorToken(
    IN _tid integer,
    IN _token varchar(40)
)

BEGIN
UPDATE Professor
SET token = _token
WHERE tid = _tid;
SELECT token from Student WHERE tid = _tid;
END $$

DELIMITER ;


