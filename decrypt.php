<?php

$q = $_REQUEST["q"];
$cipher_method = 'AES-128-CTR';
$key = 'ahmadkhotibulu';
$init_vector = '0000000020330047';

$output = '-';
if ($q !== '') {
  $q = str_replace(' ', '+', $q);
  $q = str_replace('%20', '+', $q);
  if ($decrypt = openssl_decrypt($q, $cipher_method, $key, 0, $init_vector)) {
    $output = $decrypt;
  } else {
    $output = 'Enkripsi gagal.';
  }
}

echo $output;

?>