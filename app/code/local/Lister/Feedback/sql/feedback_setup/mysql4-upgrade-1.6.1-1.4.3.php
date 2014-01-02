<?php

$installer = $this;
$installer->startSetup();

$installer->run("
     
CREATE TABLE {$this->getTable('order_details')} (
      `id` int(11) unsigned NOT NULL auto_increment,
      `customer_id` varchar(255)  default '',
      `order_id` varchar(255)  default '',
      `payment_id` varchar(255)  default '',
      `blling_address_id` varchar(255)  default '',
      `created_at` datetime NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 

        ");

$installer->endSetup();
    