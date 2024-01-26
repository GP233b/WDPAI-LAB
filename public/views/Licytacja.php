<!-- LICYTACJA -->
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="/public/css/licytacja.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/public/js/displayWinnerInfo.js"></script>
    <script src="/public/js/session.js"></script>
    <script src="/public/js/auctionHandler.js"></script>
    <script src="/public/js/saveAuction.js"></script>
    <title>Document</title>
</head>

<body>

<script>
    checkId()
</script>
<div class="container">
    <button class="logout-button" type="button" onclick="logout()">WYLOGUJ</button>
    <div class="logo">
        <img src="/public/img/logo.svg">
    </div>

    <?php
    // Przykładowe kodu PHP do odczytywania obrazu z bazy danych
    $db = new PDO("pgsql:host=db;port=5432;dbname=licytacje", "admin", "haslo");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Odczytaj numer licytacji z URL-a
    $url = $_SERVER['REQUEST_URI'];
    $parts = explode('/', $url);
    $licytacjaId = end($parts);

    // Wyświetl numer licytacji (możesz to użyć do debugowania)
    if ($licytacjaId !== null) {
        // Pobierz dane z funkcji
        $stmt = $db->prepare("SELECT * FROM getAuctionDetails(:lic_id)");
        $stmt->bindParam(':lic_id', $licytacjaId, PDO::PARAM_INT);
        $stmt->execute();
        $licytacjaDetails = $stmt->fetch(PDO::FETCH_ASSOC);

        // Wyświetl obraz
        if ($licytacjaDetails !== false && $licytacjaDetails['lic_picture'] !== null) {
            echo '<div class="image-price-container">';

            echo '<button type="button" onclick="zapiszAukcje()" ">ZAPISZ AUKCJĘ</button>';



            $base64Image = base64_encode(stream_get_contents($licytacjaDetails['lic_picture']));

            echo '<div class="image-container"><img src="data:image/jpeg;base64,' . $base64Image . '"></div>';

            // Wyświetl aktualną cenę
            echo '<div class="price-container">';
            echo '<div class="price-label">Aktualna cena:</div>';
            echo '<div class="price-value">' . $licytacjaDetails['lic_highest_price'] . '</div>';
            echo '</div>';
            echo '</div>';
        } else {
            echo '<div class="image-container">Brak obrazu</div>';
        }
        $licytacjaDate = $licytacjaDetails['lic_date'];

        echo '<div class="info-container">';
        echo '<div class="table-container">';
        echo '<div class="table-header">';
        echo '<div class="table-cell">Nazwa</div>';
        echo '<div class="table-cell">Data</div>';
        echo '<div class="table-cell">Miejscowość</div>';

        // Wywołaj funkcję JavaScript z przekazaniem daty
        echo '<script>displayWinnerInfo("' . $licytacjaDate . '");</script>';

        echo '</div>';

        echo '<div class="table-row">';
        echo '<div class="table-cell">' . $licytacjaDetails['lic_name'] . '</div>';
        echo '<div class="table-cell">' . $licytacjaDetails['lic_date'] . '</div>';
        echo '<div class="table-cell">' . $licytacjaDetails['lic_town'] . '</div>';
        echo '<div class="table-cell">' . $licytacjaDetails['usr_name'] . ' ' . $licytacjaDetails['usr_surname'] . '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        // Dodaj sekcję lic_opis pod tabelą
        echo '<div class="opis-container">';
        echo '<h2>Opis licytacji</h2>';
        echo '<div class="opis-content">' . $licytacjaDetails['lic_opis'] . '</div>';
        echo '</div>';

        // Dodaj formularz do wprowadzania nowej ceny
        $currentDate = date('Y-m-d');
        if ($licytacjaDetails !== false && $licytacjaDetails['lic_date'] > $currentDate) {
            // Wyświetl formularz tylko gdy lic_date jest większe niż aktualna data
            echo '<div class="bid-form-container">';
            echo '<label for="bid-amount">Wprowadź nową cenę:</label>';
            echo '<input type="text" id="bid-amount" name="bid_amount" required>';

            // Dodaj ukryte pole z licytacjaId
            echo '<input type="hidden" id="licytacja-id" name="licytacja_id" value="' . $licytacjaId . '">';

            echo '<button type="button" onclick="wyslijOferte()">Złóż ofertę</button>';
            echo '</div>';
        }
    } else {
        echo '<div class="table-cell">Nieprawidłowe ID licytacji. Otrzymane ID: ' . $licytacjaId . '</div>';
    }

    ?>



</div>

</body>

</html>
