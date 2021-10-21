<?php
include "numsysconv.php";
// Use: $usec=usec();
function usec() {
  list($usec, $sec) = explode(" ", microtime());
  $usec= 1000000*($usec + $sec);

  $usec=sprintf("%d",$usec); 
/*
  $sec=$time[sec]-3660*$time[dsttime]+$time[minuteswest]*60-1234567890;
  $usec=sprintf("%d%06d",$sec,$time[usec]);
*/
  $usec=numsysconv($usec,64);
  return $usec;
}
?>
