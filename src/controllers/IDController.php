<?php

class IDController
{
    public function getSavedAuctions(){

        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
        if($contentType === "application/json") {

            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);
            //echo json_encode($this->cocktailRepository->getCocktailByName($decoded['search']));

            $userId = $decoded['search'];
            $db = new PDO("pgsql:host=db;port=5432;dbname=licytacje", "admin", "haslo");
            $stmt = $db->prepare("SELECT * FROM getsavedauctionsdetails(:userId)");
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();


            $licytacje = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //echo  $licytacje;

            echo json_encode($licytacje);

        }
        else{
            echo "TEST";
        }



    }

}