<?php
	// Portable Apache, Maria DB, PHP installer.
	// (C) 2013 CubicleSoft.  All Rights Reserved.

	$basepath = str_replace("\\", "/", dirname(dirname(__FILE__))) . "/";

	// Attempt to detect if everything is installed already.  If so, bail.
	if ($argc == 1 && !file_exists($basepath . "installed.dat"))
	{
		echo "The installer has not completed.  If you are installing, run 'install.bat' instead.\n";

		sleep(2);
		exit();
	}

	echo "Welcome to the Portable Apache, Maria DB, and PHP upgrader.\n\n";

	echo "Downloading software...\n";
	echo "(This will take a while, so go get some coffee or a snack)\n\n";
	require_once $basepath . "support/download.php";

	echo "Done.\n";
	sleep(3);
?>