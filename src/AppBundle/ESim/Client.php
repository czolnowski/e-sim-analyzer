<?php
namespace AppBundle\ESim;

use GuzzleHttp;

class Client
{
    /**
     * @var GuzzleHttp\Client
     */
    private $client;

    /**
     * @param string $host
     */
    public function __construct($host)
    {
        $this->client = new GuzzleHttp\Client(['base_uri' => 'http://' . $host]);
    }

    /**
     * @param string $url
     * @param array $options
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get($url, $options = [])
    {
        return $this->client->get($url, $options);
    }
} 