<?php

$installer = $this;
$installer->startSetup();
$installer->run("
    CREATE TABLE `{$installer->getTable('sekizgen_lastikview/countyselection')}` (
      `id` int(11) NOT NULL auto_increment,
      `county_code` VARCHAR(12),
      `product_entity_id` int(10),
      `customer_entity_id` int(10),
      `time` timestamp NOT NULL default CURRENT_TIMESTAMP,
      `ip`  VARCHAR(15),
      PRIMARY KEY  (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");
$installer->endSetup();