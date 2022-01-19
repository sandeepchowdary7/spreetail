<?php
use PHPUnit\Framework\TestCase;

class members_test extends TestCase {

    public function testMembers(){
        include('../dictionary.php');
        $data = array("keys" =>  array(), "members" => array());

        echo "\n> ADD foo bar";
        addKey($data, $storageFilePath,"foo","bar");
		$storage = file_get_contents($storageFilePath);
		$data = json_decode($storage, true);

        echo "\n> ADD foo baz";
        addKey($data, $storageFilePath,"foo","baz");
		$storage = file_get_contents($storageFilePath);
		$data = json_decode($storage, true);

        echo "\n> MEMBERS foo";
        $result = getKeyMembers($data,"foo");

        echo "\n> MEMBERS bad";
        getKeyMembers($data,"bad");
        
        $this->assertEquals(2, count($result));

	    clearTestData($storageFilePath);
    }
}
