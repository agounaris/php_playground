<?php 

/*
*
*/
class Object 
{
	public static $userVars = array();

	public function __set($name, $value)
	{
		self::$userVars[$name] = $value;
	}

	public function __get($name)
	{
		return ( isset(self::$userVars[$name])) ? self::$userVars[$name] : null;
	}

}