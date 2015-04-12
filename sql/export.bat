@ECHO OFF
SET MYSQL_PWD=ghdqbUEo3svfQ8qTObPr
IF "%MYSQL_PWD%"=="" GOTO END
DEL /Q tables\*.sql
mysql --user=find2cards --skip-column-names --batch --execute="show tables" find2cards > tables.txt
FOR /F "tokens=*" %%T IN (tables.txt) DO (
	ECHO Exporting %%T
	mysqldump --user=find2cards --hex-blob --no-data --single-transaction --add-drop-table find2cards %%T > tables\%%T.sql
)
DEL /Q tables.txt
:END
SET MYSQL_PWD=
