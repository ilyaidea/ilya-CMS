<?php
return [
    'language'         => [
        'schemaName' => null,
        'definition' => [
            'columns' => [
                new \Lib\Db\Column(
                    'id',
                    [
                        'type'          => \Lib\Db\Column::TYPE_INTEGER,
                        'size'          => 5,
                        'notNull'       => true,
                        'unsigned'      => true,
                        'autoIncrement' => true,
                        'primary'       => true,
                    ]
                ),
                new \Lib\Db\Column(
                    'title',
                    [
                        'type'    => \Phalcon\Db\Column::TYPE_VARCHAR,
                        'size'    => 20,
                        'notNull' => false,
                    ]
                ),
                new \Lib\Db\Column(
                    'iso',
                    [
                        'type'    => \Phalcon\Db\Column::TYPE_VARCHAR,
                        'size'    => 10,
                        'notNull' => true
                    ]
                ),
                new \Lib\Db\Column(
                    'position',
                    [
                        'type'    => \Phalcon\Db\Column::TYPE_INTEGER,
                        'size'    => 5,
                        'notNull' => false
                    ]
                ),
                new \Lib\Db\Column(
                    'is_primary',
                    [
                        'type'    => \Phalcon\Db\Column::TYPE_BOOLEAN,
                        'notNull' => true,
                        'default' => 0
                    ]
                ),
                new \Lib\Db\Column(
                    'direction',
                    [
                        'type'    => \Phalcon\Db\Column::TYPE_VARCHAR,
                        'size' => 3,
                        'notNull' => true,
                        'default' => 'ltr'
                    ]
                ),
            ],
            'options' => [
                'TABLE_TYPE'      => 'BASE TABLE',
                'ENGINE'          => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci',
            ]
        ]
    ],
    'translate' => [
        'schemaName' => null,
        'definition' => [
            'columns'    => [
                new \Lib\Db\Column(
                    'id',
                    [
                        'type'          => \Lib\Db\Column::TYPE_INTEGER,
                        'size'          => 10,
                        'notNull'       => true,
                        'unsigned'      => true,
                        'autoIncrement' => true,
                        'primary'       => true,
                    ]
                ),
                new \Lib\Db\Column(
                    'language',
                    [
                        'type'    => \Lib\Db\Column::TYPE_VARCHAR,
                        'size'    => 10,
                        'notNull' => true,
                    ]
                ),
                new \Lib\Db\Column(
                    'phrase',
                    [
                        'type'     => \Lib\Db\Column::TYPE_VARCHAR,
                        'size'     => 500,
                        'notNull'  => false,
                    ]
                ),
                new \Lib\Db\Column(
                    'translation',
                    [
                        'type'     => \Lib\Db\Column::TYPE_VARCHAR,
                        'size'     => 500,
                        'notNull'  => false,
                    ]
                ),
            ],
            'indexes'    => [
                new \Phalcon\Db\Index(
                    'language',
                    [
                        'language'
                    ]
                )
            ],
            'references' => [
                new \Phalcon\Db\Reference(
                    'fk1_translate',
                    [
                        'referencedSchema'  => null,
                        'referencedTable'   => 'language',
                        'columns'           => [ 'language' ],
                        'referencedColumns' => [ 'iso' ],
                        'onDelete' => 'CASCADE',
                        'onUpdate' => 'CASCADE'
                    ]
                )
            ],
            'options'    => [
                'TABLE_TYPE'      => 'BASE TABLE',
                'ENGINE'          => 'InnoDB',
                'TABLE_COLLATION' => 'utf8_general_ci',
            ]
        ]
    ],
];