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

class FileTransfer extends Object {
	protected	$arrPropertyList = array(
		'TYPE' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'STATUS' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'FAILUREREASON' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'PARTNER_HANDLE' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'PARTNER_DISPNAME' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'STARTTIME' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::int,
		),
		'FINISHTIME' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::int,
		),
		'FILEPATH' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::string,
		),
		'FILESIZE' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::int,
		),
		'BYTESPERSECOND' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::int,
		),
		'BYTESTRANSFERRED' => array(
			'default'	=> true,
			'type'		=> PropertyTypes::int,
		),
	);

	protected	$strObjectIdenty = "FILETRANSFER";
}
?>
