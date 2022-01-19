<?php
use PHPUnit\Framework\TestCase;

class removeall_test extends TestCase {

    public function testRemoveall(){
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

        echo "\n> KEYS";
        getKeys($data);

        echo "\n> REMOVEALL foo";
        $result = removeKey($data, $storageFilePath, "foo");
        $storage = file_get_contents($storageFilePath);
        $data = json_decode($storage, true);

        echo "\n> KEYS";
        getKeys($data);

        echo "\n> REMOVEALL foo";
        $result = removeKey($data, $storageFilePath, "foo");
        $storage = file_get_contents($storageFilePath);
        $data = json_decode($storage, true);

        
        if ($result == "Removed") {
            $this->assertEquals("Removed", $result);
        }else{
            $this->assertEquals("ERROR, key does not exist", $result);
        }
	    clearTestData($storageFilePath);
    }
}
