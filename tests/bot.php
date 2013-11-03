#!/usr/local/bin/php
<?php
require_once '../Bot.php';

use SkypeWrapper\Bot;

try {
	$objBot = new Bot("SkypeBot");
	// plugins

	$objBot->loadPlugin(
		"Log",
		array(
			'dir'				=> 'C:\WebServers\public\skypebot\logs',
			'chat_topic_filter'	=> null,
			'chat_id_filter'	=> null,
		));
	$objBot->loadPlugin(
		"MessageReader",
		array(
			'chat_topic_filter'	=> null,
			'chat_id_filter'	=> null,
		));
	$objBot->loadPlugin(
		"ChatOpener",
		array(
			'chat_topic_filter'	=> null,
			'chat_id_filter'	=> null,
		));
	$objBot->loadPlugin(
		"PingPong",
		array(
			'chat_topic_filter'	=> null,
			'chat_id_filter'	=> null,
		));
	$objBot->loadPlugin(
		"DriverService",
		array(
			'chat_topic_filter'	=> null,
			'chat_id_filter'	=> null,
		));
	
	$objBot->run();
} 
catch (com_exception $e) {
	file_put_contents('./error.log', $e);
	throw $e;
} 
?>
