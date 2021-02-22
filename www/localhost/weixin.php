<?php

$accessToken = '41_F0UyBJib6MAT4yrPTupvqFqvRJE7GjWLEHwtgngx-M0FADeNcjrdwgMIFK9aTT2yE_aPLsa-kJrm_eHd5zG4FMFD3I4QodaCoZaYt9CwUjp_zJ2nfocziC0o_XUDPlFrNs9sLveGiQwtwEv8FEKaAHAKJP';
$url      = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $accessToken;
$data = [
  "touser" => "o28QAvyW73VDRaEQSNANozIJWXlM",
  "template_id" => "bszOTD4My8favnH7HuSeS2EYVRc0aDSg6POh3-A_ux4",
  "data" => [
    "first" => ["value" => '测试'],
    "keyword1" => ["value" => 'keywor1'],
    "keyword2" => ["value" => 'keywor2'],
    "keyword3" => ["value" => 'keywor3'],
    "remark" => ["value" => "备注信息"],
  ]
];
$data = json_encode($data, 256);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$output = curl_exec($ch);
curl_close($ch);
var_dump($output);
