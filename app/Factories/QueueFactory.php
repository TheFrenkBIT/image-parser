<?php

namespace App\Factories;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class QueueFactory
{
    public array $consumedMessage = [];
    public function __construct(
        private readonly AMQPStreamConnection $connection,
    )
    {
    }

    public function publishMessage(string $message): void
    {
        $channel = $this->connection->channel();
        $channel->queue_declare('images', false, true, false, false);
        $channel->queue_bind('images', 'fanout');

        $message = new AMQPMessage($message);
        $channel->basic_publish($message, 'fanout');

        $channel->close();
    }

    public function consumeMessage($callback): array
    {
        $channel = $this->connection->channel();

        $channel->basic_consume(
            'images',
            '',
            false,
            true,
            false,
            false,
            $callback);
        while ($channel->is_open()) {
            $channel->wait();
        }
        return $this->consumedMessage;
    }
    public function closeConnection(): void
    {
        $this->connection->close();
    }
}