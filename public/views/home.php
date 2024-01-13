<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/home.css"/>
    <script src="\public\js\session.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<script>
    init(
        <?php
        if(isset($_GET['idUser'])) {
            echo json_encode($_GET['idUser']);
        }
        else{
            echo null;
        }
        ?>
    );

</script>
<?php
unset($_GET);
?>

<div class="container">

    <button class="logout-button" type="button" onclick="logout()">WYLOGUJ</button>

    <div class="logo">
        <img src="/public/img/logo.svg">
    </div>
    <div class="login-container">
        <form id="myForm">
            <button type="button" onclick="changeUrl('/licytacje')">LICYTACJE</button>
            <button type="button" onclick="changeUrl('/moje_licytacje')">MOJE AUKCJE</button>
            <button type="button" onclick="changeUrl('/licytacje_archiwalne')">LICYTACJE ARCHIWALNE</button>
        </form>

        <script>
            function changeUrl(newUrl) {
                window.location.href = newUrl;
            }
        </script>
    </div>
</div>
</body>
</html>
