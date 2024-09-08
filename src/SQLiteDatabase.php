<?php

namespace App;

use PDO;
use PDOException;

class SQLiteDatabase implements DatabaseInterface
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
            $this->pdo = new PDO('sqlite:' . $this->config->get('sqlite_path'));
        } catch (PDOException $e) {
            $this->logger->log('SQLite connection failed: ' . $e->getMessage());
            die('SQLite connection failed.');
        }
    }

    public function insert(array $data)
    {
        try {
            // Modify the table and columns as per your SQLite schema
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
            $stmt->execute($data);

        } catch (PDOException $e) {
            $this->logger->log('SQLite insert failed: ' . $e->getMessage());
        }
    }
}