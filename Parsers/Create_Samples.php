<?php
$line = file("data/sample.txt");
$linenum = count($line);
for($i=0;$i<$linenum;$i++){
	$line[$i] = rtrim($line[$i]);
	$inc = $i + 1;
	echo "$inc\t$line[$i]\n";
}
?>
