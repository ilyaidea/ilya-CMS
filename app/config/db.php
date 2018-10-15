<?php
return [
    [
        'tableName'  => 'users',
        'schemaName' => null,
        'definition' => [
            'columns' => [
                new \Phalcon\Db\Column(
                    'id',
                    [
                        'type'          => \Phalcon\Db\Column::TYPE_INTEGER,
                        'size'          => 10,
                        'notNull'       => true,
                        'unsigned'      => true,
                        'autoIncrement' => true,
                        'primary'       => true
                    ]
                ),
                new \Phalcon\Db\Column(
                    'username',
                    [
                        'type'    => \Phalcon\Db\Column::TYPE_VARCHAR,
                        'size'    => 70,
                        'notNull' => false
                    ]
                ),
                new \Phalcon\Db\Column(
                    'email',
                    [
                        'type'    => \Phalcon\Db\Column::TYPE_VARCHAR,
                        'size'    => 70,
                        'notNull' => false
                    ]
                ),
                new \Phalcon\Db\Column(
                    'mobile',
                    [
                        'type'    => \Phalcon\Db\Column::TYPE_VARCHAR,
                        'size'    => 20,
                        'notNull' => false
                    ]
                ),
                new \Phalcon\Db\Column(
                    'created',
                    [
                        'type' => \Phalcon\Db\Column::TYPE_DATETIME,
                        'notNull' => true,
                        'default' => 'CURRENT_TIMESTAMP'
                    ]
                ),
            ]
        ]
    ],
];