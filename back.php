<?php
$response = isset($_POST['g-recaptcha-response'])?$_POST['g-recaptcha-response']:'';
$secret = '***your_secret***';
$remoteip = isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:'';
if($response != ''){
    $post_fields = array('response' => $response,'secret'=>$secret,'remoteip'=>$remoteip);
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $server_output = curl_post($url,$post_fields);
    print_r($server_output);
    if($server_output->success === true){
        echo "congrats";
    }else{
        echo "failure";
    }
}

function curl_post($url,$post_fields){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($post_fields));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec ($ch);
    curl_close ($ch);
    return json_decode($server_output);
}