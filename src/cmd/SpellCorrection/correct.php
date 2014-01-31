<?php 

$memcache = new Memcache;
$memcache->connect('localhost', 11211) or die ("Could not connect");

/*
 * 10 words as arguments!!
 * 
 * test it with "php diction.php ezer tost applo airplone feor shep boet garagi squirral buildang palintrame"
 */

$time_start = microtime(true);
// does 0.0036
//$contents = file_get_contents("../Documents/dictionary.txt");

$words = array();

if (!is_array($memcache->get('a'))) {

	// does 0.0017
	$handle = @fopen("../Documents/dictionary.txt", "r");
	if ($handle) {
	    while (($buffer = fgets($handle, 4096)) !== false) {
	        $words[$buffer[0]][] = trim($buffer);
	    }
	    if (!feof($handle)) {
	        echo "Error: unexpected fgets() fail\n";
	    }
	    fclose($handle);
	}
	
	foreach ($words as $key => $eachWordArray) {
		$memcache->set($key, $eachWordArray) or die ("Failed to save data at the server");
	}

}

// removing the first element since it's the name of the script
unset($argv[0]);

$reducedWords = array();
foreach ($argv as $input) {
	
	echo "--------------\n";
	
	foreach ($memcache->get($input[0]) as $key => $value) {
		if (strlen($input) == strlen($value)) {
			$reducedWords[] = $value;
		}
	}
	
	foreach ($reducedWords as $key => $word) {
		
		$l = strlen($input);
		$index = 0;
		
		for ($i=0; $i < $l; $i++) { 
			if (isset($word[$i]) && $input[$i] == $word[$i]) {
				$index++;
			}
		}
		
		if ($index >= ($l-1)) {
			echo "do you mean $word\n";
		}
		
	}
	
}

$time_end = microtime(true);
$time = $time_end - $time_start;

echo "Finished in $time seconds\n";