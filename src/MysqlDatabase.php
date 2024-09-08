<?php

namespace App;

use PDO;
use PDOException;

class MysqlDatabase implements DbInterface
{
    private $pdo;
    private $config;
    private $logger;

    public function __construct(Config $config, Logger $logger)
    {

        $this->config = $config;
        $this->logger = $logger;
    }

    public function connect()
    {
        try {
            $this->pdo = new PDO(
                'mysql:host=' . $this->config->get('db_host') . ';dbname=' . $this->config->get('db_name'),
                $this->config->get('db_user'),
                $this->config->get('db_pass')
            );
        } catch (PDOException $e) {
            var_dump($e->getMessage());

            $this->logger->log('Database connection failed: ' . $e->getMessage());
            die('Database connection failed.');
        }
    }

    public function insert(array $data)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO catalog 
                (entity_id, CategoryName, sku, name, description, shortdesc, price, link, image, Brand, Rating, CaffeineType, Count, Flavored, Seasonal, Instock, Facebook, IsKCup ) VALUES (
                           :entity_id,
                           :CategoryName,
                           :sku,
                           :name,
                           :description,
                           :shortdesc,
                           :price,
                           :link,
                           :image,
                           :Brand,
                           :Rating,
                           :CaffeineType,
                           :Count,
                           :Flavored,
                           :Seasonal,
                           :Instock,
                           :Facebook, 
                           :IsKCup)");

          ;
            $stmt->execute($data);


        } catch (PDOException $e) {
            $this->logger->log('Insert failed: ' . $e->getMessage());
        }
    }
}