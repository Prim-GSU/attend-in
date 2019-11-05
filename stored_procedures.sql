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
    WHERE tid = _tid
    and deleted = 0;
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE getStudentByLoginid(
    IN _loginid varchar(40)
)

BEGIN
    SELECT tid, loginid, lastname, firstname, token from Student
    WHERE loginid = _loginid
    and deleted = 0;
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE getProfessorByTid(
    IN _tid integer
)

BEGIN
    SELECT loginid, title, lastname, firstname, token from Professor
    WHERE tid = _tid
    and deleted = 0;
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE getProfessorByLoginid(
    IN _loginid varchar(40)
)

BEGIN
    SELECT tid, loginid, title, lastname, firstname, token from Professor
    WHERE loginid = _loginid
    and deleted = 0;
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE addCourse(
    IN _coursename varchar(40)
)

BEGIN
    INSERT INTO Course(coursename)
    VALUES (_coursename);
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
    INSERT INTO Section(courseid, professorid, sectionid)
    VALUES (_courseid, _professorid, _sectionid);
    SELECT LAST_INSERT_ID();
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE addRoll(
    in _sectionid integer,
    IN _studentid integer
)

BEGIN
    INSERT INTO Roll(sectionid, studentid)
    VALUES (_sectionid, studentid);
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

DELIMITER $$

CREATE PROCEDURE addSetCourse(
    IN _sectionid integer,
    IN _professorid float,
    IN _classset datetime,
    IN _verifycode varchar(40)
)

BEGIN
    INSERT INTO Login( sectionid, professorid, classset, verifycode)
    VALUES (_sectionid, _professorid, _classset, _verifycode);
    SELECT LAST_INSERT_ID();
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE getClassListByProfessorId(
    IN _professorid integer
)

BEGIN
SELECT c.tid, s.tid, c.coursename, s.section
from Course c INNER JOIN Section s ON
	c.tid = s.courseid
WHERE professorid = _professorid;
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE getClassListByStudentId(
    IN _studentid integer
)

BEGIN
SELECT c.tid as corseTid, s.tid as sectionTid, r.studentid as studentTid, c.coursename, s.section
from Course c INNER JOIN Section s ON
	c.tid = s.courseid INNER JOIN Roll r ON
    s.tid = r.sectionid
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

CREATE PROCEDURE setAttendance(IN _sectionid integer, IN _studentid integer)

BEGIN
SELECT r., l.
FROM Roll r INNER JOIN Login l ON
	l.rollid = r.tid
WHERE @sectionid = _sectionid AND  @studentid = _studentid;

UPDATE Login
SET result = _result
WHERE
rollid = @rollid AND DATE(class_date) = DATE(_classdate);

SELECT loginid FROM Login
WHERE class_date = _classdate;
END $$

DELIMITER ;

