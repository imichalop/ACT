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
            $chip=$match[7]; //We only use the chip information
            $chip=str_replace(".1sq","",$chip);
            $sample = explode("/",$file[$i]);
            $sample_num = count($sample);
            $last_num1 = $sample_num -2;
            $last_num2 = $sample_num -1;
            echo "$sample[$last_num1]\t$sample[$last_num2]\t$chip\n"; //Print Series, Sample and Chip info
            //echo strpos($chip,4)."\n";
            /*if(substr($chip, 0, 4)!="ATH1"){
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
