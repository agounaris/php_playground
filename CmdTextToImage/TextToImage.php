<?php


class TextToImage
{
	private $name;
	private $font;

	public function __construct($name, $font)
	{
		$this->name = $name;
		$this->font = $font;
	}


	public function getArgs()
	{
		var_dump($this->name);
	}

	public function produce()
	{
		$text = $this->name;

    	$a = htmlentities($text);

    	$b = html_entity_decode($a);

    	$im = imagecreatefromjpeg('mcfc_p4652_birthday_message_v1.jpg');

    	$bg = imagecolorallocate($im, 255, 255, 255);
    	$textcolor = imagecolorallocate($im, 255, 255, 255);
    	$strokecolor = imagecolorallocate($im, 80, 89, 91);

    	$font = './'.$this->font;

    	$left = strlen($b);

    	$center = intval(strlen($text) / 2);

    	//echo "center=".$center;

    	$x = 375-$left*15;
    	$y = 235;
    	$leftRotation = 5;
    	$rightRotation = -5;
    	$letterSpacing = 40;
    	$couter = 0;
    	$nameLenght = strlen($text);

    	$progress = array('','|', '/', '-', '\\');
    	$progressPointer = 1;
    	echo 'working: ';

    	for ($i = 0;$i<$nameLenght;$i++) {

    		if ($progressPointer==5) {
    			$progressPointer=1;
    		}

    		echo $progress[$progressPointer];

			echo "\010";

        	if ( $text[$i] == 'I' || $text[$i] == "i" ) {
            	$x+=8;
        	}

            if ( $text[$i] == 'O' || $text[$i] == "o" ) {
                $x+=0;
            }

            if ( $text[$i] == 'S' || $text[$i] == "s" ) {
                $x+=0;
            }

        	if ( $text[$i] == 'W' || $text[$i] == "w" ) {
            	$x+=5;
        	}
            
        	if ($i < $center) {
            	$this->imagettfstroketext($im, 45, $leftRotation, $x, $y, $textcolor, $strokecolor, $font, $text[$i], '2');
            	$x+=$letterSpacing;
            	$y-=3;
            	$leftRotation -= 5;
        	}else{

                if ($nameLenght%2 == 0) { $y+=8; }else{ $y+=3; }

            	$this->imagettfstroketext($im, 45, $rightRotation, $x, $y, $textcolor, $strokecolor, $font, $text[$i], '2');
            	$x+=$letterSpacing;
            	$y+=2;
            	$rightRotation-=5;
        	}

        	if ( $text[$i] == 'I' || $text[$i] == "i" ) {
            	$x-=8;
        	}

        	$progressPointer++;

    	}

    	echo "\e[0K";
    	echo "completed", PHP_EOL;

        imagejpeg($im, 'output_image.jpg');
        imagedestroy($im);
	}


    private function imagettfstroketext($image, $size, $angle, $x, $y, $textcolor, $strokecolor, $fontfile, $text, $px)
	{

    	for ($c1 = ($x - abs($px)); $c1 <= ($x + abs($px)); $c1++) {
        	for ($c2 = ($y - abs($px)); $c2 <= ($y + abs($px)); $c2++) {
            	$bg = imagettftext($image, $size, $angle, $c1, $c2, $strokecolor, $fontfile, $text);
        	}
    	}

    	return imagettftext($image, $size, $angle, $x, $y, $textcolor, $fontfile, $text);
        //return $bg;
	}

}
