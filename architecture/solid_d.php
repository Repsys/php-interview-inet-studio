<?php

enum HttpMethod: string
{
    case GET = 'GET';
    case POST = 'POST';
    case PUT = 'PUT';
    case DELETE = 'DELETE';
    // TODO
}

interface HttpServiceInterface
{
    public function request(string $url, HttpMethod $method, array $options = []);
}

class XMLHttpService implements HttpServiceInterface
{
    public function request(string $url, HttpMethod $method, array $options = [])
    {
        // TODO: Implement request() method.
    }
}

class Http
{
    public function __construct(
        private readonly HttpServiceInterface $service
    ){}

    public function get(string $url, array $options): void
    {
        $this->service->request($url, HttpMethod::GET, $options);
    }

    public function post(string $url): void
    {
        $this->service->request($url, HttpMethod::POST);
    }
}
