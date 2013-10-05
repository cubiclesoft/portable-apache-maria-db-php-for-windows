@echo off
cls

rem Portable Apache, Maria DB, PHP.
rem (C) 2013 CubicleSoft.  All Rights Reserved.

echo Stopping Apache...
taskkill /F /FI "IMAGENAME eq httpd.exe" 2>&1

echo Stopping Maria DB...
support\createprocess.exe /dir="maria_db/bin" "maria_db/bin/mysqladmin.exe" shutdown -u root
