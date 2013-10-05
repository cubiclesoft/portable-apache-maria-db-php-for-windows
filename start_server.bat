@echo off
cls

rem Portable Apache, Maria DB, PHP.
rem (C) 2013 CubicleSoft.  All Rights Reserved.

echo Starting Apache...
support\createprocess.exe /f=DETACHED_PROCESS /dir="apache/bin" "apache/bin/httpd.exe"

echo Starting Maria DB...
support\createprocess.exe /f=DETACHED_PROCESS /dir="maria_db/bin" "maria_db/bin/mysqld.exe"
