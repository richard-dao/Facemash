<?php

include('mysqlm.php');

if ($handle = opendir('m_images')) {

	/* This is the correct way to loop over the directory. */
	while (false !== ($file = readdir($handle))) {
		if($file!='.' && $file!='..') {
			$images[] = "('".$file."')";
		}
	}

	closedir($handle);
}

$query = "INSERT INTO images (filename) VALUES ".implode(',', $images)." ";
if (!mysqli_query($connection, $query)) {
	print mysqli_error();
}
else {
	print "finished installing your images!";
}


?>