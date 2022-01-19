<?php
use PHPUnit\Framework\TestCase;

class clear_test extends TestCase {

    public function testClear(){
        include('../dictionary.php');
        $data = array("keys" =>  array(), "members" => array());

        echo "\n> ADD foo bar";
        addKey($data, $storageFilePath,"foo","bar");
		$storage = file_get_contents($storageFilePath);
		$data = json_decode($storage, true);

        echo "\n> ADD bang zip";
        addKey($data, $storageFilePath,"bang","zip");
		$storage = file_get_contents($storageFilePath);
		$data = json_decode($storage, true);

        echo "\n> KEYS";
        getKeys($data);

        echo "\n> CLEAR";
        $result = clearData($storageFilePath);
        $storage = file_get_contents($storageFilePath);
        $data = json_decode($storage, true);
        
        echo "\n> KEYS";
        getKeys($data);

        echo "\n> CLEAR";
        $result = clearData($storageFilePath);
        $storage = file_get_contents($storageFilePath);
        $data = json_decode($storage, true);

        echo "\n> KEYS";
        getKeys($data);

        $this->assertEquals("Cleared", $result);
    }
}
