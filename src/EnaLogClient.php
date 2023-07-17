<?php

declare(strict_types=1);

namespace EnaLog;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

final class EnaLogClient
{
    private $httpClient;

    public function __construct(string $apiKey, $client = null)
    {
        $this->httpClient = $client ?? new Client([
            'base_uri' => 'https://api.enalog.app/v1',
            'headers' => ['Authorization' => 'Bearer: ' . $apiKey],
        ]);
    }

    public function pushEvent(array $event)
    {
        try {
            $res = $this->httpClient->post('/events', [
                'json' => json_encode($event, JSON_THROW_ON_ERROR),
            ]);

            $body = $res->getBody();

            return $body->getContents();
        } catch (ClientException $e) {
            throw new EnaLogEventException('Failed to send event to EnaLog');
        } catch (ServerException $e) {
            throw new EnaLogEventException('Failed to send event to EnaLog');
        }

    }
}
