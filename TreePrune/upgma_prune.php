<?php
include "manualcore.php";  //treetrim($newickfile, $protexist, $delp) //tree file, name of leaf, d for delete or r for retain
include "leafnamestoarr.php";

//php upgma_prune test_upgma_desc.tree 50

$newick = file($argv[1]);
$leaf_names = leafnames($newick);
$leafnum = count($leaf_names);
//echo "$leafnum\n";
$finalleafnum = $argv[2];
$iterations=$leafnum-$finalleafnum;


for($i=0;$i<$iterations;$i++){
  $newick = prune($newick);

}
echo "$newick[0]\n";
$leaf_names = count(leafnames($newick));
//echo "$leaf_names\n";


function prune($newick){
    //print_r($line);
    #output array
    $newicknum = count($newick);
    $leaf_dist_to_node=array();
    if($newick){
            for($i=0;$i<$newicknum;$i++){
                    #explode commas => leaves
                    $expcomma=explode(",",$newick[$i]);
                    foreach($expcomma as $key=>$value){
                            #explode distance
                            $expsemi=explode(":",$value);
                            #trim parenthesis
                            $expsemi[0]=trim($expsemi[0],"()");
                            $expsemi[1]=trim($expsemi[1],"()");
                            #save to array sample as key, distance as value
                            $leaf_dist_to_node[$expsemi[0]]=$expsemi[1];
                    }
            }
        //$leaf_names = leafnames("samples_R_arc_clean_upgma_desc.tree");
        $index[0] = array_search( min($leaf_dist_to_node),$leaf_dist_to_node);
        //echo "$index[0]\n";
        $prunewick[0] = treetrim($newick, $index, "d");
        return $prunewick;

    }
}
?>
