<?php

namespace App;

class XmlProc
{
    private $db;
    private $logger;

    public function __construct(DbInterface $db, Logger $logger)
    {
        $this->db = $db;
        $this->logger = $logger;
    }

    public function process($filePath)
    {
        echo 'Processing XML File ...';
        if (!file_exists($filePath)) {
            $this->logger->log('File not found: ' . $filePath);
            die('File not found.');
        }

        $xml = simplexml_load_file($filePath);
        if ($xml === false) {
            $this->logger->log('Failed to load XML file.');
            die('Failed to load XML file.');
        }

        foreach ($xml->item as $item) {

            $data = [
                'entity_id' => (integer)$item->entity_id,
                'CategoryName' => (string)$item->CategoryName,
                'sku' => (integer)$item->sku,
                'name' => (string)$item->name,
                'description' => (string)$item->description,
                'shortdesc' => (string)$item->shortdesc,
                'price' => (string)$item->price,
                'link' => (string)$item->link,
                'image' => (string)$item->image,
                'Brand' => (string)$item->Brand,
                'Rating' => (string)$item->Rating,
                'CaffeineType' => (string)$item->CaffeineType,
                'Count' => (string)$item->Count,
                'Flavored' => (string)$item->Flavored,
                'Seasonal' => (string)$item->Seasonal,
                'Instock' => (integer)$item->Instock,
                'Facebook' => (integer)$item->Facebook,
                'IsKCup' => (integer)$item->IsKCup
            ];


            $this->db->insert($data);
        }

        echo "\r\n";
        echo 'Query Finished';
    }
}