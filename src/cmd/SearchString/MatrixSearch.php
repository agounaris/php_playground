<?php 

/*
 * I call this algorithm MatrixSearch.
 * The main idea is that we explose the elements into smaller arrays
 * and then create a small matric with ones to count the oncurences
 * of the words. The array with the most ones wins and we print the
 * index of the initial titles array.
 * 
 */
$start = microtime(true);
$titlesArray = array('One man army', 'There are many ways','Are these true', 'Many ways are true');

//$myGivenString = 'Many are true';
$myGivenString = 'One man';

$myGivenStringArray = explode(" ", strtolower($myGivenString) );
$weights = array();

foreach ($titlesArray as $key => $value) {
	
	$myGivenStringWords = explode(" ", strtolower($myGivenString));
	$myGivenStringLength = count($myGivenStringWords);
	
	$titlesWords = explode(" ", strtolower($value));
	$titlesWordsLength = count($titlesWords);
	
	$internalWeight = array();
	
	for ($i=0; $i < $myGivenStringLength; $i++) {
		for ($j=0; $j < $titlesWordsLength; $j++) {
			if ( $myGivenStringWords[$i] == $titlesWords[$j] ) {
				$internalWeight[] = 1;
			} 
		} 
	}	
	$weights[] = $internalWeight;
	
}

$counts = array();
foreach ($weights as $key => $value) {
	$counts[] = count($value);
}

$maxKey = array_keys( $counts, max($counts) );

$finish = microtime(true);
$totalTime = $finish-$start;

echo 'The closest matching string is the: '.$titlesArray[ $maxKey[0] ], "\n";
echo 'Script finished in:'.number_format($totalTime, 5), "\n";


