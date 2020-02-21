Portable Apache + Maria DB + PHP for Windows
============================================

This project is for web developers who prefer manually editing configuration files and want "manual" but quick startup of Apache and Maria DB (no Windows services).  No more hunting for ZIP files for each separate piece of software.

If XAMPP and similar incarnations are not really your style (e.g. you prefer the command-line and think phpMyAdmin is for weaklings), then this project might be more up your alley.  Note that the primary purpose of this project is to set up a quick-and-dirty local WAMP install that just works and is not intended for use on production servers.

GitHub is a perfect fit for this sort of project.  The latest code resides here, so updating is a matter of running a 'git pull'.  Set up a Task Scheduler job to update this project automatically or use it as a submodule in your own Git project.  If you know of any changes that need to be made, submit a pull request so that everyone benefits.

[![Donate](https://cubiclesoft.com/res/donate-shield.png)](https://cubiclesoft.com/donate/)

Features
--------

* Classic Apache + Maria DB + PHP combo in a portable format.
* A flashback from the past:  Batch files!  install.bat, start_server.bat, and stop_server.bat to install, start, and stop the software respectively.
* Installation is designed to just adapt paths to the current host.  No registry mess, no Windows services, no problem.
* Has a liberal open source license.  MIT or LGPL, your choice.  (Only applies to the new files that this project adds.  Each product has its own separate license.  See below.)
* Designed for relatively painless integration into your Windows environment.
* Sits on GitHub for all of that pull request and issue tracker goodness to easily submit changes and ideas respectively.

Useful Information
------------------

Do the whole 'git clone' thing to obtain the latest release.  Then run 'install.bat' to get the configuration files set up quickly.  Note that you will need approximately 2GB free to successfully complete the installation.

Run 'start_server.bat' to start the Apache web server and Maria DB database server.  To stop both servers, run 'stop_server.bat'.

To upgrade to the latest version, stop the servers with 'stop_server.bat', run 'git pull', and then run 'upgrade.bat'.

To check for the latest version (and bugs in the scraper), run 'check.bat'.

To only install or upgrade one or two of the packages, run 'install.bat' with one or more of these options:  apache, maria_db, php

For example:  upgrade.bat php

Troubleshooting
---------------

Requires 'taskkill.exe' for 'stop_server.bat' to work properly.  This is part of Windows XP and later.

If the PHP module for Apache fails to load or if you want to always have `php.exe` be more conveniently available from the command-line, modifying the system or user PATH environment variable can solve both problems AND create new problems.  On Windows 10, the PATH is inconveniently buried under:  Control Panel -> System -> Advanced system settings -> Environment Variables... -> PATH.  Note that adding paths to the system or user PATH are problematic for other applications that run on the same system, which can result in [DLL hell](https://en.wikipedia.org/wiki/DLL_Hell) and also slow down the overall system.  But adding an item to the PATH can make it easier to run both Apache and `php.exe` from the command-line without having to duplicate a bunch of DLLs when using PECL.

Installing PECL Extensions
--------------------------

[PECL](https://pecl.php.net/) contains a number of powerful and popular extensions for PHP such as [Xdebug](https://pecl.php.net/package/xdebug), [ImageMagick](https://pecl.php.net/package/imagick), [Redis](https://pecl.php.net/package/redis), etc.  Getting them to work on Windows can be challenging.  The following is a general guide.

Most PECL packages work on Linux hosts since Linux is the defacto server OS in the world and also PECL's native environment.  When a PECL package supports Windows, a little Windows icon plus a "DLL" appears next to it.  There are far fewer packages with Windows support.  The PECL DLLs are precompiled versions for several versions of PHP.  The PECL subsystem automatically builds binaries for Windows when support is declared for those PECL packages.  Whether or not a downloaded compiled DLL actually works with PHP is a completely different issue.

There are typically four flavors of DLL in PECL:  NTS x64, TS x64, NTS x86, and TS x86.  This project currently uses:  32-bit (x86) Thread-safe (TS) PHP.  So the PECL DLLs you want are of the "TS x86" variety.

From a command-line, run `php.exe -v`.  That will provide the current working version and also verify x64 vs x86 PHP.

Downloading the right DLL is only the start.  The next step is to update the `php.ini` and verify that the DLL is set up correctly.  Each extension is different.  PECL extensions generally go into the `php/ext` subdirectory.  There are two areas to update in `php.ini`:

```
extension_dir = "C:/path/to/php/ext"  <-- If not already uncommented.

...

extension=extname    <-- In general, no .dll
zend_extention=zendextname  <-- Rare.  Mostly just Xdebug and Zend opcache these days.
```

For some extensions, you will need additional downloads.  In particular, ImageMagick requires many additional DLLs to function.  The PECL extension only provides the necessary glue between the ImageMagick DLLs, PHP core, and PHP userland (i.e. your PHP-based application).  In addition, you need to match x86/x64 DLLs with PHP.  If you prefer portable software, which you probably do if you are using this project, then you'll need to find a portable flavor of the library that only includes the required DLLs and not an installer.

Some extensions are Zend extensions (e.g. Xdebug) and require a `zend_extension` line instead of `extension` in `php.ini`.  A number of PECL extensions also add `php.ini` options.

From a command-line, run `php.exe -v` again.  That will verify that PHP didn't have any problems loading the extension.  If it does, a dialog box will appear indicating it failed to load and then you have a lot of work ahead of you to determine why it failed.  These tools are your friend:

* [Microsoft SysInternals Process Monitor](https://docs.microsoft.com/en-us/sysinternals/downloads/procmon) - Watching for `php.exe` processes and the DLLs they attempt to load and what paths they attempt to load them from.
* [Dependencies](https://github.com/lucasg/Dependencies) - Tossing the PECL extension DLL in to see dependency trees and whether or not Windows will be able to load the DLL itself.

The Windows EXE/DLL loader has [complex, broken rules](https://docs.microsoft.com/en-us/windows/win32/dlls/dynamic-link-library-search-order) on how it loads DLLs into RAM.  In general, third-party DLLs that the PECL extension depend on (e.g. ImageMagick DLLs) go into the same directory as the running executable OR somewhere on the system/user PATH.  The rules for how the Windows loader works basically invite wrecking a pristine Windows installation.  Knowing how the Windows loader works under the hood will make your life a LOT easier when working with PECL extensions.

Sources
-------

The Apache web server is under the Apache License, Version 2.0.  (http://www.apache.org/licenses/LICENSE-2.0.html)

http://www.apachelounge.com/download/win32/

The Maria DB database server is under the GPL.  (https://mariadb.com/kb/en/mariadb-license/)

https://downloads.mariadb.org/

The PHP scripting language is under the PHP License.  (http://www.php.net/license/3_01.txt)

http://windows.php.net/download/
