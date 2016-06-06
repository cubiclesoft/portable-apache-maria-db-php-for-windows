<?php
	// Portable Apache, Maria DB, PHP.
	// (C) 2013 CubicleSoft.  All Rights Reserved.

	// Basic paths.
	$basepath = str_replace("\\", "/", dirname(dirname(__FILE__))) . "/";

	function CopyDirectory($srcdir, $destdir)
	{
		if (substr($srcdir, -1) == "/")  $srcdir = substr($srcdir, 0, -1);
		if (substr($destdir, -1) == "/")  $destdir = substr($destdir, 0, -1);

		@mkdir($destdir);

		$dir = opendir($srcdir);
		if ($dir)
		{
			while (($file = readdir($dir)) !== false)
			{
				if ($file != "." && $file != "..")
				{
					if (is_dir($srcdir . "/" . $file))
					{
						$result = CopyDirectory($srcdir . "/" . $file, $destdir . "/" . $file);
						if (!$result["success"])  return $result;
					}
					else if (is_file($srcdir . "/" . $file))
					{
						if (!@copy($srcdir . "/" . $file, $destdir . "/" . $file))  return array("success" => false, "error" => "Copying '" . $srcdir . "/" . $file . "' to '" . $destdir . "/" . $file . "' failed.", "errorcode" => "copy_failed");
					}
				}
			}

			closedir($dir);
		}
		else
		{
			return array("success" => false, "error" => "Unable to open directory '" . $srcdir . "'.", "opendir_failed");
		}

		return array("success" => true);
	}
?>