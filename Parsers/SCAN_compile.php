<?php
//Usage: php SCAN_compile.php <Series main directory>
$main_directory = rtrim($argv[1],"/"); //trim directory input
//$path_of_arg = realpath($argv[1]);
if(is_dir($main_directory) && $argc==2){
  $fh = fopen('expression.txt', 'a') or die("Unable to open file!");
  $dir=scandir($main_directory);
  $dirnum=count($dir);
  for($y=2;$y<$dirnum;$y++){
    $dirpath = "$main_directory"."/"."$dir[$y]";
    $file = scandir($dirpath);
    $filenum = count($file);
    for($x=2;$x<$filenum;$x++){
      if($file[$x]=="SCAN_matrix.txt"){
        $line = file("$dirpath"."/"."$file[$x]");
        $linenum = count($line);
        $sample = explode("\t",rtrim($line[0]));
        $samplenum = count($sample);
        $study = $file[$y];
        for($i=0;$i<$samplenum;$i++){
          for($j=1;$j<$linenum;$j++){
            $sample_col = $i + 1;
            $probeset = explode("\t",rtrim($line[$j]));
            $part = implode('.', explode('.', $sample[$i], -1));
            if(substr($probeset[0],0,4)!="AFFX"){
              //echo "$part\t$study\t$arr[0]\t$arr[$sample_col]\n";
              fwrite($fh,"$part\t$study\t$probeset[0]\t$probeset[$sample_col]\n");    
            }
          }
        }            
      }        
    }
  }
  fclose($fh);
}
else{
  die("Usage: php $argv[0] <Series main directory>\n");
}
?>
