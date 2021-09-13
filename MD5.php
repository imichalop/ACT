<?php
// --------------------------------------------------------------------
// A fast and simple simple script that finds the MD5 hash keys
// for all files within a folder and compares them in order to
// detect duplicates.
//
// --------------------------------------------------------------------
// How to execute this script from the command line interface (CLI):
// "path/to/php" "path/to/this_script.php" "path/to/CEL_directory/"
//
// --------------------------------------------------------------------
// If you do not have PHP (CLI) installed in your computer, you can
// download the latest version from http://php.net/downloads.php
//
// --------------------------------------------------------------------
// Author: Apostolos Malatras, email: apmalatras@biol.uoa.gr
// Date: April 21, 2016
// --------------------------------------------------------------------

$argument_1 = $argv[1];

if(is_dir($argument_1)){
	$dir=scandir($argument_1);
	$dirnum=count($dir);
	
	//calculate hash keys
	for($i=2;$i<$dirnum;$i++){
		$dir[$i]=trim($dir[$i]);
		//Hash array
		$md5array[$dir[$i]] = md5_file("$argument_1/$dir[$i]");
	}
	//compare
	$dup=array();
	$rep=array();
	foreach(array_count_values($md5array) as $val => $c){
		if($c > 1){
			$dup[] = $val;
		}
	}
	foreach($dup as $key_dup => $val_dup){
		foreach($md5array as $key_md5 => $val_md5){
			if($val_dup == $val_md5){
				$rep[$val_dup].= "$key_md5\t";
			}
		}
		$rep[$val_dup] = trim($rep[$val_dup]);
	}
	
	if($rep==NULL){
		echo "No duplicate files detected\n";
	}else{
		print_r($rep);
	}
}else{
	die("First argument must be a directory\n");
}
?>
