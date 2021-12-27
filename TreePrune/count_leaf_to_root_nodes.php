<?php


function leaftorootnodes($newick){
	//require "prep.php";
	
	//$newick=file("$newickfile");
	$newicknum=count($newick);
	
	$line=preprocess($newick,$newicknum);
	$exp=explode(",",$line);
	$expnum=count($exp);
	
	$patternopenpar="/\(/i";
	$patternclosepar="/.*?\)/i";
	
	$parenthesissum=array("");
	
	//count leaf to root nodes
	for($j=0;$j<$expnum;$j++){
		$parenthesissum[$j]=0;
		if(preg_match_all($patternclosepar,$exp[$j],$matchclose)){
			$parenthesissum[$j]=$parenthesissum[$j]-count($matchclose[0]);
		}
		if(preg_match_all($patternopenpar,$exp[$j],$matchopen)){
			$parenthesissum[$j]=$parenthesissum[$j]+count($matchopen[0]);
		}
		$leaftorootnodelength=0;
		for($i=count($parenthesissum);$i>=0;$i--){
			if($i==count($parenthesissum) && $parenthesissum[$i-1]<0){
				//avoids first node closeparenthesis
			}else{
				@$leaftorootnodelength+=$parenthesissum[$i-1];
			}
		}
		//echo "$j\t$leaftorootnodelength\n";
		$nodearr[$j] = $leaftorootnodelength;
	}
	return $nodearr;
}
?>
