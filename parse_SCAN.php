<?php
$line = file($argv[1]);
$linenum = count($line);
$sample = explode("\t",rtrim($line[0]));
$samplenum = count($sample);
for($i=0;$i<$samplenum;$i++){
	for($j=1;$j<$linenum;$j++){
		$sample_col = $i + 1;
		$arr = explode("\t",rtrim($line[$j]));
		echo "$sample[$i]\t$arr[0]\t$arr[$sample_col]\n";
	}
}
?>
