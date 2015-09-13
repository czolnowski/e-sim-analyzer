<?php
namespace AppBundle\ElasticSearch\Mapping;

class ProductOffersMapping
{
    /**
     * @return array
     */
    public function get()
    {
        return [
            'products' => [
                'properties' => [
                    'amount' => [
                        'type' => 'long'
                    ],
                    'country' => [
                        'properties' => [
                            'id' => [
                                'type' => 'long'
                            ],
                            'name' => [
                                'type' => 'string',
                                'index' => 'not_analyzed',
                            ],
                        ]
                    ],
                    'created_at' => [
                        'type' => 'date',
                        'format' => 'dateOptionalTime'
                    ],
                    'price' => [
                        'type' => 'double'
                    ],
                    'trader' => [
                        'properties' => [
                            'player' => [
                                'properties' => [
                                    'id' => [
                                        'type' => 'long'
                                    ],
                                    'name' => [
                                        'type' => 'string',
                                        'index' => 'not_analyzed',
                                    ],
                                ]
                            ],
                            'stock_company' => [
                                'properties' => [
                                    'id' => [
                                        'type' => 'long'
                                    ],
                                    'name' => [
                                        'type' => 'string',
                                        'index' => 'not_analyzed',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
