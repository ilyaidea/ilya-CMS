<?php
/**
 * Summary File IndexController
 *
 * Description File IndexController
 *
 * ILYA CMS Created by ILYA-IDEA Company.
 * @author Ali Mansoori
 * Date: 7/17/2018
 * Time: 6:49 PM
 * @version 1.0.0
 * @copyright Copyright (c) 2017-2018, ILYA-IDEA Company
 */
namespace Modules\Users\Session\Controllers;

use Ilya\Models\Users;
use Lib\Authenticates\Auth;
use Lib\Mvc\Helper;
use Lib\Mvc\Helper\ModuleCache;
use Modules\Users\Session\Forms\Login2Form;
use Modules\Users\Session\Forms\LoginForm;
use Modules\Users\Session\Forms\SignUp2Form;
use Modules\Users\Session\Forms\SignUpForm;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Lib\Db\Column;
use Phalcon\Db\Reference;

/**
 * @property Helper $helper
 * @property Auth $auth
 */
class IndexController extends \Lib\Mvc\Controller
{
    public function indexAction()
    {
        $this->helper->setTemplate('session-template', 'Session Template');
        // Check user is logged in
        if ($this->auth->isLoggedIn())
        {
            $this->response->redirect('');
        }

        $content = $this->helper->content();

        $loginForm = $content->addFormWide(new LoginForm());
        $signupForm = $content->addFormTall(new SignUpForm());

        $content->getTheme()->noLeftMasterPage();
//        $content->getTheme()->noRightMasterPage();
//        $content->getTheme()->noLeftRightMasterPage();
//        $content->getTheme()->viewMasterPage();

        if($loginForm->isValid())
        {
            try
            {
                $this->auth->check();
            }
            catch( \Exception $e )
            {
                $this->flash->success($e->getMessage());
            }
        }

        if($signupForm->isValid())
        {
            $user = new Users(
                [
                    'username' => $this->request->getPost('username', 'striptags'),
                    'email'    => $this->request->getPost('email', [
                        'striptags',
                        'email'
                    ]),
                    'password' => $this->request->getPost('password'),
                    'active'   => true
                ]
            );

            if ($user->save())
            {
                $this->flash->success('Success save');
            }
            else
            {
                foreach ($user->getMessages() as $message)
                {
                    $this->flash->error($message);
                }
            }
        }

        $content->create();

//        dump($content->getContent()->getParts());
    }

//    public function testAction()
//    {
//        $dbPath = $this->config->module->path. '/config/db.php';
//        $dbConfig = require_once $dbPath;
//        $dbFileSize = filesize($dbPath);
//
//        $connectionName = $this->config->module->database->connection;
//        /** @var Mysql $connection */
//        $connection = $this->$connectionName;
//
//        if(!ModuleCache::getInstance()->get('database') || ModuleCache::getInstance()->get('database') !== $dbFileSize)
//        {
//            $listRef = [];
//            $listTables = $connection->listTables();
//
//            foreach($dbConfig as $tableName => $tableValue)
//            {
//                // is table not exist and create table
//                if(!$connection->tableExists(
//                    $tableName,
//                    $tableValue['schemaName']
//                ))
//                {
//                    $connection->createTable(
//                        $tableName,
//                        $tableValue['schemaName'],
//                        $tableValue['definition']
//                    );
//
//                }
//                else
//                {
//                    // update table
//                    // update columns
//
//                    // remove
//                    foreach($connection->describeIndexes($tableName) as $key => $describeIndex)
//                    {
//                        if($key === 'PRIMARY')
//                            continue;
//
//                        $listRef = $this->removeReferences($connection, $describeIndex->getName(), $listRef);
//                        $connection->dropIndex($tableName, $tableValue['schemaName'], $describeIndex->getName());
//                    }
//
//                    /** @var Column $column */
//                    foreach( $tableValue[ 'definition'][ 'columns'] as $column)
//                    {
//                        foreach($connection->describeColumns($tableName) as $describeColumn)
//                        {
//                            if($column->getName() == $describeColumn->getName())
//                            {
//                                $connection->modifyColumn($tableName, $tableValue['schemaName'], $column, $describeColumn);
//                                break;
//                            }
//
//                            if($column->getRename() == $describeColumn->getName())
//                            {
//                                $connection->modifyColumn($tableName, $tableValue['schemaName'], $column, $describeColumn);
//                                break;
//                            }
//                        }
//                    }
//
//                    if(isset($tableValue[ 'definition'][ 'indexes']) && !empty($tableValue[ 'definition'][ 'indexes']))
//                    {
//                        foreach($tableValue[ 'definition'][ 'indexes'] as $index)
//                        {
//                            $connection->addIndex($tableName, $tableValue['schemaName'], $index);
//                        }
//                    }
//
//                    // References
//                    foreach($connection->describeReferences($tableName) as $describeReference)
//                    {
//                        $listRef[$tableName][$describeReference->getName()] = $describeReference;
//                        $connection->dropForeignKey($tableName, $tableValue['schemaName'], $describeReference->getName());
//                    }
//                    if(isset($tableValue[ 'definition'][ 'references']) && !empty($tableValue[ 'definition'][ 'references']))
//                    {
//                        foreach($tableValue[ 'definition'][ 'references'] as $key => $reference)
//                        {
//                            $connection->addForeignKey($tableName, $tableValue['schemaName'], $reference);
//                        }
//                    }
//
//                }
//
//                if (($key = array_search($tableName, $listTables)) !== false) {
//                    unset($listTables[$key]);
//                }
//            }
//
//            // drop table
//            if(!empty($listTables))
//            {
//                foreach($listTables as $table)
//                {
//                    // set null column related tables
//                    foreach($listRef as $tableName => $references)
//                    {
//                        /** @var Reference $reference */
//                        foreach($references as $refKey => $reference)
//                        {
//                            if($reference->getReferencedTable() == $table)
//                            {
//                                foreach($reference->getColumns() as $column)
//                                {
//                                    $connection->update(
//                                        $tableName,
//                                        [$column],
//                                        [NULL]
//                                    );
//                                }
//                            }
//                        }
//                    }
//                    $connection->dropTable($table);
//                }
//            }
//
//            ModuleCache::getInstance()->save('database', $dbFileSize);
//        }
//
//        die(print_r($listTables));
//
//    }
//
//    private function removeReferences(Mysql $connection, $indexName, $listRef = [])
//    {
//        foreach($connection->listTables() as $table)
//        {
//            foreach($connection->describeReferences($table) as $reference)
//            {
////                if($indexName == 'fk1_user_product')
////                {
////                    echo "<pre>";
////                    die(print_r($reference));
////                }
//                foreach($reference->getColumns() as $column)
//                {
//                    if($column == $indexName || $indexName == $reference->getName())
//                    {
//                        //drop
//                        $listRef[$table][$reference->getName()] = $reference;
//                        $connection->dropForeignKey($table, $reference->getSchemaName(), $reference->getName());
//                    }
//                }
//            }
//        }
//
//        return $listRef;
//    }
}