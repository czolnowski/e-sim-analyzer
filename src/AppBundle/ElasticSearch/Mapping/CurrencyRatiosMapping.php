<?php
namespace AppBundle\ElasticSearch\Mapping;

class CurrencyRatiosMapping
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
                    'created_at' => [
                        'type' => 'date',
                        'format' => 'dateOptionalTime'
                    ],
                    'currency' => [
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
                    'ratio' => [
                        'type' => 'double'
                    ],
                    'state' => [
                        'type' => 'string'
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
