<?php
$line=file("AtRegNet.csv");
$linenum=count($line);
for($i=1;$i<$linenum;$i++){
	$arr=explode(",",$line[$i]);
	if(count($arr)>12) {
		if(!strcmp(strtoupper(trim($arr[4])),"AT") || !strcmp(strtoupper(trim($arr[4])),"DUF617") || !strcmp(strtoupper(trim($arr[4])),"LSM DOMAIN") || !strcmp(strtoupper(trim($arr[4])),"N-TERMINAL DOMAIN") || !strncmp(strtoupper(trim($arr[4])),"PUTATI",6)) {
			echo strtoupper(trim($arr[5])."\t".trim($arr[1])."\n");
		}
		else if(!strcmp(strtoupper(trim($arr[4])),"CLASS IB")) {
			echo strtoupper(trim($arr[6])."\t".trim($arr[1])."\n");
		}
		else if(!strcmp(strtoupper(trim($arr[4])),"FAMILY 705")) {
			echo strtoupper(trim($arr[7])."\t".trim($arr[1])."\n");
		}
		else if(!strcmp(strtoupper(trim($arr[4])),"\N")) {
			if(!strncmp(strtoupper(trim($arr[3])),"AT",2)) {
				echo strtoupper(trim($arr[3])."\t".trim($arr[1])."\n");
			}
		}
		else if(!strcmp(strtoupper(trim($arr[4])),"AT4G0663")) {
			echo strtoupper("AT4G13420\t".trim($arr[1])."\n");
		}
		else if(!strcmp(strtoupper(trim($arr[1])),"AT5G286660")) {
			echo strtoupper(trim($arr[4])."\tAT4G38620\n");
		}
		else if(strcmp(strtoupper(trim($arr[4])),"N/A")) {
			echo strtoupper(trim($arr[4])."\t".trim($arr[1])."\n");
		}
	}
}
unlink("AtRegNet.csv");
?>
