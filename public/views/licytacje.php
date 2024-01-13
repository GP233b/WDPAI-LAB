<!-- LICYTACJE -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Inne elementy nagłówka -->

    <script src="\public\js\changeUrl.js"></script>
    <link rel="stylesheet" type="text/css" href="public/css/licytacje.css"/>
    <script src="\public\js\session.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <div class="auction-section">
        <h2>Licytacje</h2>
        <p>Tutaj znajdziesz informacje o aktualnych licytacjach.</p>
    </div>
    <div class="login-container">
        <form>
            <div class="table-container">
                <div class="table-header">
                    <div class="table-cell">ID Licytacji</div>
                    <div class="table-cell">Nazwa</div>
                    <div class="table-cell">Zdjęcie</div>
                    <div class="table-cell">Data zakończenia licytacji</div>
                    <div class="table-cell">Cena wygrywająca</div>
                    <div class="table-cell">Miejscowość</div>
                    <div class="table-cell">Akcja</div>
                </div>
                <?php
                // Przykład kodu PHP do pobrania danych z bazy danych
                $db = new PDO("pgsql:host=db;port=5432;dbname=licytacje", "admin", "haslo");
                $stmt = $db->query("SELECT * FROM current_auction");
                $licytacje = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Iterowanie przez dane z bazy danych i generowanie wierszy tabeli
                foreach ($licytacje as $row) {
                    echo '<div class="table-row">';
                    echo '<div class="table-cell">' . $row['lic_id'] . '</div>';
                    echo '<div class="table-cell">' . $row['lic_name'] . '</div>';
                    $base64Image = base64_encode(stream_get_contents($row['lic_picture']));
                    echo '<div class="table-cell"><img src="data:image/jpeg;base64,' . $base64Image . '"></div>';
                    echo '<div class="table-cell">' . $row['lic_date'] . '</div>';
                    echo '<div class="table-cell">' . $row['lic_highest_price'] . '</div>';
                    echo '<div class="table-cell">' . $row['lic_town'] . '</div>';

                    // Dodaj przekazanie ID do funkcji changeUrl
                    echo '<div class="table-cell"><button type="button" onclick="changeUrl(' . $row['lic_id'] . ')">Wejdz</button></div>';
                    echo '</div>';
                }
                ?>
            </div>
        </form>
    </div>
</div>
</body>
</html>
