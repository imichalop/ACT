<?php
$fh1=fopen("WikiPathways.txt", "w");
$fh2=fopen("Entrez_WP.txt", "w");

$file = file_get_contents('http://data.wikipathways.org/current/gmt/');
$file=strip_tags($file);
$line=explode("\n",$file);
$linenum=count($line);
for($i=0;$i<$linenum;$i++) {
  $line[$i]=trim($line[$i]);
  $pos=strpos($line[$i], "Arabidopsis_thaliana");
  if($pos!== false) {
    $url="http://data.wikipathways.org/current/gmt/$line[$i]";
  }
}
$file = file_get_contents($url);
$file=strip_tags($file);
$line=explode("\n",$file);
$linenum=count($line);
for($i=0;$i<$linenum;$i++) {
  $line[$i]=trim($line[$i]);
//  echo "$line[$i]\n";
  if($line[$i]!="") {
    $arr=explode("\t",$line[$i]);
    $arr1=explode("%",$arr[0]);
    $arr2=explode("/",$arr[1]);
//
    fwrite($fh1, "$arr2[4]\t$arr1[0]\n");
    $arrnum=count($arr);
    for($j=2;$j<$arrnum;$j++) {
      fwrite($fh2, "$arr[$j]\t$arr2[4]\n");
    }
  }
}
fclose($fh1);
fclose($fh2);

?>
