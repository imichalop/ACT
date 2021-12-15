<?php
//Usage: php $argv[0] expression.txt
if($argc==2){
    $line = file($argv[1]);
    $linenum = count($line);
    for($i=0;$i<$linenum;$i++){
        $line[$i] = rtrim($line[$i]);
        $arr = explode("\t",$line[$i]);
        $probeset = $arr[2];
        $gene = substr($probeset, 0, -3);
        echo "$probeset\t$gene\n";
    }
}
else{
    die("Usage: php $argv[0] data/expression.txt\n");
}
?>
