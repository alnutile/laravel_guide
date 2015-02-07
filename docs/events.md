# Events

## Getting Started

See Events folder

Start the example

~~~
php artisan serve --port=8081
~~~

Then visit 

~~~
http://localhost:8081/example1
~~~

So if you look in

~~~
app/routes.php
~~~

You see route example1 will fire and event and there are two listeners

## Do they run async or sync

If you hit that [route](http://localhost:8081/example1) you see the sleep taking effect so it is syncronous 

See in the image below an example. I reload the page and the results are staggered by the sleep amount in the route. 

![sleep](img/events_delay.png)

On the left I have 
  
~~~
php artisan tail
~~~

Here is the route

~~~
Event::listen('example1', function()
{
	sleep(5);
	Log::info("Event one is Triggered");
});

Event::listen('example1', function()
{
	sleep(5);
	Log::info("Event two is Triggered");
});

Route::get('/example1', function()
{
	Event::fire('example1');
	return "Event Example 1";
});
~~~

So if you did not want to hold up the process you would place these into a queue.


## Passing data to events

How can Event 1 alter Event 2 see route 

The route would be [/example2](http://localhost:8081/example2)

~~~
Event::listen('example2', function(&$data)
{
	$data['foo'] = 5 + $data['foo'];
	Log::info(sprintf("Event two listener 1 is Triggered total %s", $data['foo']));
});

Event::listen('example2', function(&$data)
{
	$data['foo'] = 5 + $data['foo'];
	Log::info(sprintf("Event two listener 2 is Triggered total %s", $data['foo']));
});

Route::get('/example2', function()
{
	$data['foo'] = 0;
	Event::fire('example2', array(&$data));
	
	return sprintf("Event Example 2 data total %s", $data['foo']);
});
~~~