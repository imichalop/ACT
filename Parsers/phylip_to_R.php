<?php
//Usage: php phylip_to_R.php <Phylip-formatted distance matrix> 
if($argc==2){
  $line = file($argv[1]); //Read the Phylip file
  $file_name = explode(".",$argv[1]); //Keep the name
  $write_path = $file_name[0].".dist"; 
//echo __DIR__."/$write_path\n";
  $fh = fopen(__DIR__ . "/$write_path", "w") or die("Unable to open file!"); //Create and write the .dist file in the same directory
  $linenum = count($line);
  
  for($i=1;$i<$linenum;$i++){ //Disregard 1st line
    $line[$i] = rtrim($line[$i]);
    $arr = explode("\t",$line[$i]);
    $arr[$i] = 0.0; //Create the diagonal values
    $arr2[0] = $arr[0]; //Create the identical values
    for($y=1;$y<$linenum;$y++){
      if(abs($arr[$y])<1E-13){ //Safety check for extreme values
        $arr[$y] = 0.0;
      }
      $arr2[$y] = $arr[$y];
    }
    $name[$i] = $arr[0];
  }
  
  $header = implode("\t",$name); 
  fwrite($fh,"$header\n");  //Create and write the first row of the new file
  for($i=1;$i<$linenum;$i++){
    $line[$i] = rtrim($line[$i]);
    $arr = explode("\t",$line[$i]);
    $arr[$i] = 0.0;
    $arr2[0] = $arr[0];
	for($y=1;$y<$linenum;$y++){
            if(abs($arr[$y])<1E-13){ //Safety check for extreme values
                $arr[$y] = 0.0;
            }
            $arr2[$y] = $arr[$y];
	}
	$name[$i] = $arr[0];
	$line[$i] = implode("\t",$arr);
	$line2[$i] = implode("\t",$arr2);
	fwrite($fh,"$line2[$i]\n");
  }
  
  fclose($fh);
}
else{
  die("Usage: php $argv[0] <Phylip-formatted distance matrix>\n");
}
?>
