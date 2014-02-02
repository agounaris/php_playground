<?php 

/**
* CommandChain
* 
* @package    
* @subpackage 
* @author     Argiris Gounaris agounaris@gmail.com
*/
class CommandChain
{
	/**
	*	Command set array
	*	@var $commandSet
	*/
	private $commandSet = array();

	/**
	*	Add command to the array
	*
	*	@param string $command
	*	@return void
	*/
	public function addCommand( $command )
	{
		$this -> commandSet[] = $command;
	}

	/**
	*	Run a command
	*
	*	@param string $command
	*	@return void
	*/
	public function runCommand( $command )
	{
		foreach ($this->commandSet as $key => $cmd) {

			if ( $cmd -> onCall( $command ) ) {
				return;
			}

		}
	}
}