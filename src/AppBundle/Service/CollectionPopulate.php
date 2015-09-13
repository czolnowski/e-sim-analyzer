<?php
namespace AppBundle\Service;

use AppBundle\ElasticSearch\Client;
use AppBundle\Entity\Populate;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Serializer;

class CollectionPopulate
{
    /**
     * @var ArrayCollection
     */
    private $collection;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @param Client $client
     * @param Serializer $serializer
     */
    public function __construct(Client $client, Serializer $serializer)
    {
        $this->collection = new ArrayCollection();
        $this->client = $client;
        $this->serializer = $serializer;
    }

    /**
     * @param Populate $populate
     */
    public function collect(Populate $populate)
    {
        $this->collection->add($populate);
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->collection->count();
    }

    public function populate()
    {
        foreach ($this->collection as $populate) {
            $this->client->insert(
                $this->serializer->serialize($populate, 'json')
            );
        }

        $this->collection->clear();
    }
} 