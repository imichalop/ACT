<?php
$line = file("data/probeset.txt");
$linenum = count($line);
for($i=0;$i<$linenum;$i++){
	$line[$i] = rtrim($line[$i]);
	$arr =  explode("\t",$line[$i]);
	$probeset = $arr[0];
	$inc = $i +1;
	echo "$inc\t$probeset\n";
}
?>
