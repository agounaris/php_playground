<?php 

require_once('DatabaseConnection.php');

/**
 * Simulate 2 connections
 */
$dbh1 = DatabaseConnection::getConnection();
$dbh2 = DatabaseConnection::getConnection();

$dbh1 = null;
$dbh2 = null;