<!-- LICYTACJA -->
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="/public/css/licytacja.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="\public\js\displayWinnerInfo.js"></script>
    <title>Document</title>
</head>

<body>
<div class="container">
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
        // Pobierz dane obrazu z bazy danych
        $stmt = $db->prepare("
                SELECT 
                    l.lic_picture, 
                    l.lic_name, 
                    l.lic_date, 
                    l.lic_town, 
                    l.lic_opis, 
                    l.lic_highest_price,  -- Dodaj pole lic_highest_price
                    u.usr_name, 
                    u.usr_surname
                FROM 
                    licytacje l
                LEFT JOIN 
                    users u ON l.lic_id_winner = u.usr_id
                WHERE 
                    l.lic_id = :lic_id
            ");

        $stmt->bindParam(':lic_id', $licytacjaId, PDO::PARAM_INT);
        $stmt->execute();
        $licytacjaDetails = $stmt->fetch(PDO::FETCH_ASSOC);

        // Wyświetl obraz
        if ($licytacjaDetails !== false && $licytacjaDetails['lic_picture'] !== null) {
            echo '<div class="image-price-container">';
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
    } else {
        echo '<div class="table-cell">Nieprawidłowe ID licytacji. Otrzymane ID: ' . $licytacjaId . '</div>';
    }
    ?>
</div>

</body>

</html>

