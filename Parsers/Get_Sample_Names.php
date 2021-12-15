<?php
//Usage: php Get_Sample_Names.php <Series main directory>
$main_directory = rtrim($argv[1],"/"); //trim directory input

if(is_dir($main_directory) && $argc==2){
  $dir=scandir($main_directory);
  $dirnum=count($dir);
  for($y=2;$y<$dirnum;$y++){
    $dirpath = "$main_directory"."/"."$dir[$y]";
    //echo "$dirpath\n";
    $file=scandir($dirpath);
    $filenum=count($file);
    for($i=0;$i<$filenum;$i++){
      $file[$i] = "$dirpath"."/"."$file[$i]";
      $rest = substr($file[$i], -4);
      //$pos=strpos($rest,".cel");
      if($rest ==".cel" || $rest== ".CEL"){ //Check only .CEL files
        //echo "$file[$i]\n";
        $sample = explode("/",$file[$i]);
        $sample_num = count($sample);
        $last_num = $sample_num -1;
        echo "$sample[$last_num]\n";        
      }
    }
  }
}
else{
  die("Usage: php $argv[0] <Series main directory>\n");
}
?>
