<?php
use PHPUnit\Framework\TestCase;

class memberexists_test extends TestCase {

    public function testMemberexists(){
        include('../dictionary.php');
        $data = array("keys" =>  array(), "members" => array());
        echo "\n> MEMBEREXISTS foo bar";
        memberExists($data, "foo", "bar");

        echo "\n> ADD foo bar";
        addKey($data, $storageFilePath,"foo","bar");
		$storage = file_get_contents($storageFilePath);
		$data = json_decode($storage, true);

        echo "\n> MEMBEREXISTS foo bar";
        $result = memberExists($data, "foo", "bar");

        echo "\n> MEMBEREXISTS foo baz";
        memberExists($data, "foo", "baz");
        
        if ($result == "true") {
            $this->assertEquals("true", $result);
        }else{
            $this->assertEquals("false", $result);
        }
	    clearTestData($storageFilePath);
    }
}
