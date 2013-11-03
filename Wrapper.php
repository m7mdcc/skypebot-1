<?php
/**
 * Skype API Wrapper
 *
 * PHP versions 5.4
 *
 * @author     П$ix <psssix@gmail.com>
 */
namespace SkypeWrapper;

require_once 'SkypeWrapper.php';
require_once 'drivers/Driver.php';

class Wrapper {	
	/**
	 *
	 * @var \SkypeWrapper\SkypeWrapper
	 */
	protected static $objWrapper = null;
	/**
	 * 
	 * @param string $strIdenty
	 * @param int $nProtocol
	 * @param bool $bDebugMode
	 * @return \SkypeWrapper\SkypeWrapper
	 * @throws \Exception
	 */
	public static function initWrapper($strIdenty, $nProtocol = self::DEFAULT_PROTOCOL, $bDebugMode = false)
	{
		return self::$objWrapper = new SkypeWrapper($strIdenty, $nProtocol, $bDebugMode);
	}
	
	/**
	 * 
	 * @return \SkypeWrapper\SkypeWrapper
	 */
	public static function getWrapper() {
		return self::$objWrapper;
	}
	
	// ---
	// Driver factory
	// ---
	
	/**
	 *
	 * @var \SkypeWrapper\drivers\Driver
	 */
	protected static $objDriver = null;
	protected static $arrDrivers = array(
		'DbusDriver',
		'ComDriver'
	);
	
	/**
	 * 
	 * @param string $strIdenty
	 * @param int $nProtocol
	 * @param bool $bDebugMode
	 * @throws \Exception
	 */
	public static function initDriver($strIdenty, $nProtocol = self::DEFAULT_PROTOCOL, $bDebugMode = false)
	{
		foreach (self::$arrDrivers as $strDrivrClassName) {
			$strDrivrClassName = "SkypeWrapper\\drivers\\".$strDrivrClassName;
			if($strDrivrClassName::test())
			{
				self::$objDriver = new $strDrivrClassName($strIdenty, $nProtocol, $bDebugMode);
				return;
			}
		}
		
		throw new \Exception('not one of the drivers can\'t use');
	}
	
	/**
	 * 
	 * @return \SkypeWrapper\drivers\Driver
	 */
	public static function 	getDriver()
	{
		if(self::$objDriver)
			return self::$objDriver;
		
		throw new \Exception('driver not inited');
	}
	
	// ---
	// Debug mode
	// ---
	
	protected static $bDebugMode;
	
	public static function setDebugMode($bDebugMode = false)
	{
		self::$bDebugMode = $bDebugMode;
	}
	
	public static function isDebug() {
		return self::$bDebugMode;
	}
	
	public static function _debug($format) {
		if (self::$bDebugMode == false) {
			return;
		}
		$args = func_get_args();
		array_shift($args);
		vprintf($format, $args);
	}

}

?>
