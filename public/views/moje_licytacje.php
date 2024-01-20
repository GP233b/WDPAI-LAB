<!DOCTYPE html>
<html lang="pl">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/licytacje.css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/public/js/session.js"></script>
    <script src="/public/js/generateTableRows.js"></script>
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
        <h2>Twoje Licytacje</h2>
        <p>Tutaj znajdziesz wszystkie twoje zapisane licytacje</p>
    </div>

    <div class="login-container">
        <form>
            <div class="table-container" id="tableContainer">
                <div class="table-header">
                    <div class="table-cell">Numer</div>
                    <div class="table-cell">Nazwa</div>
                    <div class="table-cell">Zdjęcie</div>
                    <div class="table-cell">Data</div>
                    <div class="table-cell">Cena wygrywająca</div>
                    <div class="table-cell">Miejscowość</div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    console.log(getId());
    API(getId());
</script>

</body>
</html>
