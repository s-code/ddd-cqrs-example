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

$q_reply_to = new AMQPQueue($channel);
$q_reply_to->setName('amq.rabbitmq.reply-to');
$q_reply_to->consume(null, AMQP_AUTOACK);

echo 'Publishing request...' . PHP_EOL;

$targetExchange->publish('request', 'message', AMQP_NOPARAM, array('reply_to' => 'amq.rabbitmq.reply-to'));

echo 'Waiting for reply...' . PHP_EOL;
//$timeout = 20;
//$endTime = time() + $timeout;
//$response = null;
//$sleepInterval = 10;
//do {
//    $envelop = $q_reply_to->get(AMQP_JUST_CONSUME);
//
//    if ($envelop !== false) {
//        $response = $envelop->getBody();
//        break;
//    }
//
//    usleep($sleepInterval);
//    $sleepInterval++;
//} while ($endTime > time());
//
//echo $response;

//$channel->waitForBasicReturn();

$q_reply_to->consume(function (AMQPEnvelope $message, AMQPQueue $queue) {
    echo $message->getBody() . ': ' . $message->getRoutingKey() . PHP_EOL;

    echo 'Received on ', $queue->getName(), ' queue', PHP_EOL;

    return false;
}, AMQP_JUST_CONSUME);

echo 'done', PHP_EOL;