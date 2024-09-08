<?php

namespace App;

class DatabaseFactory
{
    public static function create(Config $config, Logger $logger): DbInterface
    {
        $dbType = $config->get('db_type');

        switch ($dbType) {
            case 'mysql':
                return new MysqlDatabase($config, $logger);
            case 'sqlite':
                return new SQLiteDatabase($config, $logger);
            default:
                $logger->log('Unsupported database type: ' . $dbType);
                throw new \Exception('Unsupported database type: ' . $dbType);
        }
    }
}