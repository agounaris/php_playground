#!/usr/local/bin/php
<?php 

/**
 * An enhanced array compare class
 * 
 * @author Argyrios Gounaris
 *
 */
class MyArrayCompare
{
	private static $filterKey;

	/**
	 * Array intersect on multidimensional array, filtered by array key
	 * 
	 * @param array $multidimentionalArray
	 * @param array $filterArray
	 * @param string $filterKey
	 * @return array
	 */
	public static function intersect($multidimentionalArray, $filterArray, $filterKey = null)
	{
		if (!$filterKey) {
			echo 'You have not defined a filter key', PHP_EOL;
			exit;
		}

		self::$filterKey = $filterKey;

		$subset = array();
		foreach ($multidimentionalArray as $key => $value) {

            $keys = array_keys($value);
            $keys = array_flip($keys);
			unset($keys[$filterKey]);
			$keys = array_flip($keys);
            
            if ( strpos($value[$filterKey], ';') !== false ) {
                
                $tmp = explode(';', $value[$filterKey]);
                
                foreach ($tmp as $tmpValue) {
                    
                    $subset[] = self::injectAdditionalFields($filterKey, $tmpValue, $keys, $value);
                }
                
            }else{

                $subset[] = self::injectAdditionalFields($filterKey, $value[$filterKey], $keys, $value);
            }
        }
        
        $results = array_uintersect($subset, $filterArray, 'self::emailCompare');
        
        return $results;       
	}
    
	/**
	 * array_uintersect callback function
	 * 
	 * @param array $val1
	 * @param array $val2
	 * @return number
	 */
    private static function emailCompare($val1, $val2)
    {
        return strcmp($val1[self::$filterKey], $val2[self::$filterKey]);
    }

    /**
     * Inject the additional array elements to the filtered array
     * 
     * @param string $filterKey
     * @param string $tmpValue
     * @param array $keys
     * @param array $value
     * @return array
     */
    private static function injectAdditionalFields($filterKey, $tmpValue, $keys, $value) {
    	$tmpTable = array();
        $tmpTable[$filterKey] = $tmpValue;
        foreach ($keys as $key) {
        	$tmpTable[$key] = $value[$key];
        }

        return $tmpTable;
    }
    
}

$array1 = array(
	array('email'=>'test@test.com;test2@test.com','saluation'=>'Test', 'value'=>'some value'),
	array('email'=>'another.test@test.com', 'salutation'=>'Another test', 'value'=>'another value'),
);

print_r($array1);

$array2 = array(
	array('email'=>'test@test.com'),
	array('email'=>'test2@test.com'),
);

print_r($array2);

print_r(MyArrayCompare::intersect($array1, $array2, 'email'));

