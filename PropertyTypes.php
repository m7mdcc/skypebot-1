<?php
/**
 * Skype API Wrapper
 *
 * PHP versions 5.4
 *
 * @author     П$ix <psssix@gmail.com>
 */
namespace SkypeWrapper;

class PropertyTypes {
	// TODO: support enum, datetime, etc...
	const string = "string";
	const int = "int";
	const bool = "bool";
	
	private static function string($strValue)
	{
		return $strValue;
	}
	
	private static function int($strValue)
	{
		return intval($strValue);
	}
	
	private static function bool($strValue)
	{
		return $strValue == "TRUE" ? true : false;
	}

	public static function force($type, $value) {
		// util, суть массива пока не осознал
		if (is_array($type)) {
			if ($type[0] == self::int || $type[0] == self::string) 
				return preg_split('/,\s+/', $value);
		}
		
		if(method_exists(__CLASS__, $type))
			return self::$type($value);
		
		throw new \Exception(sprintf("unsupported propety type [%s] [%s]", var_export($type, true), var_export($value, true)));
	}

}
?>
