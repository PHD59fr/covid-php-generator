<?php
function encrypt_decrypt($action,$token, $string){
    $output = false;
    $encrypt_method = "AES-256-CBC";

    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $token), 0, 16);

    if ($action == 'encrypt'){
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }else{
        if ($action == 'decrypt'){
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
    }
    return $output;
}
?>
