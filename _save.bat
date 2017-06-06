For /f "tokens=2-4 delims=/ " %%a in ('date /t') do (set mydate=%%c-%%a-%%b)
For /f "tokens=1-2 delims=/:" %%a in ('time /t') do (set mytime=%%a%%b)

mysqldump -uroot soss_socy_fashion > src\_db\soss_socy_fashion(%mydate%_%mytime%).sql"