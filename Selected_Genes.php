<?php
$line=file("all_probesets.txt");
$linenum=count($line);
for($i=0;$i<$linenum;$i++){
  $line[$i]=trim($line[$i]);
  $gene[$line[$i]]=0;
//  echo "$line[$i]\t0\n";
}

$line=file("ENSG.txt");
$linenum=count($line);
for($i=0;$i<$linenum;$i++){
  $line[$i]=trim($line[$i]);
  $arr=explode("\t",$line[$i]);
  if(isset($gene[$arr[0]])) {
    $gene[$arr[0]]=1;
  }
}
//print_r($gene);
foreach ($gene as $key => $value) {
  if($value) {
    echo "$key\n";
  }
}
?>
