<?php
include "leafnamestoarr.php";
//$tree = $argv[2];
$newickf=file($argv[1]);
$newickfnum=count($newickf);
// If more than one line; like clustalw
$linef="";
for($i=0;$i<$newickfnum;$i++){
	$newickf[$i]=trim($newickf[$i]);
	$linef.=$newickf[$i];
}
$leaffnum=substr_count($linef, ',');
$leaffnum+=1;
$names=leafnames($newickf);
//replace zibiiiiit82,83
$names=str_replace("zibiiiiit82","(",$names);
$names=str_replace("zibiiiiit83",")",$names);
$namesnum=count($names);
for($i=0;$i<$namesnum;$i++){
	$names[$i]=trim($names[$i],"'");
	echo "$names[$i]\n";
}
?>
