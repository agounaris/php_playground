<?php 

/**
* ServiceCommand
* 
* @package    
* @subpackage 
* @author     Argiris Gounaris agounaris@gmail.com
*/
class ServiceCommand
{

	/**
	*	What happens the command is being called
	*
	*	@param string $command
	*	@return boolean
	*/
	public function onCall( $command )
	{
		if ($command != 'service') {
			return false;
		}

		echo 'Service Command', "\n";
		return true;
	}

}