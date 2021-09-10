<?php
$fh1 = fopen("GO.txt", "w");
$fh2 = fopen("GO_Alt.txt", "w");
$file=file_get_contents("http://purl.obolibrary.org/obo/go.obo");
$line=explode("\n",$file);
$linenum=count($line);
for($i=0;$i<$linenum;$i++){
  if($line[$i]=="[Term]") {
    $j=$i+1;
    $k=$i+2;
    $l=$i+3;
    $GOID=substr($line[$j],4);
    $desc=substr($line[$k],6);
    $aspect=substr($line[$l],11);
    fwrite($fh1, "$GOID\t$desc\t$aspect\n");
    fwrite($fh2, "$GOID\t$GOID\n");
    $m=$i+4;
    while (!strncmp($line[$m],"alt_id:",7)) {
      $alt_id=substr($line[$m],8);
      fwrite($fh2, "$alt_id\t$GOID\n");
      $m++;
    }
  }
}
?>
