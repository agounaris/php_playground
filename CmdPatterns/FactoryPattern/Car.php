<?php 
require_once('Vehicle.php'); 

/**
* Car 
* 
* @package    
* @subpackage 
* @author     Argiris Gounaris agounaris@gmail.com
*/
class Car implements Vehicle {

  	public static function Create( ) 
  	{
        return new Car( null );
  	}

  	public function __construct() { }

  	/**
  	*	Implemented for interface
  	*
  	*	@return string speed
  	*/
  	public function getSpeed()
  	{
    	return "100";
  	}

}