<?php 

/**
*	Wrap up everything and call the functions
*/
require_once('CommandChain.php');
require_once('SystemCommand.php');
require_once('ServiceCommand.php');

$chain = new CommandChain();

$chain -> addCommand( new SystemCommand() );
$chain -> addCommand( new ServiceCommand() );

$chain -> runCommand('system');
$chain -> runCommand('service');