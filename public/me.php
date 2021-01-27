<?php
/**
 * Created by PhpStorm.
 * User: ellermister
 * Date: 2021/1/27
 * Time: 19:38
 */
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../functions.php';

$bot_api_key  = get_input('token');
$bot_username = get_input('username');

try {
    // 验证 token 及 username 是否为空
    if(!$bot_api_key || !$bot_username){
        throw new Exception("token、username 参数无效", 400);
    }

    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);
    $result = \Longman\TelegramBot\Request::getMe();
    ee_json('ok', 200, $result->getResult());
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // log telegram errors
    // echo $e->getMessage();
    ee_json($e->getMessage(), $e->getCode());
}catch (Exception $exception){
    ee_json($exception->getMessage(), $exception->getCode());
}catch (Throwable $throwable){
    ee_json($throwable->getMessage(), $throwable->getCode());
}