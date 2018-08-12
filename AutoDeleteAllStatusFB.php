<?php


$access_token = "EAAAAAYsX7TsBAMdRB5wqcL0uihozM8Chww4eVDU7g2YNPHSszZBoH8rTwZBXwmveqGpZBLmnOMnIXcEjq5M8JqQ8aVvs6DKgBusriNtL3otS4gGbOpFLKff8LksdONmjQEcBca9Ypfkmu3g6hMDXMsAfbYbOwidwlpqMa0FY6SG7Hrzut5oXGKPGaYQkcwfuwmdHYKDCFZArbsSzBZCM1";
$limit = "1000";
/*
************************************************************
****|   SCRIPT DELETE ALL STATUS BY MUCHLIS FAROQI     |****
************************************************************
*/
function auto($url){
$data = curl_init();
curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($data, CURLOPT_URL, $url);
$hasil = curl_exec($data);
curl_close($data);
return $hasil;
}
unlink ('dataLog');
if(file_exists('dataLog')){ $log=json_encode(file('dataLog')); }else{ $log=''; }
$stat=json_decode(auto('https://graph.beta.facebook.com/me/feed?fields=id,from&limit='.$limit.'&access_token='.$access_token),true);
for($i=1;$i<=count($stat[data]);$i++){
if(!ereg($stat[data][$i-1][id],$log)){
$x=$stat[data][$i-1][id]."\n";
$y=fopen('dataLog','a');
fwrite($y,$x);
fclose($y);
auto('https://graph.beta.facebook.com/'.$stat[data][$i-1][id].'?access_token='.$access_token.'&method=delete');
echo 'Status <span style="color:red">'.$stat[data][$i-1][from][name].'</span> berhasil di hapus ... <span style="color:green">[ <a href="http://facebook.com/'.$stat[data][$i-1][from][id].'" target="blank">CEK PROFIL</a> ]</span><hr/>';
}
}
?>