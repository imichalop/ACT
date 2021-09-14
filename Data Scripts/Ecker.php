<?php
$dir    = 'genes';
$files = scandir($dir);
$filesnum = count($files);
for($i=2;$i<$filesnum;$i++){
    //echo "$files[$i]\n";
    $dir1 = "genes/$files[$i]";
    $files1 = scandir($dir1);
    $files1num = count($files1);
    for($k=2;$k<$files1num;$k++){
        /*if(strpos("$files1[$k]","amp")){
            echo "$files1[$k]\n";
            //$k++;
        }*/
        if(!strpos("$files1[$k]","amp")){
            //echo "$files1[$k]\n";
            $dir2 = "genes/$files[$i]/$files1[$k]/chr1-5";
            $files2 = scandir($dir2);
            $line=file("genes/$files[$i]/$files1[$k]/chr1-5/$files2[2]");
            $linenum = count($line);
            for($y=1;$y<$linenum;$y++){
                $line[$y] = rtrim($line[$y]);
                $arr = explode("\t",$line[$y]);
                $tf=$arr[0];
                $target=$arr[1];
                echo "$target\t$tf\n";
                //echo "$line[$y]\n";
            }
        }
    }
}
/*$dir1 = "genes/$files[2]";
$files1 = scandir($dir1);
$dir2 = "genes/$files[2]/$files1[2]/chr1-5";
$files2 = scandir($dir2);
$line=file("genes/$files[2]/$files1[2]/chr1-5/$files2[2]");
$linenum = count($line);
for($i=1;$i<$linenum;$i++){
    $line[$i] = rtrim($line[$i]);
    echo "$line[$i]\n";
}
print_r($files);
print_r($files1);
print_r($files2);*/




?>
