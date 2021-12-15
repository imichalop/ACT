<?php
include("dbc.php");

$query="select Selected_Samples.SampleIndex,SampleID,StudyID from Selected_Samples,Samples where Selected_Samples.SampleIndex=Samples.SampleIndex order by Selected_Samples.SampleIndex";
$result=mysqli_query($link,$query);
$i=0;
while ($myrow=mysqli_fetch_array($result)) {
  $sample[$i]="$myrow[2].$myrow[1]";
  $corrsample[$myrow[0]]=$i;
  $i++;
}
//print_r($sample);
//print_r($corrsample);
 $samplenum= $i;

$query="select ProbeSetIndex, ProbeSetID from ProbeSet natural join Selected_Genes natural join ProbeSets";
$result=mysqli_query($link,$query);
$i=0;
while ($myrow=mysqli_fetch_array($result)) {
  $probeset[$i]=$myrow[1];
  $corrprobeset[$myrow[0]]=$i;
  $i++;
}

//print_r($probeset);
//print_r($corrprobeset);

$probesetnum= $i;


$query="select Selected_Samples.SampleIndex,ProbesetIndex, Expression from ProbeSet natural join ProbeSets natural join Selected_Genes,Selected_Samples,Expression,Samples where Selected_Samples.SampleIndex=Samples.SampleIndex and Samples.SampleID=Expression.SampleID and Samples.StudyID=Expression.StudyID and Expression.ProbeSetID=ProbeSets.ProbeSetID";

$result=mysqli_query($link,$query);
while ($myrow=mysqli_fetch_array($result)) {
//  echo $corrsample[$myrow[0]]."\t".$corrprobeset[$myrow[1]]."\t$myrow[2]\n";
  $expression[$corrsample[$myrow[0]]][$corrprobeset[$myrow[1]]]=$myrow[2];
}

//print_r($expression);

convdata($expression,$samplenum,$probesetnum);

calcpcc($expression,$samplenum,$probesetnum,$sample);

function convdata(&$expdata, $colnum, $rawnum) {  
	for($i=0;$i<$colnum;$i++) {
		$sum=0;
		for($j=0;$j<$rawnum;$j++) {
			$sum+=$expdata[$i][$j];
		}
		$mean=$sum/$rawnum;
		//echo "$mean\n";
		for($j=0;$j<$rawnum;$j++) {
			$expdata[$i][$j]=$expdata[$i][$j]-$mean;
		}
		$sum=0;
		for($j=0;$j<$rawnum;$j++) {
			$sum+=$expdata[$i][$j]*$expdata[$i][$j];
		}
		$stdevp=sqrt($sum);
		//$stdevp=sqrt($sum/$rawnum);
		//echo "$stdevp\n";
		for($j=0;$j<$rawnum;$j++) {
			$expdata[$i][$j]=$expdata[$i][$j]/$stdevp;
		}
	}
}


function calcpcc($expdata, $colnum, $rawnum, $collist) {
	echo "$colnum\n";
	for($i=0;$i<$colnum;$i++) {
		echo "$collist[$i]";
		for($j=0;$j<$colnum;$j++) {
			$pcc=0;
			for($k=0;$k<$rawnum;$k++) {
				$pcc+=$expdata[$i][$k]*$expdata[$j][$k];
			}
			//$pcc/=$rawnum;
			if($pcc>=1.0) {
				$pcc=1.0;
			}
			$dist=1.0-$pcc;
			if(abs($dist)<1E-13){
				$dist = 0.0;
			}
			echo "\t$dist";
		}
		echo "\n";
	}
}

?>
