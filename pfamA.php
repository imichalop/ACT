<?php
$line=file("pfamA.txt");
$linenum=count($line);
for($i=0;$i<$linenum;$i++) {
  $arr=explode("\t",$line[$i]);
  echo "$arr[0]\t$arr[1]\t$arr[3]\n";
}
unlink("pfamA.txt");
?>
