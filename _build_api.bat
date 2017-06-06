SET ApiZip="src\api.zip"
IF EXIST %ApiZip% del /F %ApiZip%
cd apigility
php vendor\zfcampus\zf-deploy\bin\zfdeploy.php build "..\src\api.zip"
cd ..
rmdir "www\api" /S /Q
7z x -y  %ApiZip% -owww\api * -r