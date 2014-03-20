<?php
		$filename = '/tmp/img.64';
		$handle = fopen($filename, "r");
		$contents = fread($handle, filesize($filename));
		fclose($handle);				
		$image = base64_decode ( $contents );
                header('Content-Type: image/jpeg');
                print $image;            
?>
