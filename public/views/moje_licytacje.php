
<!DOCTYPE html>
<html lang="pl">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/licytacje.css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/public/js/session.js"></script>
    <title>Document</title>
</head>
<body>
<script>
    checkId()
</script>

<?php
    // Pobierz dane licytacji dla danego użytkownika
    $db = new PDO("pgsql:host=db;port=5432;dbname=licytacje", "admin", "haslo");

    $stmt = $db->prepare("SELECT * FROM getsavedauctionsdetails(:userId)");
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    var_dump($userId);
    $stmt->execute();
    $licytacje = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

<div class="container">
    <button class="logout-button" type="button" onclick="logout()">WYLOGUJ</button>
    <div class="logo">
        <img src="/public/img/logo.svg">
    </div>

    <div class="auction-section">
        <h2>Twoje Licytacje</h2>
        <p>Tutaj znajdziesz wszystkie twoje zapisane licytacje</p>
    </div>

    <div class="login-container">
        <form>
            <div class="table-container">
                <div class="table-header">
                    <div class="table-cell">Numer</div>
                    <div class="table-cell">Zdjęcie</div>
                    <div class="table-cell">Data zakończenia licytacji</div>
                    <div class="table-cell">Cena wygrywająca</div>
                    <div class="table-cell">Miejscowość</div>
                    <div class="table-cell">Nazwa</div>
                </div>

                <?php
                // Iteruj przez dane licytacji i generuj wiersze tabeli
                foreach ($licytacje as $row) {
                    echo '<div class="table-row">';
                    echo '<div class="table-cell">' . $row['lic_id'] . '</div>';
                    echo '<div class="table-cell"><img src="data:image/jpeg;base64,' . base64_encode(stream_get_contents($row['lic_picture'])) . '"></div>';
                    echo '<div class="table-cell">' . $row['lic_date'] . '</div>';
                    echo '<div class="table-cell">' . $row['lic_highest_price'] . '</div>';
                    echo '<div class="table-cell">' . $row['lic_town'] . '</div>';
                    echo '<div class="table-cell">' . $row['lic_name'] . '</div>';
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
