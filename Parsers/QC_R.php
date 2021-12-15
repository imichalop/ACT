<?php
include("usec.php");
$Rdir="/usr/bin";
$temp_dir = "tmp";
$rand = usec();
$R_path = "$Rdir/R";
$R_options_1 = " --slave --no-save";
$r_name = $rand;
$r_input = $temp_dir."/".$r_name.".R";
$r_output = $temp_dir."/".$r_name.".Rout";

exec("rm -f  $r_input");
exec("rm -f  $r_output");

//Usage: php Find_Non_ATH1.php <Series main directory>
$main_directory = rtrim($argv[1],"/"); //trim directory input
$j=0;

if(is_dir($main_directory) && $argc==2){
  $dir=scandir($main_directory);
  $dirnum=count($dir);
  for($y=2;$y<$dirnum;$y++){
    $dirpath = "$main_directory"."/"."$dir[$y]";
    echo "$dirpath\n";
    exec("Rscript Parsers/script.R $dirpath");
    $line = file("$dirpath/NUSE.txt");
    $linenum = count($line);
    for($i=1;$i<$linenum;$i++){
      $line[$i] = rtrim($line[$i]);
      //echo "$line[$i]\n";
      $nuse = explode("\t",$line[$i]);
      $sample_name = trim($nuse[0],'"');
      $sample_path = $dirpath."/".$sample_name;
      $sample[$sample_path] = $sample_name;
      $twentyfive = $nuse[2];
      $med_nuse[$sample_path] = $nuse[3];
      $seventyfive = $nuse[4];
      $iqr_nuse[$sample_path] = $seventyfive - $twentyfive;
      //echo "$sample[$sample_path]\t$iqr_nuse[$sample_path]\n";
    }
    //echo "\n";
    $line = file("$dirpath/RLE.txt");
    $linenum = count($line);
    for($i=1;$i<$linenum;$i++){
      $line[$i] = rtrim($line[$i]);
      //echo "$line[$i]\n";
      $rle = explode("\t",$line[$i]);
      $sample_name = trim($rle[0],'"');
      $sample_path = $dirpath."/".$sample_name;
      $twentyfive = $rle[2];
      $med_rle[$sample_path] = $nuse[3];
      $seventyfive = $rle[4];
      $iqr_rle[$sample_path] = $seventyfive - $twentyfive;
      //echo "$sample[$sample_path]\t$iqr_rle[$sample_path]\n";
    }
    //echo "\n";
    $line = file("$dirpath/PP.txt");
    $linenum = count($line);
    $ptotal = 0;
    for($i=1;$i<$linenum;$i++){
      $line[$i] = rtrim($line[$i]);
      //echo "$line[$i]\n";
      $qcs = explode("\t",$line[$i]);
      $sample_name = trim($qcs[0],'"');
      $sample_name = trim($sample_name,".present");
      $sample_path = $dirpath."/".$sample_name;
      $pp[$sample_path] = $qcs[1];
      $ptotal += $pp[$sample_path];
      //echo "$sample[$sample_path]\t$pp[$sample_path]\n";
    }
    //echo "\n";
    $pmed = $ptotal/$linenum;
    foreach ($sample as $key => $value){
      if($iqr_rle[$key]>4 || ($med_rle[$key] > 0.2 && $med_rle[$key] < -0.2)){
        echo "Cut RLE: $iqr_rle[$key]\t$key\n";
        //unlink($key);
        
      }
      elseif($med_nuse[$key] > 1.1){
        echo "Cut Nuse: $iqr_nuse[$key]\t$key\n";
        //unlink($key);
      }
      elseif(($pp[$key] > $pmed+10 || $pp[$key] < $pmed-10)){
        echo "Cut Percent Present: $pp[$key]\t$key\n";
        //unlink($key);
      }
    }
  }
}else{
  die("Usage: php $argv[0] <Series main directory>\n");
}
?>
