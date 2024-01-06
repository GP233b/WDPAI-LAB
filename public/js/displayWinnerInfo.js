function displayWinnerInfo(licytacjaDate) {
    var dataLicytacjiObj = new Date(licytacjaDate);
    var dzisiaj = new Date();

    if (dataLicytacjiObj < dzisiaj) {
        document.write("<div class=\"table-cell\">Zwycięzca</div>");
    } else {
        document.write("<div class=\"table-cell\">Aktualny Wygrywający</div>");
    }
}
