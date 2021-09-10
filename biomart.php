<?php
if($argc!=3) {
  echo "Usage:\nphp $argv[0] <xml filename> <column number>\n";
}
else {
  $table=findtable($argv[1]);
  $colnum=$argv[2];
  biomart($table,$colnum);
  //echo "$url\n";
  //$biomart=file_get_contents($url);
  //printf("%s",$biomart);
  //echo $biomart;
}
function findtable($xml) {
  $arr=explode(".",$xml);
  $table=$arr[0];
  return $table;
}
function biomart($table,$colnum) {
  $line=file($table.".xml");
  $linenum=count($line);
  $command="wget -q -O ".$table.".biomart 'https://apps.araport.org:443/thalemine/service/query/results?format=tab&query=";
  for($i=0;$i<$linenum;$i++) {
    $command.=trim($line[$i]);
  }
  $command.="'";
  //echo "$command\n";
  exec($command);
  $line=file($table.".biomart");
  $linenum=count($line);
  for($i=0;$i<$linenum;$i++) {
    $line[$i]=trim($line[$i]);
    if(count(explode("\t",$line[$i]))==$colnum) {
      echo "$line[$i]\n";
    }
  }
  unlink($table.".biomart");
}
?>
