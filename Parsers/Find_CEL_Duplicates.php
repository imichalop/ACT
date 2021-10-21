<?php
//Usage: php Find_CEL_Duplicates.php <Series main directory>
$main_directory = rtrim($argv[1],"/"); //trim directory input

if(is_dir($main_directory) && $argc==2){
  $dir=scandir($main_directory);
  $dirnum=count($dir);
  for($y=2;$y<$dirnum;$y++){ //Disregard the first two listings of scandir
    //calculate hash keys
    $dirpath = "$main_directory/$dir[$y]";
    $file = scandir($dirpath); //Read the files of each subdirectory
    $filenum = count($file);
    for($i=2;$i<$filenum;$i++){
      //Hash array
      //$path = $path_of_main_directory."/".$dir[$y]."/".$file[$i];
      //$md5array[$path] = md5_file("$path_of_main_directory/$dir[$y]/$file[$i]");
      $rest = substr($file[$i], -4);
        if($rest == ".cel" || $rest == ".CEL"){   //Only check for .CEL files
            $path = "$main_directory/$dir[$y]/$file[$i]";
            $md5array[$path] = md5_file("$main_directory/$dir[$y]/$file[$i]");
        }
    }
    //compare
    $dup=array();
    $rep=array();
    foreach(array_count_values($md5array) as $val => $c){
      if($c > 1){
        $dup[] = $val;
      }
    }
    foreach($dup as $key_dup => $val_dup){
      $j = 0;
      foreach($md5array as $key_md5 => $val_md5){
        if($val_dup == $val_md5){
          $sample = explode("/",$key_md5);
          $sample_num = count($sample);
          $last_num = $sample_num -1;
          //Set a hash array of the repetitions
          if(!isset($rep[$val_dup])){
            $rep[$val_dup] = "$sample[$last_num]\t";
          }
          else{
            $rep[$val_dup].= "$sample[$last_num]\t";
          }
          //Set a second array with the full paths
          $rep1[$val_dup][$j] = $key_md5;
          $j++;
        }
      }
      $rep[$val_dup] = trim($rep[$val_dup]);
    }  
    
  }
  //Check for duplicates, then loop and print them
  if($rep==NULL){
    echo "No duplicate files detected\n";
  }else{
    //print_r($rep);
    echo "Duplicates found:\n\n";
    foreach($rep as $key => $value){
      echo "[$key] -> $value\n";
      $rep_num = count($rep1[$key]);
      //echo "$rep_num\n";
      for($x = 1;$x<$rep_num;$x++){
        $dupe = $rep1[$key][$x];
        //unlink($dupe);
        echo "Removed file $dupe\n";
      }
      echo "\n";
    }
  }
  
}else{
  die("Usage: php $argv[0] <Series main directory>\n");
}
?>
