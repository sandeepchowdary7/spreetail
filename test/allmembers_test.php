<?php
use PHPUnit\Framework\TestCase;

class allmembers_test extends TestCase {

    public function testAllmembers(){
        include('../dictionary.php');
        $data = array("keys" =>  array(), "members" => array());
        echo "\n> ALLMEMBERS";
        getAllMembers($data);

        echo "\n> ADD foo bar";
	    addKey($data, $storageFilePath,"foo","bar");
		$storage = file_get_contents($storageFilePath);
		$data = json_decode($storage, true);

        echo "\n> ADD foo baz";
        addKey($data, $storageFilePath,"foo","baz");
		$storage = file_get_contents($storageFilePath);
		$data = json_decode($storage, true);

        echo "\n> ALLMEMBERS";
        getAllMembers($data);
        
        echo "\n> ADD bang bar";
        addKey($data, $storageFilePath,"bang","bar");
		$storage = file_get_contents($storageFilePath);
		$data = json_decode($storage, true);

        echo "\n> ADD bang baz";
        addKey($data, $storageFilePath,"bang","baz");
		$storage = file_get_contents($storageFilePath);
		$data = json_decode($storage, true);

        $members = getAllMembers($data);

        $this->assertEquals(4, count($members));
	    clearTestData($storageFilePath);
    }
}
?>
