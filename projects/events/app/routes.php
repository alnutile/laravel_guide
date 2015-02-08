<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Event::listen('example1', function()
{
	sleep(5);
	Log::info("Event one listener 1 is Triggered");
});

Event::listen('example1', function()
{
	sleep(5);
	Log::info("Event two listener 2 is Triggered");
});

Route::get('/example1', function()
{
	Event::fire('example1');
	return "Event Example 1";
});

$subscriber = new \Acme\ExampleEventHandler;

Event::subscribe($subscriber);

Event::listen('example2', function($state)
{
	$state->total = $state->total + 5;
	var_dump(sprintf("From The listener one state %s <br>", $state->total));

	Log::info(sprintf("Event two listener 1 is Triggered total %s", $state->total));
});

Event::listen('example2', function($state)
{
	$state->total = $state->total + 5;
	var_dump(sprintf("From The listener two state %s <br>", $state->total));

	Log::info(sprintf("Event two listener 2 is Triggered total %s", $state->total));
});

Route::get('/example2', function()
{
	$state = new stdClass();
	$state->total = 0;
	Event::fire('example2', array($state));

	return sprintf("Event Example 2 data total state %s", $state->total);
});
