<?php

function addKey($data, $storageFilePath, $key, $member){
	$msg = "";
	if (!in_array($key, $data["keys"])) {
		$data["keys"][] = $key;

		try {
			$data["members"][] = array('key_id' => $key, "name" => $member);
			$msg = "Added";
		} catch(Exception $e) {
			$msg = "Error while adding";
		}
	} else{
		$memberExists = false;
		foreach ($data["members"] as $m) {
			if ($m["key_id"] == $key && $m["name"] == $member) {
				$memberExists = true;
			}
		}

		if (!$memberExists) {
			$data["members"][] = array('key_id' => $key, "name" => $member);
			$msg = "Added";
		} else{
			$msg = "ERROR, member already exists for key";
		}
	}

	echo "\n".$msg;
	file_put_contents($storageFilePath, json_encode($data));
	return $msg;
}

function getKeys($data){
	$i = 0;
	foreach ($data["keys"] as $ky) {
		$i++;
		echo "\n".$i.") ".$ky;
	}

	if ($i == 0) {
		echo "\n"."empty set";
	}
	return $data["keys"];
}

function removeKey($data, $storageFilePath, $key){
	$msg = "";
	if (isset($data["keys"][0])) {
		$keyCount = array_count_values($data["keys"])[$key];
		//check if record exist
		if ($keyCount > 0) {
			//Delete members
			foreach ($data["members"] as $ky => $value){
				if ($value["key_id"] == $key) {
					unset($data["members"][$ky]);
				}
			}
			//Delete key
			foreach ($data["keys"] as $ky => $value){
				if ($value == $key) {
					unset($data["keys"][$ky]);
				}
			}
			$msg = "Removed";
		} else {
			$msg = "ERROR, key does not exist";
		}
	} else {
		$msg = "ERROR, key does not exist";
	}

	echo "\n".$msg;
	file_put_contents($storageFilePath, json_encode($data));
	return $msg;
}

function KeyExists($data, $key){
	$msg = "";
	if (isset($data["keys"][0])) {
		$i = 0;
		foreach ($data["keys"] as $ky) {
			if ($ky == $key) {
				$i++;
			}
		}

		if ($i > 0) {
			$msg = "true";
		} else{
			$msg = "false";
		}
	} else{
		$msg = "false";
	}

	echo "\n".$msg;
	return $msg;
}

function clearData($storageFilePath){
	//Clear data
	$data = array("keys" =>  array(), "members" => array());
	file_put_contents($storageFilePath, json_encode($data));
	if (count($data["keys"]) == 0) {
		echo "\n"."Cleared";
		return "Cleared";
	} else{
		return "Error";
	}
}

function getKeyMembers($data, $key){
	$membersFound = 0;
	foreach ($data["members"] as $member){
		if ($member["key_id"] == $key) {
			$membersFound++;
			echo "\n".$membersFound.") ".$member["name"];
		}
	}

	if ($membersFound == 0) {
		echo  "\n"."ERROR, key does not exist";
	}
	return $data["members"];
}

function getAllMembers($data){
	$i = 0;
	foreach ($data["members"] as $member) {
		$i++;
		echo "\n".$i.") ".$member["name"];
	}
	if ($i == 0) {
		echo "\n (empty set)";
	}
	return $data["members"];
}

function removeMember($data, $storageFilePath, $key, $member){
	$memberCount = 0;
	$keyCount = 0;
	$msg = "";
	$deleted = false;
	foreach ($data["members"] as $ky => $value) {
		if ($value["key_id"] == $key) {
			$keyCount++;
		}
		if ($value["key_id"] == $key && $value["name"] == $member) {
			$memberCount++;
			$deleted = true;
			unset($data["members"][$ky]);
		}
	}
	//Delete from key if the member deleted was the last one
	if ($keyCount == 1) {
		if ($deleted) {
			foreach ($data["keys"] as $ky => $val){
				if ($val == $key) {
					unset($data["keys"][$ky]);
				}
			}
		}
	}
	if ($memberCount != 0) {
		$msg = "Removed";
	} else{
		$msg = "ERROR, member does not exist";
	}

	echo "\n".$msg;
	file_put_contents($storageFilePath, json_encode($data));
	return $msg;
}

function memberExists($data, $key, $member){
	$membersFound = 0;
	foreach ($data["members"] as $m){
		if ($m["key_id"] == $key && $m["name"] == $member) {
			$membersFound++;
		}
	}

	if ($membersFound > 0) {
		echo "\n"."true";
		return "true";
	} else{
		echo "\n"."false";
		return "false";
	}
}

function keyMemberPair($data){
	$i = 0;
	foreach ($data["members"] as $member) {
		$i++;
		echo "\n".$i.") ".$member["key_id"].": ".$member["name"];
	}

	if ($i == 0) {
		echo "\n"."empty set";
	}
	return $data["members"];
}

function clearTestData($storageFilePath){
	//Clear test data
	$data = array("keys" =>  array(), "members" => array());
	file_put_contents($storageFilePath, json_encode($data));
}
