<?php
use PHPUnit\Framework\TestCase;

class remove_test extends TestCase {

    public function testRemove(){
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


        echo "\n> REMOVE foo bar";
        $result = removeMember($data, $storageFilePath,"foo","bar");
        $storage = file_get_contents($storageFilePath);
        $data = json_decode($storage, true);

        echo "\n> REMOVE foo bar";
        removeMember($data, $storageFilePath,"foo","bar");
        $storage = file_get_contents($storageFilePath);
        $data = json_decode($storage, true);

        echo "\n> KEYS";
        getKeys($data);

        echo "\n> REMOVE foo baz";
        removeMember($data, $storageFilePath,"foo","baz");
        $storage = file_get_contents($storageFilePath);
        $data = json_decode($storage, true);

        echo "\n> KEYS";
        getKeys($data);

        echo "\n> REMOVE boom pow";
        removeMember($data, $storageFilePath,"boom","pow");
        
        if ($result == "Removed") {
            $this->assertEquals("Removed", $result);
        }else{
            $this->assertEquals("ERROR, member does not exist", $result);
        }

	    clearTestData($storageFilePath);
    }
}
