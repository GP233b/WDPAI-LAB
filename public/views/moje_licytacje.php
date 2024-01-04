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
        <h2>Twoje Licytacje</h2>
        <p>Tutaj znajdziesz wszystkie twoje zapisane licytacje</p>

    </div>
    <div class="login-container">
        <form>
            <!-- Existing Table for Data -->
            <div class="table-container">
                <div class="table-header">
                    <div class="table-cell">Numer</div>
                    <div class="table-cell">Zdjęcie</div>
                    <div class="table-cell">Data zakończenia licytacji</div>
                    <div class="table-cell">Cena wygrywająca</div>
                    <div class="table-cell">Miejscowość</div>
                    <div class="table-cell">Nazwa</div>
                </div>
                <div class="table-row">
                    <div class="table-cell">Wiersz 1, Kolumna 1</div>
                    <div class="table-cell">Wiersz 1, Kolumna 2</div>
                    <div class="table-cell">Wiersz 1, Kolumna 3</div>
                    <div class="table-cell">Wiersz 1, Kolumna 3</div>
                    <div class="table-cell">Wiersz 1, Kolumna 3</div>
                    <div class="table-cell">Wiersz 1, Kolumna 3</div>
                    <button type="button" onclick="changeUrl('/licytacja')">Wejdz</button>
                </div>
                <div class="table-row">
                    <div class="table-cell">Wiersz 2, Kolumna 1</div>
                    <div class="table-cell">Wiersz 2, Kolumna 2</div>
                    <div class="table-cell">Wiersz 2, Kolumna 3</div>
                </div>
            </div>
            <script>
                function changeUrl(newUrl) {
                    window.location.href = newUrl;
                }
            </script>


        </form>
    </div>
</div>
</body>
</html>
