<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class FibonacciRpcClient
{
    // Hold the class instance.
    private static $instance = null;
    private $connection;
    public  $channel;
    private $callback_queue;
    public $responseArr;
    public $uniqArr;
    public $uniqid;

    private function __construct()
    {
        //uniqid to collect the batch results
        $this->uniqid = uniqid();
        $this->connection = new AMQPStreamConnection(
            'localhost', # host
            5672,   # port
            'guest', # username
            'guest' # password
        );
        $this->channel = $this->connection->channel();
        list($this->callback_queue, ,) = $this->channel->queue_declare(
            "", # queue
            false, # passive
            false, # durable
            true, # exclusive
            false # auto_delete
        );
        $this->channel->basic_consume(
            $this->callback_queue, # queue
            '', # consumer_tag
            false, # no_local
            false, # no_ack
            false, # exclusive
            false, # nowait
            array( # callback
                $this,
                'onResponse'
            )
        );
    }

    public static function getInstance()
    {
      if(!self::$instance)
      {
        self::$instance = new FibonacciRpcClient();
      }
     
      return self::$instance;
    }

    public function onResponse($rep)
    {
        
      if (in_array($rep->get('correlation_id'),$this->uniqArr)) {
            echo ' [.] Got response for ID',$rep->get('correlation_id'),':', $rep->body, "\n";
            $this->responseArr[$rep->get('correlation_id')] = $rep->body;
        }
    }

    public function call()
    {
        /* let's just create and push the message to queue
        * Not wait for response
        */
        for($job_id=0,$sleeper=10; $job_id < 10; $job_id++,$sleeper-- ){
            $this->uniqArr[] = $this->uniqid.'_'.$job_id;
            $msg = new AMQPMessage(
                (string) $sleeper,
                array(
                    'correlation_id' =>$this->uniqid.'_'.$job_id,
                    'reply_to' => $this->callback_queue
                )
            );
            echo "Sending message ".$this->uniqid.'_'.$job_id."\n";
            $this->channel->basic_publish(
                $msg,  #message
                '', #exchange
                'rpc_queue'  #routing key
            );
        }
        return;
    }

    public function wait(){
        while(count($this->responseArr) < 10){
            $this->channel->wait();
        }
    }

}
$fibonacci_rpc = FibonacciRpcClient::getInstance();
$fibonacci_rpc->call();
$fibonacci_rpc->wait();
echo "our final response array in the received order \n";
print_r($fibonacci_rpc->responseArr);