<?php
//Usage: php Create_Selected_Samples.php <Sample names> 
include("dbc.php");
if($argc==2){
        $line = file($argv[1]);
        $linenum = count($line);
        for($i=0;$i<$linenum;$i++){
                $line[$i] = rtrim($line[$i]);
                $SampleID[$i] = $line[$i];
                $query = "select SampleIndex from Samples natural join Sample where Sample.SampleID = '$SampleID[$i]'";
                //echo "$query\n";
                $result = mysqli_query($link,$query);
                while ($myrow=mysqli_fetch_array($result)) {
                        echo "$myrow[0]\n";
                }   
        }
}
else{
    die("Usage: php $argv[0] <Sample names>\n");
}
?>
