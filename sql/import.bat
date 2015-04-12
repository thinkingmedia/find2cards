@ECHO OFF
CHOICE /C YN /M "ARE YOU SURE?"
IF ERRORLEVEL 2 GOTO :END
SET MYSQL_PWD=ghdqbUEo3svfQ8qTObPr
IF "%MYSQL_PWD%"=="" GOTO END
FOR %%T IN (tables\*.sql) DO (
    echo Importing %%T
    mysql --user=find2cards find2cards < %%T
)
:END
SET MYSQL_PWD=
