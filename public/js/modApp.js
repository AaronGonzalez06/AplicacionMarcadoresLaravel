


//cambiar tema
const cambiarModo = document.getElementById('cambiarModo');
const estiloActual = document.getElementById('modo');
const icono = document.getElementById('icono');


    //creamos el localStorage
if(!localStorage.getItem('modo')){
    localStorage.setItem('modo','oscuro');
}
const modo = localStorage.getItem('modo'); 
if (modo == "oscuro"){
    estiloActual.setAttribute('href', "http://www.marcadores-url.dev.test/css/estilosPropiosOscuro.css");
    icono.setAttribute('src', 'https://img.icons8.com/emoji/35/new-moon-emoji.png');
}else if (modo == "claro") {
    estiloActual.setAttribute('href', "http://www.marcadores-url.dev.test/css/estilosPropios.css");
    icono.setAttribute('src', 'https://img.icons8.com/external-flaticons-flat-flat-icons/35/external-sun-100-most-used-icons-flaticons-flat-flat-icons-2.png');
}

cambiarModo.addEventListener('click', function() {
    const modo = localStorage.getItem('modo'); 
    if (modo == "claro"){
        estiloActual.setAttribute('href', "http://www.marcadores-url.dev.test/css/estilosPropiosOscuro.css");
        icono.setAttribute('src', 'https://img.icons8.com/emoji/35/new-moon-emoji.png');
        localStorage.setItem('modo','oscuro');
    }else if (modo == "oscuro") {
        estiloActual.setAttribute('href', "http://www.marcadores-url.dev.test/css/estilosPropios.css");
        icono.setAttribute('src', 'https://img.icons8.com/external-flaticons-flat-flat-icons/35/external-sun-100-most-used-icons-flaticons-flat-flat-icons-2.png');
        localStorage.setItem('modo','claro');
    }
  });


//fin cambiar tema

//fav
const fav = document.querySelectorAll('.icono');
const card = document.querySelectorAll('.caja');
const modificacion = document.querySelector('.modificacion');
let cantidadCajas = card.length;
if(cantidadCajas == '0'){
    modificacion.style.display = "block";
}
fav.forEach((elemento, index) => {
    elemento.addEventListener('click', () => {
        if (elemento.classList.contains('delete')) {
            //eliminar
            const apiUrl = 'http://www.marcadores-url.dev.test/marcador/fav/delete/' + elemento.id;
            console.log(apiUrl);
            fetch(apiUrl)
            .then(response => {
                console.log(response);
                elemento.classList.remove('fav');
                card[index].style.display = "none";
                cantidadCajas--;
                console.log("🚀 ~ file: modApp.js:44 ~ cantidadCajas:", cantidadCajas);
                if(cantidadCajas == '0'){
                    modificacion.style.display = "block";
                }
            })
            .then(data => {
                console.log(data);
            })
            .catch(error => {
                console.error('Error en la solicitud:', error);
            }); 
        }else{
            if (elemento.classList.contains('fav')) {
                //eliminar
                const apiUrl = 'http://www.marcadores-url.dev.test/marcador/fav/delete/' + elemento.id;
                console.log(apiUrl);
                fetch(apiUrl)
                .then(response => {
                    console.log(response);
                    elemento.classList.remove('fav');
                    elemento.setAttribute('src','https://img.icons8.com/fluency/25/pin.png');
                })
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.error('Error en la solicitud:', error);
                });            
            } else {
                //añadir
                const apiUrl = 'http://www.marcadores-url.dev.test/marcador/fav/' + elemento.id;
                console.log(apiUrl);
                fetch(apiUrl)
                .then(response => {
                    console.log(response);
                    elemento.setAttribute('src','https://img.icons8.com/stickers/25/pin.png');
                    elemento.classList.add('fav');
                })
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.error('Error en la solicitud:', error);
                });
            }
        }
  });
});


//formulario
const formulario = document.getElementById('formularioBuscar');
const titulo = document.getElementById('titulo');
titulo.addEventListener('input', function() {
    formulario.setAttribute('action', 'http://www.marcadores-url.dev.test/marcador/buscar/' + titulo.value);
});