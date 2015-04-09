@ECHO OFF
SET MYSQL_PWD=ghdqbUEo3svfQ8qTObPr
IF "%MYSQL_PWD%"=="" GOTO END
DEL /Q data\*.sql
mysql --user=memory --skip-column-names --batch --execute="show tables" memory > tables.txt
FOR /F "tokens=*" %%T IN (tables.txt) DO (
	ECHO Exporting %%T
	mysqldump --user=memory --hex-blob --add-drop-table memory %%T > data\%%T.sql
)
DEL /Q tables.txt
:END
SET MYSQL_PWD=
