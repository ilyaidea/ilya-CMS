<?php
return [
    'users'         => [
        'schemaName' => null,
        'definition' => [
            'columns' => [
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
                    'username',
                    [
                        'type'    => \Phalcon\Db\Column::TYPE_VARCHAR,
                        'size'    => 50,
                        'notNull' => false,
                        'rename' => 'username2'
                    ]
                ),
                new \Lib\Db\Column(
                    'email',
                    [
                        'type'    => \Phalcon\Db\Column::TYPE_VARCHAR,
                        'size'    => 70,
                        'notNull' => false
                    ]
                ),
                new \Lib\Db\Column(
                    'mobile',
                    [
                        'type'    => \Phalcon\Db\Column::TYPE_VARCHAR,
                        'size'    => 20,
                        'notNull' => false
                    ]
                ),
                new \Lib\Db\Column(
                    'created',
                    [
                        'type'    => \Phalcon\Db\Column::TYPE_DATETIME,
                        'notNull' => true,
                        'default' => 'CURRENT_TIMESTAMP'
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
    'user_products' => [
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
                    'name',
                    [
                        'type'    => \Lib\Db\Column::TYPE_VARCHAR,
                        'size'    => 50,
                        'notNull' => false,
                    ]
                ),
                new \Lib\Db\Column(
                    'user_id',
                    [
                        'type'     => \Lib\Db\Column::TYPE_INTEGER,
                        'size'     => 10,
                        'notNull'  => false,
                        'unsigned' => true,
                        'rename'   => 'user_idd'
                    ]
                ),
            ],
            'indexes'    => [
                new \Phalcon\Db\Index(
                    'user_id',
                    [
                        'user_id'
                    ]
                )
            ],
            'references' => [
                new \Phalcon\Db\Reference(
                    'fk1_user_product',
                    [
                        'referencedSchema'  => null,
                        'referencedTable'   => 'users',
                        'columns'           => [ 'user_id' ],
                        'referencedColumns' => [ 'id' ],
                        'onDelete' => 'RESTRICT',
                        'onUpdate' => 'RESTRICT'
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