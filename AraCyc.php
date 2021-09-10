<?php
$pathways=file_get_contents("https://pmn.plantcyc.org/groups/export?id=:ALL-PATHWAYS&tsv-type=FRAMES");
$pathway=explode("\n",$pathways);
$pathwaynum=count($pathway);
$fh1 = fopen("AraCyc.txt", "w");
$fh2 = fopen("ENSG_AraCyc.txt", "w");
for($i=1;$i<$pathwaynum;$i++){
  $pathway[$i]=trim($pathway[$i]);
  if($pathway[$i]!="") {
//    echo "https://pmn.plantcyc.org/ARA/pathway-genes?object=$pathway[$i]\n";
    $aracyc=@file_get_contents("https://pmn.plantcyc.org/ARA/pathway-genes?object=$pathway[$i]");
    if (strpos($http_response_header[0], "200")) { 
//      echo $aracyc;
      $line=explode("\n",$aracyc);
      $linenum=count($line);
      fwrite($fh1, "$pathway[$i]\t$line[0]\n");
      for($j=3;$j<$linenum;$j++){
	if($line[$j]!="") {
//	  echo "$line[$j]\n";
	  $arr=explode("\t",$line[$j]);
	  if($arr[1]!="") {
	    fwrite($fh2,"$arr[1]\t$pathway[$i]\n");
	  }
	}
      }
    }
  }
}
?>
