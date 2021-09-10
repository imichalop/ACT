<?php
$file=file_get_contents("https://www.genome.jp/dbget-bin/get_linkdb?-t+pathway+gn:T00041");
$file=strip_tags($file);
$file=str_replace("             ","\t",$file);
$line=explode("\n",$file);
$linenum=count($line);
//print_r($line);
for($i=0;$i<$linenum;$i++){
  $line[$i]=trim($line[$i]);
  if(!strncmp($line[$i],"ath",3)) {
    echo "$line[$i]\n";
  }
}
?>
