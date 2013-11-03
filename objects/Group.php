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

class Group extends Object {
	const SEARCH_TYPE_ALL = "ALL";
	const SEARCH_TYPE_CUSTOM = "CUSTOM";
	const SEARCH_TYPE_HARDWIRED = "HARDWIRED";

	protected	$arrPropertyList = array(
		'TYPE' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string
		),
		'CUSTOM_GROUP_ID' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'DISPLAYNAME' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'NROFUSERS' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'NROFUSERS_ONLINE' => array(
			'default'	=> true,
			'type'		=> array(PropertyTypes::string),
		),
		'USERS' => array(
			'default'	=> true,
			'type'		=> array(PropertyTypes::string),
		),
		'VISIBLE' => array(
			'default'		=> true,
			'type'			=> PropertyTypes::bool,
		),
		'EXPANDED' => array(
			'default'		=> true,
			'type'			=> PropertyTypes::bool,
		),
	);

	protected	$strObjectIdenty = "GROUP";
}
?>
