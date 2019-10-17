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

CREATE PROCEDURE getProfessorByLoginid(
    IN _loginid varchar(40)
)

BEGIN
    SELECT tid, loginid, title, lastname, firstname, token from Professor
    WHERE loginid = _loginid
    and deleted = 0;
END $$

DELIMITER ;

