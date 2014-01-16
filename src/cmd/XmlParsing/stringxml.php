<?php
/**
 * Created by JetBrains PhpStorm.
 * User: agounaris
 * Date: 14/09/12
 * Time: 11:31
 * To change this template use File | Settings | File Templates.
 */
$start = microtime();
$filename = 'stringxml.xml';


$xml = '<data>';
$xml .= '<variable name="scorecardSelectors">';
for ($i = 0; $i < 32; $i++) {
    $xml .= '<row>';
    for ($j = 0; $j < 18; $j++) {
        $xml .= '<column>'.$j.'</column>';
    }
    $xml .= '</row>';
}
$xml .= '</variable>';

$content = $xml;

if (is_writable($filename)) {

    if (!$handle = fopen($filename, 'a')) {
        echo "Cannot open file ($filename)";
        exit;
    }

    if (fwrite($handle, $content) === FALSE) {
        echo "Cannot write to file ($filename)";
        exit;
    }

    $stop = microtime();

    fclose($handle);

} else {
    echo "The file $filename is not writable";
}


$duration = $stop - $start;

echo "The script finished in ".$duration." seconds.", PHP_EOL;