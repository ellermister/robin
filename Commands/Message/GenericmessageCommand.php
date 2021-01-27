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
 * Generic message command
 *
 * Gets executed when any type of message is sent.
 *
 * In this message-related context, we can handle any kind of message.
 */

namespace Longman\TelegramBot\Commands\SystemCommands;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;

class GenericmessageCommand extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'genericmessage';

    /**
     * @var string
     */
    protected $description = 'Handle generic message';

    /**
     * @var string
     */
    protected $version = '1.0.0';

    /**
     * Main command execution
     *
     * @return ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute(): ServerResponse
    {
        $message = $this->getMessage();

        /**
         * Handle any kind of message here
         */

        $message_text = $message->getText(true);

        $text = sprintf("from ID:  %s\n", $message->getFrom()->getId());
        $text .= sprintf("chat ID:  %s\n", $message->getChat()->getId());
        $text .= sprintf("message ID:  %s\n", $message->getMessageId());

        Request::sendMessage([
            'chat_id' => $message->getChat()->getId(),
            'text'    => '你好，我叫罗宾' . PHP_EOL . $text,
        ]);
        return Request::emptyResponse();
    }
}