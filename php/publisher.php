<?php

require_once(__DIR__ . '/vendor/autoload.php');

define("RABBITMQ_HOST", "localhost");
define("RABBITMQ_PORT", 5672);
define("RABBITMQ_USERNAME", "guest");
define("RABBITMQ_PASSWORD", "guest");
define("RABBITMQ_QUEUE_NAME", "task_queue");

$connection = new \PhpAmqpLib\Connection\AMQPStreamConnection(
    RABBITMQ_HOST, 
    RABBITMQ_PORT, 
    RABBITMQ_USERNAME, 
    RABBITMQ_PASSWORD
);

$channel = $connection->channel();

# Create the queue if it does not already exist.
$channel->queue_declare(
    $queue = RABBITMQ_QUEUE_NAME,
    $passive = false,
    $durable = true,
    $exclusive = true,
    $auto_delete = false,
    $nowait = false,
    $arguments = null,
    $ticket = null
);


for($job_id=0,$sleeper=10; $job_id < 10; $job_id++,$sleeper-- ){
    $jobArray = array(
        'id' => $job_id,
        'task' => 'sleep',
        'sleep_period' => $sleeper
    );

    $msg = new \PhpAmqpLib\Message\AMQPMessage(
        json_encode($jobArray, JSON_UNESCAPED_SLASHES),
        array('delivery_mode' => 2) #    message persistent
    );

    $channel->basic_publish($msg, '', RABBITMQ_QUEUE_NAME);
    print 'Job created ' . PHP_EOL;
    echo " $job_id:$sleeper \n";
    sleep(1);
}
