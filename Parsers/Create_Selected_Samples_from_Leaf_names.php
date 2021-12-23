<?php
//Usage: php Create_Selected_Samples_from_Leaf_names.php <Tree leaf names> 
include("dbc.php");
if($argc==2){
        $line = file($argv[1]);
        $linenum = count($line);
        for($i=0;$i<$linenum;$i++){
                $line[$i] = rtrim($line[$i]);
                $arr = explode('.', $line[$i], 2);
                $SampleID[$i] = $arr[1];
                $StudyID[$i] = $arr[0];
                $query = "select SampleIndex from Samples natural join Sample where Sample.SampleID = '$SampleID[$i]' and Sample.StudyID='$StudyID[$i]'";
                //echo "$query\n";
                $result = mysqli_query($link,$query);
                while ($myrow=mysqli_fetch_array($result)) {
                        echo "$myrow[0]\n";
                }   
        }
}
else{
    die("Usage: php $argv[0] <Tree leaf names>\n");
}
?>
