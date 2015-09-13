<?php
namespace AppBundle\ElasticSearch\Mapping;

class JobOffersMapping
{
    /**
     * @return array
     */
    public function get()
    {
        return [
            'jobs' => [
                'properties' => [
                    'company' => [
                        'properties' => [
                            'id' => [
                                'type' => 'long'
                            ],
                            'name' => [
                                'type' => 'string',
                                'index' => 'not_analyzed',
                            ],
                            'product' => [
                                'type' => 'string'
                            ],
                            'quality' => [
                                'type' => 'long'
                            ],
                        ]
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
                    'salary' => [
                        'type' => 'double'
                    ],
                    'skill' => [
                        'type' => 'long'
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
