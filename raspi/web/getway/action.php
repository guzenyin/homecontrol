<?php

define("kChannelWeb","web");
define("kChannelMobile","mobile");
define("kChannelOther","other");

define("kActionTakePicture","takepicture");
define("kActionSendMessage","sendmessage");

header('Content-type: text/json');
$json = null;
$channel = null;
$action = null;
$reqId = null;
$data = null;
$reqDate = null;

$method = $_SERVER['REQUEST_METHOD'];
if($method === "POST")
{
    $json_string = file_get_contents("php://input");
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
    $reqId = $json->reqId;
    $reqDate = $json->reqDate;

    if(is_null($channel) || is_null($action)){
        echo null;
    }elseif($channel === kChannelWeb || $channel === kChannelMobile){
        processRequest($channel,$action,$data,$reqId);
    }else{
        echo null;
    }
}else{
    echo null;
}

function processRequest($channel,$action,$data,$id){
    $errCode = -1;
    $result = false;
    $data = array();
    
    if($action === kActionSendMessage){
        $resultData = sendMessage("Test","Hello,world!");
        $result = $resultData["result"];
        $errCode = $resultData["code"];
    }
    $resp = generateResponse($channel,$action,$id,$result,$errCode);
    echo json_encode($resp);
}


function generateResponse($channel,$action,$id,$result,$errCode,$data){
    $resp = array (
        "channel" => $channel,
        "action" => $action,
        "reqid"   => $id,
        "status" => $result,
        "errCode" => $errCode
    );
    return $resp;
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

function sendMail($to,$subject,$body){
    $result = TRUE;      
    $from = "password@orcbit.com";
    $host = "ssl://smtp.sendgrid.net";
    $port = "465";
    $username = "orcbit";
    $password = "gungYi516";



    $headers = array ('From' => $from,
                       'To' => $to,
                       'Subject' => $subject,
                       'Content-Type' => 'Content-Type: text/html; charset=UTF-8'
                     );
    $mime_params = array(
      'text_encoding' => '7bit',
      'text_charset'  => 'UTF-8',
      'html_charset'  => 'UTF-8',
      'head_charset'  => 'UTF-8'
    );

    $mime = new Mail_mime();
    $mime->setHTMLBody($body);

    $body = $mime->get($mime_params);
    $headers = $mime->headers($headers);

    $smtp = Mail::factory('smtp',array ('host' => $host,
                                         'port' => $port,
                                         'auth' => true,
                                         'username' => $username,
                                         'password' => $password
                                         ));
    $mail = $smtp->send($to, $headers, $body);

    if(PEAR::isError($mail)){
        $result = FALSE;
        
        print($mail->getMessage());
    }

    return $result;
}

?>
