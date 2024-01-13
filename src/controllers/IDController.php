<?php

class IDController
{
    public function getSavedAuctions(){

        $db = new PDO("pgsql:host=db;port=5432;dbname=licytacje", "admin", "haslo");
        $stmt = $db->prepare("SELECT * FROM getsavedauctionsdetails(:userId)");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        var_dump($userId);
        $stmt->execute();
        $licytacje = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $licytacje;
    }

}