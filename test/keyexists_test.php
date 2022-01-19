<?php
use PHPUnit\Framework\TestCase;

class keyexists_test extends TestCase {

    public function testKeyexists(){
        include('../dictionary.php');
        $data = array("keys" =>  array(), "members" => array());

        echo "\n> KEYEXISTS foo";
        KeyExists($data, "foo");

        echo "\n> ADD foo bar";
        addKey($data, $storageFilePath,"foo","bar");
		$storage = file_get_contents($storageFilePath);
		$data = json_decode($storage, true);

        echo "\n> KEYEXISTS foo";
        $result = KeyExists($data, "foo");

        if ($result == "true") {
        	$this->assertEquals("true", $result);
        }else{
        	$this->assertEquals("false", $result);
        }
	    clearTestData($storageFilePath);
    }
}
