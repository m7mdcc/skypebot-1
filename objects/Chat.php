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

class Chat extends Object {
	protected	$arrPropertyList = array(
		// Protocol 3
		'NAME' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string
		),
		'TIMESTAMP' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::int,
		),
		'ADDER' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'STATUS' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'POSTERS' => array(
			'default'	=> true,
			'type'		=> array(PropertyTypes::string),
		),
		'MEMBERS' => array(
			'default'	=> true,
			'type'		=> array(PropertyTypes::string),
		),
		'TOPIC' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'TOPICXML' => array(
			'default'	=> false,
			'type'		=> PropertyTypes::string,
		),
		'CHATMESSAGES' => array(
			'default'	=> false,
			'type'		=> array(PropertyTypes::int),
		),
		'ACTIVEMEMBERS' => array(
			'default'	=> true,
			'type'		=> array(PropertyTypes::string),
		),
		'FRIENDLYNAME' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'RECENTCHATMESSAGES' => array(
			'default'	=> true,
			'type'		=> array(PropertyTypes::int),
		),

		// Protocol 6
		'BOOKMARKED' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::bool,
		),

		// Protocol 7
		'PASSWORDHINT' => array(
			'default'	=> false,
			'type'		=> PropertyTypes::string,
		),
		'GUIDELINES' => array(
			'default'	=> false,
			'type'		=> PropertyTypes::string,
		),
		'OPTIONS' => array(
			'default'	=> false,
			'type'		=> PropertyTypes::int,
		),
		'DESCRIPTION' => array(
			'default'	=> false,
			'type'		=> PropertyTypes::string,
		),
		'DIALOG_PARTNER' => array(
			'default'	=> false,
			'type'		=> PropertyTypes::string,
		),
		'ACTIVITY_TIMESTAMP' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::int,
		),
		'TYPE' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'MYSTATUS' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'MYROLE' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		// and more...
	);

	protected	$strObjectIdenty = "CHAT";

	public function invokeChatmessage($strMessage) {
		return \SkypeWrapper\Wrapper::getWrapper()->invokeChatmessage($this->getId(), $strMessage);
	}
}
?>
