<?php

define("kChannelWeb","Web");
define("kChannelMobile","Mobile");
define("kChannelOther","Other");

define("kActionTakePicture","TakePicture");
define("kActionSendMessage","SendMessage");

header('Content-type: text/json');
$json = null;
$channel = null;
$action = null;
$id = null;
$data = null;
$reqdate = null;

$method = $_SERVER['REQUEST_METHOD'];
if($method === "POST")
{
    $json_string = $GLOBALS['HTTP_RAW_POST_DATA'];
    if(ini_get("magic_quotes_gpc") == "1"){
        $json_string = stripslashes($json_string);
    }
    $json = json_decode($json_string);
}else{
    echo null;
}

if(!is_null($json)){
    $channel = strtolower($json->channel);
    $action = strtolower($json->action);
    $data = $json->data;
    $id = $json->id;

    if(is_null($channel) || is_null($action)){
        echo null;
    }elseif($channel === kChannelWeb || $channel === kChannelMobile){
        processRequest($channel,$action,$data,$id);
    }else{
        echo null;
    }
}else{
    echo null;
}

function processRequest($channel,$action,$data,$id){
    $errCode = -1;
    $result = false;

    if($action === kActionTakeCamera){
        $resultData = takePicture(0);
        $result = $resultData["result"];
        $errCode = $resultData["code"];
    }elseif($action === kActionSendMessage){
        $resultData = sendMessage("Test","Hello,world!");
        $result = $resultData["result"];
        $errCode = $resultData["code"];
    }
    $resp = generateResponse($channel,$action,$id,$result,$errCode);
    echo json_encode($resp);
}


function generateResponse($channel,$action,$id,$result,$errCode){
    $resp = array (
        "channel" => $channel,
        "action" => $action,
        "id"   => $id,
        "status" => $result,
        "errCode" => $errCode
    );
    return $resp;
}

function takePicture($cameraId){
    return array("result"=>true,"code"=>0);
}

function sendMessage($title,$message){
    //now suppport Pushover
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

    return array("result"=>true,"code"=>0);
}
?>