
function init(id) {
    let storedId = sessionStorage.getItem('id');
    if(storedId){
        return;
    }
    if (id == null) {
        window.location.href = '/';
    } else {
        if (!storedId) {
            sessionStorage.setItem('id', id);
        }
    }
}


function checkId() {
    let storedId = sessionStorage.getItem('id');
    if (!storedId) {
      //  window.location.href = '/';
    }
}

function getId(){
    let storedId = sessionStorage.getItem('id');
    if(!storedId){
        return null;
    }
    return storedId;
}

function logout() {
    // Wyczyść dane z sesji
    sessionStorage.clear();


    // Przekieruj na stronę logowania
    window.location.href = '/';
}

window.addEventListener('pageshow', function (event) {
    if (event.persisted) {
        if(!sessionStorage.getItem('id')){
            window.location.href = '/';
        }
    }
});