<?php
/**
 * Created by PhpStorm.
 * User: ellermister
 * Date: 2021/1/27
 * Time: 21:20
 */
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../functions.php';

$bot_api_key  = get_input('token');
$bot_username = get_input('username');
$chat_id = get_input('chat_id');
$text = get_input('text','');
$photo = get_input('photo','');

try {
    // 验证 token 及 username 是否为空
    if(!$bot_api_key || !$bot_username){
        throw new Exception("token、username 参数无效", 400);
    }

    // 验证文本消息或者图片参数是否为空
    if(!$text && !$photo){
        throw new Exception("text、photo 参数至少需要一个", 400);
    }

    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);
    if($text){
        $result = \Longman\TelegramBot\Request::sendMessage([
            'chat_id' => $chat_id,
            'text'    => $text,
        ]);
    }
    if($photo){
        $result = \Longman\TelegramBot\Request::sendPhoto([
            'chat_id' => $chat_id,
            'photo'   => $photo,
        ]);
    }
    if($result->isOk()){
        ee_json('ok', 200, $result->getResult());
    }else{
        ee_json('ok', 500, $result->getErrorCode());
    }

} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // log telegram errors
    // echo $e->getMessage();
    ee_json($e->getMessage(), $e->getCode());
}catch (Exception $exception){
    ee_json($exception->getMessage(), $exception->getCode());
}catch (Throwable $throwable){
    ee_json($throwable->getMessage(), $throwable->getCode());
}