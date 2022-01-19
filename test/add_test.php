<?php
use PHPUnit\Framework\TestCase;

class add_test extends TestCase {

    public function testAdd(){
        include('../dictionary.php');
        $data = array("keys" =>  array(), "members" => array());
        $result = addKey($data, $storageFilePath,"foo","bar3");

        echo "\n> ADD foo bar";
        addKey($data, $storageFilePath,"foo","bar");
        $storage = file_get_contents($storageFilePath);
        $data = json_decode($storage, true);

        echo "\n> ADD foo baz";
        addKey($data, $storageFilePath,"foo","baz");
        $storage = file_get_contents($storageFilePath);
        $data = json_decode($storage, true);

        echo "\n> ADD foo bar";
        addKey($data, $storageFilePath,"foo","baz");
        $storage = file_get_contents($storageFilePath);
        $data = json_decode($storage, true);

        echo "\n> MEMBERS foo";
        $result = getKeyMembers($data,"foo");
        $this->assertEquals(2, count($result));

	    clearTestData($storageFilePath);
    }
}
