<?php

$installer = $this;

$installer->startSetup();

$installer->run("
     
    -- DROP TABLE IF EXISTS {$this->getTable('feedback')};
    CREATE TABLE {$this->getTable('feedback')} (
      `feedback_id` int(11) unsigned NOT NULL auto_increment,
      `name` varchar(255) NOT NULL default '',
      `email` varchar(255) NOT NULL default '',
      `comments` text NOT NULL default '',
      PRIMARY KEY (`feedback_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
     
        ");

$installer->endSetup();