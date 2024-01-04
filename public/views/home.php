<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="public/css/home.css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
<div class="container">
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