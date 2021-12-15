<?php
//Usage: php phylip_to_R.php <Phylip-formatted distance matrix> 
ini_set('memory_limit',-1);
if($argc==2){
  $line = file($argv[1]); //Read the Phylip file
  //$file_name = explode(".",$argv[1]); //Keep the name
  //$write_path = $file_name[0].".dist"; 
  //echo __DIR__."/$write_path\n";
  //$fh = fopen(__DIR__ . "/$write_path", "w") or die("Unable to open file!"); //Create and write the .dist file in the same directory
  $linenum = count($line);
  
  for($i=2;$i<$linenum;$i++){ //Disregard 1st line
    $line[$i] = rtrim($line[$i]);
    $arr = explode("\t",$line[$i]);
    $name[$i] = $arr[0];
  }
  
  $header = implode("\t",$name);
  echo "$header\n";  //Create and write the first row of the new file
  for($i=2;$i<$linenum;$i++){
    $line[$i] = rtrim($line[$i]);
    $arr = explode("\t",$line[$i]);
    $arrnum = count($arr);
    for($y=0;$y<$arrnum-1;$y++){
	$arr2[$y] = $arr[$y+1]; 
    }
    //$line[$i] = implode("\t",$arr);
    $line2[$i] = implode("\t",$arr2);
    echo "$line2[$i]\n";
  }
}
else{
  die("Usage: php $argv[0] <Phylip-formatted distance matrix>\n");
}
?>
