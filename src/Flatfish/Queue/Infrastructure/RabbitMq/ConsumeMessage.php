<?php
/**
 * Flatfish Queue
 *
 * @author Rory Scholman <rory@roryy.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Flatfish\Queue\Infrastructure\RabbitMq;

use Flatfish\Queue\Consumable;
use PhpAmqpLib\Message\AMQPMessage;

class ConsumeMessage implements Consumable
{
    /**
     * @var AMQPMessage
     */
    private $message;

    /**
     * @var ChannelInterface
     */
    private $channel;

    public function __construct(AMQPMessage $message, ChannelInterface $channel)
    {
        $this->message = $message;
        $this->channel = $channel;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message->getBody();
    }

    /**
     * @return void
     */
    public function acknowledge(): void
    {
        $this->channel->acknowledge($this->message);
    }
}
