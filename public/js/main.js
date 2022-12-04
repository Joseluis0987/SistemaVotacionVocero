const botones = document.querySelectorAll(".Eliminar");
botones.forEach(boton => {
    boton.addEventListener("clic", function(){
        const id = this.dataset.id;
        const confirm = window.confirm("Eliminar al usuario"+id+"?");
        if(confirm) {
            httpReques("http://localhost/sistemavotacion/Usuario/eliminar"+id, function() {
                console.log(this.responseText);
                const tbody = document.querySelector("#tbody-usuario");
                const fila = document.querySelector("#fila-"+id);
                tbody.removeChild(fila);
            });
        }
    });

});

function httpReques(url, callBack) {
    const http = new XMLHttpRequest();
    http.open("GET", url);
    http.send();
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            callBack.apply(http);
        }
    }
    return;
}