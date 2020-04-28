<?php

$admin = '698857288';
$token = '1124952210:AAFDh4sBYZO5jUI8sJJ5LyRhDx-C3buUf3c';

function bot($method,$datas=[]){
global $token;
    $url = "https://api.telegram.org/bot".$token."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
function send($id,$msg,$mid,$rmsg=false,$rurl=false){
  bot('sendmessage',[
	'chat_id'=>$id,
	'text'=>$msg,
'reply_to_message_id'=>$mid,
'parse_mode'=>html,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>$rmsg,'url'=>$rurl]]
],
])
	]);
}
function sendd($id,$msg,$mid){
  bot('sendmessage',[
	'chat_id'=>$id,
	'text'=>$msg,
'reply_to_message_id'=>$mid,
'parse_mode'=>html,
	]);
}
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$mid = $message->message_id;
$cid = $message->chat->id;
$rmid= $message->reply_to_message->message_id;
$replytx = $message->reply_to_message->text;

$type = $message->chat->type;
$text = $message->text;
$xabar=show_users($text);
if($replytx){
  insert($replytx,$text);
sendd($cid,$xabar,$mid);
}elseif($text){
sendd($cid,$xabar,$mid);
}

switch ($text) {
    case "/start":
send($cid,"Botdan foydalanmoqchi bolganingiz uchun tashakkur.😊",$mid,"Guruhga qo'shish","https://t.me/aqluzbot?startgroup=new");
break;
case "/start@aqluzbot":
send($cid,"Salom.
Men guruhni maksimal darajada faol qilib beraman.G'irt bepulga",$mid,"Guruhga qo'shish","https://t.me/aqluzbot?startgroup=new");
}
?>
