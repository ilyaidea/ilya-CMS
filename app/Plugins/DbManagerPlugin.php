<?php
/**
 * Summary File DbManagerPlugin
 *
 * Description File DbManagerPlugin
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 10/5/2018
 * Time: 6:02 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */

namespace Plugins;


use Phalcon\Mvc\User\Plugin;
use Lib\Mvc\Helper\ModuleCache;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Lib\Db\Column;
use Phalcon\Db\Reference;

class DbManagerPlugin extends Plugin
{
    public function __construct()
    {
        $dbPath = $this->config->module->path. '/config/db.php';

        if(!file_exists($dbPath))
        {
            return;
        }
        $dbConfig = require_once $dbPath;
        $dbFileSize = filesize($dbPath);

        if(!isset($this->config->module->database->connection))
        {
            return;
        }

        $connectionName = $this->config->module->database->connection;

        /** @var Mysql $connection */
        $connection = $this->$connectionName;

        if(!ModuleCache::getInstance()->get('database') || ModuleCache::getInstance()->get('database') !== $dbFileSize)
        {
            $listRef = [];
            $listTables = $connection->listTables();

            foreach($dbConfig as $tableName => $tableValue)
            {
                // is table not exist and create table
                if(!$connection->tableExists(
                    $tableName,
                    $tableValue['schemaName']
                ))
                {
                    $connection->createTable(
                        $tableName,
                        $tableValue['schemaName'],
                        $tableValue['definition']
                    );

                }
                else
                {
                    // update table
                    // update columns

                    // remove
                    foreach($connection->describeIndexes($tableName) as $key => $describeIndex)
                    {
                        if($key === 'PRIMARY')
                            continue;

                        $listRef = $this->removeReferences($connection, $describeIndex->getName(), $listRef);
                        $connection->dropIndex($tableName, $tableValue['schemaName'], $describeIndex->getName());
                    }

                    /** @var Column $column */
                    foreach( $tableValue[ 'definition'][ 'columns'] as $column)
                    {
                        foreach($connection->describeColumns($tableName) as $describeColumn)
                        {
                            if($column->getName() == $describeColumn->getName())
                            {
                                $connection->modifyColumn($tableName, $tableValue['schemaName'], $column, $describeColumn);
                                break;
                            }

                            if($column->getRename() == $describeColumn->getName())
                            {
                                $connection->modifyColumn($tableName, $tableValue['schemaName'], $column, $describeColumn);
                                break;
                            }
                        }
                    }

                    if(isset($tableValue[ 'definition'][ 'indexes']) && !empty($tableValue[ 'definition'][ 'indexes']))
                    {
                        foreach($tableValue[ 'definition'][ 'indexes'] as $index)
                        {
                            $connection->addIndex($tableName, $tableValue['schemaName'], $index);
                        }
                    }

                    // References
                    foreach($connection->describeReferences($tableName) as $describeReference)
                    {
                        $listRef[$tableName][$describeReference->getName()] = $describeReference;
                        $connection->dropForeignKey($tableName, $tableValue['schemaName'], $describeReference->getName());
                    }
                    if(isset($tableValue[ 'definition'][ 'references']) && !empty($tableValue[ 'definition'][ 'references']))
                    {
                        foreach($tableValue[ 'definition'][ 'references'] as $key => $reference)
                        {
                            $connection->addForeignKey($tableName, $tableValue['schemaName'], $reference);
                        }
                    }

                }

                if (($key = array_search($tableName, $listTables)) !== false) {
                    unset($listTables[$key]);
                }
            }

            // drop table
            if(!empty($listTables))
            {
                foreach($listTables as $table)
                {
                    // set null column related tables
                    foreach($listRef as $tableName => $references)
                    {
                        /** @var Reference $reference */
                        foreach($references as $refKey => $reference)
                        {
                            if($reference->getReferencedTable() == $table)
                            {
                                foreach($reference->getColumns() as $column)
                                {
                                    $connection->update(
                                        $tableName,
                                        [$column],
                                        [NULL]
                                    );
                                }
                            }
                        }
                    }
                    $connection->dropTable($table);
                }
            }

            ModuleCache::getInstance()->save('database', $dbFileSize);
        }

    }

    private function removeReferences(Mysql $connection, $indexName, $listRef = [])
    {
        foreach($connection->listTables() as $table)
        {
            foreach($connection->describeReferences($table) as $reference)
            {
                foreach($reference->getColumns() as $column)
                {
                    if($column == $indexName || $indexName == $reference->getName())
                    {
                        //drop
                        $listRef[$table][$reference->getName()] = $reference;
                        $connection->dropForeignKey($table, $reference->getSchemaName(), $reference->getName());
                    }
                }
            }
        }

        return $listRef;
    }
}