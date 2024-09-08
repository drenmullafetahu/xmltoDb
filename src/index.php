<?php

require _DIR_ . '/../vendor/autoload.php';

use App\Config;
use App\Logger;
use App\DatabaseFactory;
use App\XmlProc;

$config = new Config();
$logger = new Logger($config->get('log_file'));

try {
    $db = DatabaseFactory::create($config, $logger);
} catch (Exception $e) {
    $this->logger->log($e->getMessage());
}
$db->connect();

$processor = new XmlProc($db, $logger);
$processor->process(_DIR_ . '/../feed.xml');