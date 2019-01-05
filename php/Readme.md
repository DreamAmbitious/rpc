# Set-up

```
composer install
```

# Client
Trigger the client

```
php client.php
```

**Console Output**
```
lpt114@lpt114:~/workspace/php/rpc/php$ php client.php 
Sending message 5c30c8063df3e_0
Sending message 5c30c8063df3e_1
Sending message 5c30c8063df3e_2
Sending message 5c30c8063df3e_3
Sending message 5c30c8063df3e_4
Sending message 5c30c8063df3e_5
Sending message 5c30c8063df3e_6
Sending message 5c30c8063df3e_7
Sending message 5c30c8063df3e_8
Sending message 5c30c8063df3e_9
 [.] Got response for ID5c30c8063df3e_1:34
 [.] Got response for ID5c30c8063df3e_0:55
 [.] Got response for ID5c30c8063df3e_3:13
 [.] Got response for ID5c30c8063df3e_2:21
 [.] Got response for ID5c30c8063df3e_5:5
 [.] Got response for ID5c30c8063df3e_4:8
 [.] Got response for ID5c30c8063df3e_7:2
 [.] Got response for ID5c30c8063df3e_6:3
 [.] Got response for ID5c30c8063df3e_9:1
 [.] Got response for ID5c30c8063df3e_8:1
our final response array in the received order 
Array
(
    [5c30c8063df3e_1] => 34
    [5c30c8063df3e_0] => 55
    [5c30c8063df3e_3] => 13
    [5c30c8063df3e_2] => 21
    [5c30c8063df3e_5] => 5
    [5c30c8063df3e_4] => 8
    [5c30c8063df3e_7] => 2
    [5c30c8063df3e_6] => 3
    [5c30c8063df3e_9] => 1
    [5c30c8063df3e_8] => 1
)

```

# RPC Worker 
Trigger the worker

```
php server.php 
```

**Console Output Worker1**
```
 [x] Awaiting RPC requests
 [.] fib(10)
 [.] correlation_id(5c30c6e222763_0)
 [.] fib(7)
 [.] correlation_id(5c30c6e222763_3)
 [.] fib(6)
 [.] correlation_id(5c30c6e222763_4)
 [.] fib(3)
 [.] correlation_id(5c30c6e222763_7)
 [.] fib(2)
 [.] correlation_id(5c30c6e222763_8)
 [.] fib(9)
 [.] correlation_id(5c30c8063df3e_1)
 [.] fib(8)
 [.] correlation_id(5c30c8063df3e_2)
 [.] fib(5)
 [.] correlation_id(5c30c8063df3e_5)
 [.] fib(4)
 [.] correlation_id(5c30c8063df3e_6)
 [.] fib(1)
 [.] correlation_id(5c30c8063df3e_9)
```
**Console Output Worker2**

```
 [x] Awaiting RPC requests
 [.] fib(9)
 [.] correlation_id(5c30c6e222763_1)
 [.] fib(8)
 [.] correlation_id(5c30c6e222763_2)
 [.] fib(5)
 [.] correlation_id(5c30c6e222763_5)
 [.] fib(4)
 [.] correlation_id(5c30c6e222763_6)
 [.] fib(1)
 [.] correlation_id(5c30c6e222763_9)
 [.] fib(10)
 [.] correlation_id(5c30c8063df3e_0)
 [.] fib(7)
 [.] correlation_id(5c30c8063df3e_3)
 [.] fib(6)
 [.] correlation_id(5c30c8063df3e_4)
 [.] fib(3)
 [.] correlation_id(5c30c8063df3e_7)
 [.] fib(2)
 [.] correlation_id(5c30c8063df3e_8)
```

