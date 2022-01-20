<?php
//Usage: php Uncompress_and_Convert.php <Series main directory>
$main_directory = rtrim($argv[1],"/"); //trim directory input

if(is_dir($main_directory) && $argc==2){
  $dir=scandir($main_directory);
  $dirnum=count($dir);
  for($y=2;$y<$dirnum;$y++){
    $dirpath = "$main_directory"."/"."$dir[$y]";
    echo "$dirpath\n";
    exec("unzip $dirpath/*.zip 2>&1", $retArr, $retVal);
    exec("gunzip $dirpath/*.gz 2>&1", $retArr, $retVal);
    exec("tar -xvf $dirpath/*.tar 2>&1", $retArr, $retVal);
    exec("apt-cel-convert -f text -i $dirpath/*.CEL");
  }
  for($y=2;$y<$dirnum;$y++){
    $flag = 0;
    $dirpath = "$main_directory"."/"."$dir[$y]";
    $files = scandir($dirpath);
    $filenum = count($files);
    for($i=0;$i<$filenum;$i++){
        $rest = substr($files[$i], -4);
        if($rest ==".cel" || $rest== ".CEL"){
            $flag=1;
        }
    }
    if($flag==0){
        exec("rm -rf $dirpath");
    }
  }
}
else{
  die("Usage: php $argv[0] <Series main directory>\n");
}
?>
