
function API(ID) {
    const data = { search: ID };
    fetch("/getSavedAuctions", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(function (licytacje) {
        // Dekodowanie zakodowanych danych
        licytacje.forEach(function (row) {
           // row.lic_picture = atob(row.lic_picture);
        });

        console.log(licytacje);
        generateTableRows(licytacje);
    }).catch(error => {
        console.error("Błąd podczas pobierania danych:", error);
    });
}



function generateTableRows(licytacje) {
    var tableContainer = document.getElementById('tableContainer');

    function createTableRow(row) {
        var tableRow = document.createElement('div');
        tableRow.className = 'table-row';

        var tableCellId = document.createElement('div');
        tableCellId.className = 'table-cell';
        tableCellId.textContent = row.lic_id;
        tableRow.appendChild(tableCellId);

        var tableCellName = document.createElement('div');
        tableCellName.className = 'table-cell';
        tableCellName.textContent = row.lic_name;
        tableRow.appendChild(tableCellName);

        var tableCellImage = document.createElement('div');
        tableCellImage.className = 'table-cell';
        tableCellImage.innerHTML = '<img src="data:image/jpeg;base64,' + row.lic_picture + '">';
        tableRow.appendChild(tableCellImage);

        var tableCellDate = document.createElement('div');
        tableCellDate.className = 'table-cell';
        tableCellDate.textContent = row.lic_date;
        tableRow.appendChild(tableCellDate);

        var tableCellPrice = document.createElement('div');
        tableCellPrice.className = 'table-cell';
        tableCellPrice.textContent = row.lic_highest_price;
        tableRow.appendChild(tableCellPrice);

        var tableCellTown = document.createElement('div');
        tableCellTown.className = 'table-cell';
        tableCellTown.textContent = row.lic_town;
        tableRow.appendChild(tableCellTown);



        var tableCellButton = document.createElement('div');
        tableCellButton.className = 'table-cell';
        var button = document.createElement('button');
        button.type = 'button';
        button.textContent = 'Wejdz';
        button.addEventListener('click', function() {
            window.location.href = '/licytacja/' + parseInt(row.lic_id);
        });
        tableCellButton.appendChild(button);
        tableRow.appendChild(tableCellButton);

        return tableRow;
    }

    licytacje.forEach(function(row) {
        var newRow = createTableRow(row);
        tableContainer.appendChild(newRow);
    });
}
