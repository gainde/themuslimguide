@Echo off
:: SETTINGS AND PATHS 

:: databse user
set dbuser=root

:: Password
set dbpass=

set dbname=themuslimguide

:: MySQL EXE Path
set mysqldumpexe="C:\wamp64\bin\mysql\mysql5.7.14\bin\mysqldump.exe"

:: Chemin du dossier de destination
set exportdest=C:\wamp64\www\themuslimguide\db\


%mysqldumpexe% --user=%dbuser% --password=%dbpass% %dbname% > "%exportdest%%dbname%.sql"