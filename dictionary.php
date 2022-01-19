<?php

include 'functions.php';
$storageFilePath =__DIR__ ."/storage.json";
$storage = file_get_contents($storageFilePath);
$data = json_decode($storage, true);

if (!isset($data["keys"][0])) {
	$data = array("keys" =>  array(), "members" => array());
}


if (isset($argv[1])) {
	switch ($argv[1]) {
		case 'ADD':
			addKey($data, $storageFilePath, $argv[2], $argv[3]);
			break;
		case 'KEYS':
			getKeys($data);
			break;				
		case 'MEMBERS':
			getKeyMembers($data, $argv[2]);
			break;
		case 'REMOVE':
			removeMember($data, $storageFilePath, $argv[2], $argv[3]);
			break;		
		case 'REMOVEALL':
			removeKey($data, $storageFilePath, $argv[2]);		
			break;
		case 'CLEAR':
			clearData($storageFilePath);
			break;
		case 'KEYEXISTS':
			KeyExists($data, $argv[2]);		
			break;
		case 'MEMBEREXISTS':
			memberExists($data, $argv[2], $argv[3]);		
			break;						
		case 'ALLMEMBERS':
			getAllMembers($data);		
			break;	
		case 'ITEMS':
			keyMemberPair($data);		
			break;					
		default:
			break;
	}
}
