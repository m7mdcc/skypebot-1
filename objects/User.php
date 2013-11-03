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

class User extends Object {
	const BUDDY_STATUS_OTHER = 0;
	const BUDDY_STATUS_DELETED = 1;
	const BUDDY_STATUS_PENDING = 2;
	const BUDDY_STATUS_ADDAD = 3;

	protected	$arrPropertyList = array(
		'HANDLE' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'FULLNAME' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'BIRTHDAY' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'SEX' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'LANGUAGE' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'COUNTRY' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'PROVINCE' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'CITY' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'PHONE_HOME' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'PHONE_OFFICE' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'PHONE_MOBILE' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'HOMEPAGE' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'ABOUT' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'HASCALLEQUIPMENT' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::bool,
		),
		'IS_VIDEO_CAPABLE' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::bool,
		),
		'BUDDYSTATUS' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::int,
		),
		'ISAUTHORIZED' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::bool,
		),
		'ISBLOCKED' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::bool,
		),
		'ONLINESTATUS' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'LASTONLINETIMESTAMP' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::int,
		),
		'CAN_LEAVE_VM' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::bool,
		),
		'SPEEDDIAL' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'RECEIVEDAUTHREQUEST' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'MOOD_TEXT' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'RICH_MOOD_TEXT' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'ALIASES' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'TIMEZONE' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::int,
		),
		'IS_CF_ACTIVE' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::bool,
		),
		'NROF_AUTHED_BUDDIES' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::int,
		),
	);

	protected	$strObjectIdenty = "USER";
}

?>
