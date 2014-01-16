#!/usr/local/bin/php
<?php

include_once('TextToImage.php');

$textToImage = new TextToImage($argv[1], $argv[2]);
$textToImage->produce();