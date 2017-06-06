SET ApiZip="src\api2.zip"
IF EXIST %ApiZip% del /F %ApiZip%
cd apig2
php vendor\zfcampus\zf-deploy\bin\zfdeploy.php build "..\src\api2.zip"
cd ..
rmdir "www\api2" /S /Q
7z x -y  %ApiZip% -owww\api2 * -r