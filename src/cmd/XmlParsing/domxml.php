<?php
/**
 * Created by JetBrains PhpStorm.
 * User: agounaris
 * Date: 14/09/12
 * Time: 11:11
 * To change this template use File | Settings | File Templates.
 */

$start = microtime();
$filename = 'simplexml.xml';

$domtree = new DOMDocument('1.0', 'UTF-8');

$xmlRoot = $domtree->createElement("data");
$xmlRoot = $domtree->appendChild($xmlRoot);

$variable = $domtree->createElement("variable");
$variable = $xmlRoot->appendChild($variable);

for ($i = 0; $i < 32; $i++) {
    $row = $domtree->createElement("row");
    $row = $variable->appendChild($row);

    for ($j = 0; $j < 18; $j++) {
        $column = $domtree->createElement("column");
        $column = $row->appendChild($column);
    }

}

$content = $domtree->saveXML();
//echo $content;

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