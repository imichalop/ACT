<?php
$fh1 = fopen("PO.txt", "w");
$fh2 = fopen("PO_Alt.txt", "w");
$file=file_get_contents("http://purl.obolibrary.org/obo/po.obo");
$line=explode("\n",$file);
$linenum=count($line);
for($i=0;$i<$linenum;$i++){
  if($line[$i]=="[Term]") {
    $j=$i+1;
    $k=$i+2;
    $l=$i+3;
    $POID=substr($line[$j],4);
    $desc=substr($line[$k],6);
    $aspect=substr($line[$l],11);
    fwrite($fh1, "$POID\t$desc\t$aspect\n");
    fwrite($fh2, "$POID\t$POID\n");
    $m=$i+4;
    while (!strncmp($line[$m],"alt_id:",7)) {
      $alt_id=substr($line[$m],8);
      fwrite($fh2, "$alt_id\t$POID\n");
      $m++;
    }
  }
}
?>
