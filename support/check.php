<?php
	// Portable Apache, Maria DB, PHP installer.
	// (C) 2013 CubicleSoft.  All Rights Reserved.

	$basepath = str_replace("\\", "/", dirname(dirname(__FILE__))) . "/";

	// Attempt to detect if everything is installed already.  If so, bail.
	if ($argc == 1 && !file_exists($basepath . "php/php.ini"))
	{
		echo "The installer has not completed.  If you are installing, run 'install.bat' instead.\n";

		sleep(2);
		exit();
	}

	echo "Welcome to the Portable Apache, Maria DB, and PHP checking tool.\n\n";

	define("CHECK_ONLY", true);
	echo "Checking software (no download)...\n";
	require_once $basepath . "support/download.php";

	echo "Done.\n";
	sleep(3);
?>