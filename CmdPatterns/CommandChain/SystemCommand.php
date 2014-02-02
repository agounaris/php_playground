<?php 

/**
* SystemCommand
* 
* @package    
* @subpackage 
* @author     Argiris Gounaris agounaris@gmail.com
*/
class SystemCommand
{

	/**
	*	What happens the command is being called
	*
	*	@param string $command
	*	@return boolean
	*/
	public function onCall( $command )
	{
		if ($command != 'system') {
			return false;
		}

		echo 'System Command', "\n";
		return true;
	}

}