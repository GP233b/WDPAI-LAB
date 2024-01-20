<?php

class SaveAuctionController
{

    public function saveAuction()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');

            if (isset($decoded['licytacja_id']) && isset($decoded['id_user'])) {
                $licytacjaId = $decoded['licytacja_id'];
                $idUser = $decoded['id_user'];

                if (!is_numeric($licytacjaId) || !is_numeric($idUser)) {
                    echo json_encode(['error' => 'Nieprawidłowy format danych. Wprowadź liczby.']);
                    return;
                }

                try {
                    $db = new PDO("pgsql:host=db;port=5432;dbname=licytacje", "admin", "haslo");

                    // Rozpocznij transakcję
                    $db->beginTransaction();

                    // Sprawdź, czy już istnieje rekord dla danej aukcji i użytkownika
                    $stmtCheck = $db->prepare("SELECT * FROM saved_auction WHERE sva_lic_id = :licytacjaId AND sva_usr_id = :idUser");
                    $stmtCheck->bindParam(':licytacjaId', $licytacjaId, PDO::PARAM_INT);
                    $stmtCheck->bindParam(':idUser', $idUser, PDO::PARAM_INT);
                    $stmtCheck->execute();

                    $existingRecord = $stmtCheck->fetch(PDO::FETCH_ASSOC);

                    if ($existingRecord) {
                        echo json_encode(['error' => 'Aukcja już zapisana.']);

                        // Rollback transakcji w przypadku błędu
                        $db->rollBack();
                        return;
                    }

                    // Dodaj nowy rekord do saved_auction
                    $stmtInsert = $db->prepare("INSERT INTO saved_auction (sva_lic_id , sva_usr_id) VALUES (:licytacjaId, :idUser)");
                    $stmtInsert->bindParam(':licytacjaId', $licytacjaId, PDO::PARAM_INT);
                    $stmtInsert->bindParam(':idUser', $idUser, PDO::PARAM_INT);
                    $stmtInsert->execute();

                    // Zakończ transakcję
                    $db->commit();

                    echo json_encode(['message' => 'ZAPISANO LICYTACJE.']);

                } catch (PDOException $e) {
                    // Rollback transakcji w przypadku błędu
                    $db->rollBack();

                    echo json_encode(['error' => 'Błąd aktualizacji bazy danych: ' . $e->getMessage()]);
                }
            } else {
                echo json_encode(['error' => 'Nieprawidłowe dane JSON.']);
            }
        } else {
            echo json_encode(['error' => 'Nieprawidłowe żądanie.']);
        }
    }
}
?>
