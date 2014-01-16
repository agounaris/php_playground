<?php
/**
 * Created by JetBrains PhpStorm.
 * User: agounaris
 * Date: 14/09/12
 * Time: 11:02
 * To change this template use File | Settings | File Templates.
 */

$start = microtime();
$filename = 'simplexml.xml';


$xml = new SimpleXMLElement('<data/>');
$variable = $xml->addChild('variable');

for ($i = 0; $i < 32; $i++) {
    $row = $variable->addChild('row');

    for ($j = 0; $j < 18; $j++) {
        $row->addChild('column', $i+$j);
    }

}

$content = $xml->asXML();

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