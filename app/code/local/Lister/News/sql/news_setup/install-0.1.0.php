<?php

$installer = $this;

$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('news/news'))
    ->addColumn('news_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'auto_increment' => true,  
        'nullable'  => false,
        'primary'   => true,
        ), 'News ID')
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => false,
        ), 'Title')
    ->addColumn('category', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => false,
        ), 'Cateogry')
    ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => false,
        ), 'Content')
    ->setComment('Custom table to store News articles');
$installer->getConnection()->createTable($table);

$installer->endSetup();
