<?php

namespace App\Models;

use MongoDB\Client;

class MongoModel
{
    private $client;
    private $db;

    public function __construct()
    {
        // MongoDB bağlantısını oluşturun
        $this->client = new Client('mongodb+srv://cenk:cenk12345@cluster0.i69hw.mongodb.net/?retryWrites=true&w=majority&tlsAllowInvalidCertificates=true'); // Mongo Atlas bağlantı URI'si
        $this->db = $this->client->gezegenler; // Veritabanı adı
    }

    public function getYorumlar()
    {
        // "yorumlar" koleksiyonundan verileri alın
        $yorumlarCollection = $this->db->yorumlar;

        // Verileri dizi olarak almak için toArray() ile döndürüyoruz
        $yorumlar = $yorumlarCollection->find()->toArray();

        // BSON nesnelerini PHP dizisine dönüştürme
        $yorumlarArray = [];
        foreach ($yorumlar as $yorum) {
            $yorumlarArray[] = $yorum->getArrayCopy(); // BSONDocument nesnesini diziye dönüştür
        }

        return $yorumlarArray;
    }
}
