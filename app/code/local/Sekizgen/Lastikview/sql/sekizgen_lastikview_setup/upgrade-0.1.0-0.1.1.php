<?php

$installer = $this;
$installer->startSetup();
$installer->run("ALTER TABLE `{$installer->getTable('sekizgen_lastikview/countyselection')}` ADD `tel` VARCHAR(13);");
$installer->endSetup();