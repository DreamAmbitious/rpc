# Why Use RPC pattern
This pattern is used when a remote procedure/function is triggered and need to wait for the  result or completion of execution.

# Is RPC synchronous - Why
It is pretty common for apps to process requests as multiple flows and sub flows that is required to wait for the completion of execution at the remote system. Then assemble responses from various flows/sub-flows as response to the client. Which most of them can be processed parallelly.

RPC Queues can be used as(and/or) for asynchronous remote task processing system that returns the aggregate results using RabbitMQ.

# Illustration
The sample code illustrates how to send and receive request/responses to rpc_queue.

The sleep is induced to delay the responses from the worker. So as to illustrate, how to deal with client batch processing.

# References
[Rabbitmq](https://www.rabbitmq.com/tutorials/tutorial-six-python.html)
