<?php

/**
 * This file is part of the PHP Telegram Bot example-bot package.
 * https://github.com/php-telegram-bot/example-bot/
 *
 * (c) PHP Telegram Bot Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Start command
 *
 * Gets executed when a user first starts using the bot.
 *
 * When using deep-linking, the parameter can be accessed by getting the command text.
 *
 * @see https://core.telegram.org/bots#deep-linking
 */

namespace Longman\TelegramBot\Commands\SystemCommands;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;

class StartCommand extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'start';

    /**
     * @var string
     */
    protected $description = 'Start command';

    /**
     * @var string
     */
    protected $usage = '/start';

    /**
     * @var string
     */
    protected $version = '1.2.0';

    /**
     * @var bool
     */
    protected $private_only = true;

    /**
     * Main command execution
     *
     * @return ServerResponse
     * @throws TelegramException
     */
    public function execute(): ServerResponse
    {
        // If you use deep-linking, get the parameter like this:
        // $deep_linking_parameter = $this->getMessage()->getText(true);

        $chatId = $this->getMessage()->getChat()->getId();
        Request::sendMessage([
            'chat_id' => $chatId,
            'text'    => '你好，我叫罗宾'
        ]);
        $result = Request::sendMessage([
            'chat_id' => $chatId,
            'text'    => '嗯'
        ]);
        $message_id = $result->getResult()->message_id;

        usleep(100000);
        Request::editMessageText([
            'chat_id'    => $chatId,
            'message_id' => $message_id,
            'text'       => '嗯…'
        ]);
        usleep(100000);
        Request::editMessageText([
            'chat_id'    => $chatId,
            'message_id' => $message_id,
            'text'       => '嗯……'
        ]);
        usleep(100000);
        // replyToChat
        Request::editMessageText([
            'chat_id'    => $chatId,
            'message_id' => $message_id,
            'text'       => '嗯……你是新来的冒险家吧！2级的话应该已经有SP了吧？SP分配好了吗？如果你不清楚SP是什么的话，就交给我吧。我会给你出问题。让你全面地了解属性点转职和SP相关的知识。'
        ]);
        Request::emptyResponse();
    }
}