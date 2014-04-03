<?php
$method = $_SERVER['REQUEST_METHOD'];
$type = NULL;

if($method === "GET")
{
    $type = $_GET["type"];
    if(!is_null($type)){
        if(strtolower($type) === "sendmessage"){
            sendPushoverMessage("test","hello,world");
        }
    }
}

function sendPushoverMessage($title,$message){
    curl_setopt_array($ch = curl_init(), array(
        CURLOPT_URL => "https://api.pushover.net/1/messages.json",
            CURLOPT_POSTFIELDS => array(
                "token" => "ae8stbH21emfZD8uBUt5sK6NgLUJ8z",
                "user" => "u9mqqPxNdjYoB9NkJdmiSf8djtw8nM",
                "message" => $message,
                "title" =>  $title
            )
        ));
    curl_exec($ch);
    curl_close($ch);
}
?>