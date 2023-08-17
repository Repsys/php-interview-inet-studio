<?php

class Concept
{
    private $client;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    public function getUserData()
    {
        $params = [
            'auth' => ['user', 'pass'],
            'token' => $this->getSecretKey()
        ];

        $request = new \Request('GET', 'https://api.method', $params);
        $promise = $this->client->sendAsync($request)->then(function ($response) {
            $result = $response->getBody();
        });

        $promise->wait();
    }

    public function getSecretKey(): string
    {
        /** @var SecretKeyProviderType $provider */
        $provider = Config::getInstance()->get('secret_key_provider');

        return (match ($provider) {
            SecretKeyProviderType::DB => new SecretKeyDBProvider(),
            SecretKeyProviderType::FILE => new SecretKeyFileProvider(),
            SecretKeyProviderType::REDIS => new SecretKeyRedisProvider(),
        })->getSecretKey();
    }
}

enum SecretKeyProviderType
{
    case FILE;
    case DB;
    case REDIS;
}

interface SecretKeyProvider
{
    public function getSecretKey(): string;
}

class SecretKeyFileProvider implements SecretKeyProvider
{
    public function getSecretKey(): string
    {
        // TODO: Get secret key from file
        return '';
    }
}

class SecretKeyDBProvider implements SecretKeyProvider
{
    public function getSecretKey(): string
    {
        // TODO: Get secret key from DB
        return '';
    }
}

class SecretKeyRedisProvider implements SecretKeyProvider
{
    public function getSecretKey(): string
    {
        // TODO: Get secret key from Redis
        return '';
    }
}


class Config
{
    private static ?Config $instance = null;

    private array $config;

    private function __construct()
    {
        $this->set('secret_key_provider', SecretKeyProviderType::DB);
    }

    protected function __clone()
    {
    }

    public static function getInstance(): Config
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function set(string $key, $value): void
    {
        $this->config[$key] = $value;
    }

    public function get(string $key)
    {
        return $this->config[$key] ?? null;
    }
}