<?php

use EnaLog\EnaLogClient;
use EnaLog\EnaLogEventException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;

it('can push events to enalog', function () {
    $mock = new MockHandler([
        new Response(200, [], 'Event sent successfully'),
    ]);

    $handlerStack = HandlerStack::create($mock);
    $client = new Client(['handler' => $handlerStack]);

    $enalogClient = new EnaLogClient('hello-world', $client);

    $result = $enalogClient->pushEvent([
        'project' => 'hello-world',
        'name' => 'testing-php',
    ]);

    expect($result)->toBe('Event sent successfully');
});


it('can push events to enalog with all data', function () {
    $mock = new MockHandler([
        new Response(200, [], 'Event sent successfully'),
    ]);

    $handlerStack = HandlerStack::create($mock);
    $client = new Client(['handler' => $handlerStack]);

    $enalogClient = new EnaLogClient('hello-world', $client);

    $result = $enalogClient->pushEvent([
        'project' => 'hello-world',
        'name' => 'testing-php',
        'description' => 'hello world event description',
        'icon' => '👀',
        'tags' => ['hello', 'world'],
        'meta' => array(['meta' => 'data']),
        'channels' => array(),
        'user_id' => '1234'
    ]);

    expect($result)->toBe('Event sent successfully');
});


it('can raise enalog event exception when client exception is raised', function () {
    $mock = new MockHandler([
        new ClientException('Error Communicating with Server', new Request('GET', 'test'), new Response())
    ]);

    $handlerStack = HandlerStack::create($mock);
    $client = new Client(['handler' => $handlerStack]);

    $enalogClient = new EnaLogClient('hello-world', $client);

    $result = $enalogClient->pushEvent([
        'project' => 'hello-world',
        'name' => 'testing-php',
        'description' => 'hello world event description',
        'icon' => '👀',
        'tags' => ['hello', 'world'],
        'meta' => array(['meta' => 'data']),
        'channels' => array(),
        'user_id' => '1234'
    ]);

})->throws(EnaLogEventException::class, 'Failed to send event to EnaLog');


it('can raise enalog event exception when server exception is raised', function () {
    $mock = new MockHandler([
        new ServerException('Error Communicating with Server', new Request('GET', 'test'), new Response())
    ]);

    $handlerStack = HandlerStack::create($mock);
    $client = new Client(['handler' => $handlerStack]);

    $enalogClient = new EnaLogClient('hello-world', $client);

    $result = $enalogClient->pushEvent([
        'project' => 'hello-world',
        'name' => 'testing-php',
        'description' => 'hello world event description',
        'icon' => '👀',
        'tags' => ['hello', 'world'],
        'meta' => array(['meta' => 'data']),
        'channels' => array(),
        'user_id' => '1234'
    ]);

})->throws(EnaLogEventException::class, 'Failed to send event to EnaLog');
