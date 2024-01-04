<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/licytacje.css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="/public/img/logo.svg">
    </div>
    <!-- New Section for Licytacje (Auctions) -->
    <div class="auction-section">
        <h2>Licytacje Archiwalne</h2>
        <p>Tutaj znajdziesz wszystkie zakończone licytacje</p>
        public
    </div>
    <div class="login-container">
        <form>
            <div class="table-container">
                <div class="table-header">
                    <div class="table-cell">Numer</div>
                    <div class="table-cell">Nazwa</div>
                    <div class="table-cell">Zdjęcie</div>
                    <div class="table-cell">Data zakończenia licytacji</div>
                    <div class="table-cell">Cena Wygrana</div>
                    <div class="table-cell">Miejscowość</div>
                    <div class="table-cell">Akcja</div>
                </div>
                <?php
                // Przykład kodu PHP do pobrania danych z bazy danych
                $db = new PDO("pgsql:host=db;port=5432;dbname=licytacje", "admin", "haslo");
                $currentDate = date('Y-m-d');
                $stmt = $db->query("SELECT * FROM licytacje WHERE lic_date < '$currentDate'");
                $licytacje = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Iterowanie przez dane z bazy danych i generowanie wierszy tabeli
                foreach ($licytacje as $row) {
                    echo '<div class="table-row">';
                    echo '<div class="table-cell">' . $row['lic_id'] . '</div>';
                    echo '<div class="table-cell">' . $row['lic_name'] . '</div>';

                    // Przekształcenie danych binarnych na base64
                    $imageData = stream_get_contents($row['lic_picture']);
                    $base64Image = base64_encode($imageData);

                    // Wyświetlenie obrazu za pomocą base64
                    echo '<div class="table-cell"><img src="data:image/jpeg;base64,' . $base64Image . '"></div>';

                    echo '<div class="table-cell">' . $row['lic_date'] . '</div>';
                    echo '<div class="table-cell">' . $row['lic_highest_price'] . '</div>';
                    echo '<div class="table-cell">' . $row['lic_town'] . '</div>';
                    echo '<div class="table-cell"><button type="button" onclick="changeUrl(\'/licytacja\')">Wejdz</button></div>';
                    echo '</div>';
                }
                ?>
            </div>
        </form>
        <script>
            function changeUrl(newUrl) {
                window.location.href = newUrl;
            }
        </script>
        <script>
            function changeUrl(newUrl) {
                window.location.href = newUrl;
            }
        </script>
    </div>
</div>
</body>
</html>
