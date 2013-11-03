#!/usr/local/bin/php
<?php

try {
	SkypeWrapper\drivers\Driver::initDriver('SkypeBot', 8, true);
	SkypeWrapper\drivers\Driver::getDriver()->connect();
	while(1)
		com_message_pump(1000);
} 
catch (com_exception $e) {
	file_put_contents('./error.log', $e);
	throw $e;
} 
?>
