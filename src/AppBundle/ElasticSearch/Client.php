<?php
namespace AppBundle\ElasticSearch;

use GuzzleHttp\Client as HttpClient;

class Client
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $index;

    /**
     * @var string
     */
    private $type;

    /**
     * @param string $host
     * @param int $port
     * @param string $index
     * @param string $type
     */
    public function __construct($host, $port, $index, $type)
    {
        $this->client = new HttpClient([
            'base_uri' => sprintf('http://%s:%d', $host, $port)
        ]);
        $this->index = $index;
        $this->type = $type;
    }

    /**
     * @param string $body
     */
    public function insert($body)
    {
        $this->client->post(
            sprintf('%s/%s', $this->index, $this->type),
            [
                'body' => $body
            ]
        );
    }
} 