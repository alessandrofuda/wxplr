<?php
	
	require 'env.php'; 


	// prod server (original)
	// header('Location: https://www.wexplore.co/it');


	//dev server (nginx)
	// header('Location: http://wexplore.dev/it'); // only for dev version
	
	
	header('Location: ' . $host . '/it');


	exit;
	
?>
