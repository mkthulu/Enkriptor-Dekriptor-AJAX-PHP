<?php

$q = $_REQUEST["q"];
$cipher_method = 'AES-128-CTR';
$key = 'ahmadkhotibulu';
$init_vector = '0000000020330047';

$output = '-';
if ($q !== '') {
  if ($decrypt = openssl_decrypt($q, $cipher_method, $key, 0, $init_vector)) {
    $output = $decrypt;
  }
}

echo $output;

?>