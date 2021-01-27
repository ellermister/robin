<?php
/**
 * Created by PhpStorm.
 * User: ellermister
 * Date: 2021/1/27
 * Time: 19:43
 */

/**
 * 获取GET/POST/REQUEST参数
 * @param $name
 * @param null $default
 * @return null
 */
function get_input($name, $default = null)
{
    return $_REQUEST[$name] ?? $default;
}

/**
 * JSON响应
 *
 * @param $message
 * @param $code
 * @param null $data
 */
function ee_json($message, $code, $data = null)
{
    $format = [
        'message' => $message,
        'code'    => $code,
        'data'    => $data
    ];
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($format,JSON_UNESCAPED_UNICODE);
}

/**
 * 增加环境变量配置获取
 *
 * @param $name
 * @param null $default
 * @return |null
 */
function env($name, $default = null)
{
    static $envRaw = null;

    $env = ROOT_PATH . DIRECTORY_SEPARATOR . '.env';
    if (is_file($env)) {
        if ($envRaw == null) {
            $envRaw = file_get_contents($env);
        }
        if (preg_match('/' . $name . '\s*\=\s*"?(\S+)"?/is', $envRaw, $matches)) {
            return $matches[1] ?? $default;
        }
    }
    return $default;
}