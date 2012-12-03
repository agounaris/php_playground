<?php 

/*
 * Same as MatrixSearch but a bit improved. What I want to do
 * is that I have an array of objects coming from a json doc.
 * 
 * I want to compare a given string with these array objects
 * and return the one that matches the most with the search
 * string.
 * 
 */
$start = microtime(true);
$titlesArray = array('One man army', 'There are many ways','Are these true', 'Many ways are true');

//$myGivenString = 'Many are true';
$myGivenString = 'One man';

$myGivenStringArray = explode(" ", $myGivenString);

$fullStringTitlesArray = array();
foreach ($titlesArray as $key => $value) {
	
	$fullStringTitlesArray[] = str_replace(" ", "", $value);
	
}

$indexArray = array();
foreach ($fullStringTitlesArray as $key => $value) {
	$c = 0;	
	foreach ($myGivenStringArray as $myGivenStringWord) {
		
		if ( strpos($value, $myGivenStringWord) > -1 ) {
			$c++;			
		}
				
	}
	$indexArray[] = $c;		
}

$maxKey = array_keys( $indexArray, max($indexArray) );

$finish = microtime(true);
$totalTime = $finish-$start;

echo 'The closest matching string is the: '.$titlesArray[ $maxKey[0] ], "\n";
echo 'Script finished in:'.number_format($totalTime, 5), "\n";