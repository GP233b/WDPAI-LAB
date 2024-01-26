function wyslijOferte() {

    var cena = document.getElementById("bid-amount").value;


    var licytacjaId = document.getElementById("licytacja-id").value;


    var data = {
        bid_amount: cena,
        licytacja_id: licytacjaId,
        id_user: getId()
    };
    console.log(data.id_user);
    console.log(data.licytacja_id);

    // Wyslij dane za pomocą Fetch API
    fetch("/updateAuction", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)

    })
        .then(response => response.text())
        .then(response => {
            console.log(response);

        })

        .catch(error => console.error("Błąd podczas wysyłania danych:", error));


    location.reload(true);
    location.reload(true);
}
