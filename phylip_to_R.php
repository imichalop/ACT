<?php
$line = file($argv[1]);
$file_name = explode(".",$argv[1]);
$write_path =  $file_name[0].".dist";
//echo __DIR__."/$write_path\n";
$fh1 = fopen(__DIR__ . "/$write_path", "w");
$linenum = count($line);

for($i=1;$i<$linenum;$i++){
	$line[$i] = rtrim($line[$i]);
	$arr = explode("\t",$line[$i]);
	$arr[$i] = 0.0;
	$arr2[0] = $arr[0];
	for($y=1;$y<$linenum;$y++){
		if(abs($arr[$y])<1E-13){
			$arr[$y] = 0.0;
		}
                $arr2[$y] = $arr[$y];
	}
	$name[$i] = $arr[0];
}

$kek = implode("\t",$name);
fwrite($fh1,"$kek\n");
for($i=1;$i<$linenum;$i++){
	$line[$i] = rtrim($line[$i]);
	$arr = explode("\t",$line[$i]);
	$arr[$i] = 0.0;
	$arr2[0] = $arr[0];
	for($y=1;$y<$linenum;$y++){
		if(abs($arr[$y])<1E-13){
			$arr[$y] = 0.0;
		}
		$arr2[$y] = $arr[$y];
	}
	$name[$i] = $arr[0];
	$line[$i] = implode("\t",$arr);
	$line2[$i] = implode("\t",$arr2);
	fwrite($fh1,"$line2[$i]\n");
}

fclose($fh1);
?>
