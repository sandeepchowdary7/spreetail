<?php
use PHPUnit\Framework\TestCase;

class keys_test extends TestCase {

    public function testKeys(){
        include('../dictionary.php');
        $data = array("keys" =>  array(), "members" => array());

        echo "\n> ADD foo bar";
        addKey($data, $storageFilePath,"foo","bar");
		$storage = file_get_contents($storageFilePath);
		$data = json_decode($storage, true);

		echo "\n> ADD baz bang";
        addKey($data, $storageFilePath,"baz","bang");
		$storage = file_get_contents($storageFilePath);
		$data = json_decode($storage, true);

		echo "\n> KEYS";
        $result = getKeys($data);
        
        $this->assertEquals(2, count($result));
	    clearTestData($storageFilePath);
    }
}
