<?php
//Usage: php Find_Non_ATH1.php <Series main directory>
$main_directory = rtrim($argv[1],"/"); //trim directory input

if(is_dir($main_directory) && $argc==2){
  $dir=scandir($main_directory);
  $dirnum=count($dir);
  for($y=2;$y<$dirnum;$y++){
    $dirpath = "$main_directory"."/"."$dir[$y]";
    echo "$dirpath\n";
    $file=scandir($dirpath);
    $filenum=count($file);
    for($i=0;$i<$filenum;$i++){
      $file[$i] = "$dirpath"."/"."$file[$i]";
      $rest = substr($file[$i], -4);
      //$pos=strpos($rest,".cel");
      if($rest ==".cel" || $rest== ".CEL"){ //Check only .CEL files
        //echo "$file[$i]\n";
        $line=file("$file[$i]");
        $linenum=count($line);
        for($j=0;$j<$line;$j++){
          //echo $line[$j];
          if(!strncmp($line[$j],"DatHeader", 9)){ //Chip Information is on the DatHeader line
            $pattern="/(\d{2})\/(\d{2})\/(\d{2})\s(\d{2})\:(\d{2})\:(\d{2}).+\s(.+\.1sq)/i"; //RegEx pattern to get time and chip data
            preg_match($pattern,$line[$j],$match);
	    $M=$match[1];
	    $d=$match[2];
	    $y=$match[3];
	    $h=$match[4];
	    $m=$match[5];
	    $s=$match[6];
	    $chip=$match[7];
	    $chip=str_replace(".1sq","",$chip);
	    $time=mktime($h,$m,$s,$M,$d,$y);
	    echo "$file[$i]\t$chip\t".date('d/m/Y G:i:s',$time)."\n";
	    //echo strpos($chip,4)."\n";
            /*if(strpos($chip,4)!="ATH1"){
              unlink($file[$i]);        //Delete files CEL files that are not from ATH1 chip platform
              echo "Deleted $file[$i]\n";
              }*/
            break;
          }
        }
      }
    }
  }
}
else{
  die("Usage: php $argv[0] <Series main directory>\n");
}
?>
