<?php
/**
 * Skype API Wrapper
 *
 * PHP versions 5.4
 *
 * @author     П$ix <psssix@gmail.com>
 */
namespace SkypeWrapper\objects;

use SkypeWrapper\PropertyTypes;

class ChatMessage extends Object {
	const STATUS_SENDING = "SENDING";
	const STATUS_SENT = "SENT";
	const STATUS_RECIEVED = "RECEIVED";
	const STATUS_READ = "READ";

	protected	$arrPropertyList = array(
		'TIMESTAMP' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::int,
		),
		'FROM_HANDLE' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'FROM_DISPNAME' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'TYPE' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'STATUS' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'LEAVEREASON' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'CHATNAME' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'USERS' => array(
			'default'	=> true,
			'type'		=> array(PropertyTypes::string),
		),
		'IS_EDITABLE' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::bool,
		),
		'EDITED_BY' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'EDITED_TIMESTAMP' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'OPTIONS' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::int,
		),
		'ROLE' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'BODY' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
	);

	protected	$strObjectIdenty = "CHATMESSAGE";
}
?>
