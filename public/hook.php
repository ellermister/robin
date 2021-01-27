<?php
/**
 * Created by PhpStorm.
 * User: ellermister
 * Date: 2021/1/27
 * Time: 20:44
 */
// Load composer
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../functions.php';
define('ROOT_PATH', dirname(__DIR__));

$bot_api_key = env('BOT_API_KEY');
$bot_username = env('BOT_USERNAME');

try {
    // 验证 token 及 username 是否为空
    if(!$bot_api_key || !$bot_username){
        throw new Exception("BOT_API_KEY、BOT_USERNAME 未配置", 400);
    }

    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

    $telegram->addCommandsPaths([ROOT_PATH.'/Commands']);

    // Handle telegram webhook request
    $telegram->handle();
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // log telegram errors
    // echo $e->getMessage();
    ee_json($e->getMessage(), $e->getCode());
}catch (Exception $exception){
    ee_json($exception->getMessage(), $exception->getCode());
}catch (Throwable $throwable){
    ee_json($throwable->getMessage(), $throwable->getCode());
}