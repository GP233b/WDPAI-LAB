function zapiszAukcje() {


    var url = window.location.href;
    var parts = url.split('/');
    var licytacjaId = parts[parts.length - 1];



        // Przygotuj dane do przesłania jako JSON
        var data = {
            licytacja_id: licytacjaId,
            id_user: getId()
        };


        // Wyslij dane za pomocą Fetch API
        fetch("/saveAuction", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(response => {
                console.log(response);

                if (response.error) {
                    alert(response.error);
                } else {
                    alert(response.message);
                }

                // Możesz dodać dodatkową logikę po otrzymaniu odpowiedzi z serwera
                location.reload(true);
            })
            .catch(error => console.error("Błąd podczas wysyłania danych:", error));

}
