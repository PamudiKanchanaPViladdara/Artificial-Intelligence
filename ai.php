<?php

$userimg=$_POST["txturl"];
//echo $userimg;

$myObj = new stdClass();
$myObj->url = $userimg;
$myJSON = json_encode($myObj);

$url = "https://southcentralus.api.cognitive.microsoft.com/customvision/v3.0/Prediction/d6975500-64a4-4ab8-98c4-0848e6f0a0c2/classify/iterations/Iteration1/url";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Prediction-Key: 9d4b7787d65340c2a210386a592543f2",
   "Content-Type: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = $myJSON;

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
//var_dump($resp);
//response - $resp

$dataR=json_decode($resp);
$tag=$dataR->predictions[0]->tagName;
echo "$tag";

?>