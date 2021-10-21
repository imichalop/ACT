<?php
function numsysconv($num,$base) {
  $str=str_split("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ\$_");

  $logbase=log($num)/log($base);
  $int=floor($logbase);

  $conv="";
  for($i=$int;$i>=0;$i--) {
    $dec=floor($num/pow($base,$i));
    $mod=$num%pow($base,$i);
    $conv.=$str[$dec];
    $num=$mod;
  }
  return $conv;
}

//$conv=numsysconv($num,64);
?>
