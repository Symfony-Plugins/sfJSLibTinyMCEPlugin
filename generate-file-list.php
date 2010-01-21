<?php

$dir = '.';

listFiles($dir);

function listFiles($dir) {
	$files = scandir($dir);

	foreach ($files as $file) {
		if (in_array($file, array('.', '..', '.svn'))) {
			continue;
		}

		$file = str_replace("./", '', $dir . '/' . $file);

		if (is_dir($file)) {
			listFiles($file);
			continue;
		}
		$md5 = substr(shell_exec("md5sum $file"), 0, 32);
		print('<file md5sum="' . $md5 . '" name="' . $file .'" role="data" />' . "\n");
	}
}

