<?php
//Usage: php Uncompress_and_Covnert.php <Series main directory>
$main_directory = rtrim($argv[1],"/"); //trim directory input

if(is_dir($main_directory) && $argc==2){
  $dir=scandir($main_directory);
  $dirnum=count($dir);
  for($y=2;$y<$dirnum;$y++){
    $dirpath = "$main_directory"."/"."$dir[$y]";
    echo "$dirpath\n";
    exec("unzip $dirpath/*.zip");
    exec("gunzip $dirpath/*.gz");
    exec("apt-cel-convert -f text -i $dirpath/*.CEL");
  }
}
else{
  die("Usage: php $argv[0] <Series main directory>\n");
}
?>
