@ECHO OFF
SET /P MYSQL_PWD=Root Password:
IF "%MYSQL_PWD%"=="" GOTO END
mysql --user=root < create.sql
:END
SET MYSQL_PWD=
