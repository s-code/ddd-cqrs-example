<?php

$conn = new AMQPConnection([
    'host' => 'rabbitmq',
    'port' => '5672',
    'vhost' => '/',
    'login' => 'guest',
    'password' => 'guest',
]);
$conn->connect();

$channel  = new AMQPChannel($conn);
$targetExchange = new AMQPExchange($channel);
$targetExchange->setName('amq.topic');
$defaultExchange = new AMQPExchange($channel);

// this will be kind out long-living queue to
$q_request = new AMQPQueue($channel);
$q_request->setName('reply-to-requests');
$q_request->setFlags(AMQP_DURABLE);
$q_request->declareQueue();

$q_request->bind($targetExchange->getName(), '#');

$q_request->consume(function (AMQPEnvelope $envelope) use ($defaultExchange) {
    sleep(5);
    $defaultExchange->publish('response: ' . $envelope->getBody(), $envelope->getReplyTo());
}, AMQP_AUTOACK);
