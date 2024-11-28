
function createTag(tag) {
    var tagHtml = document.createElement(tag);
    return tagHtml
}

function createTagWithText(tag, text) {
    var tagHtml = createTag(tag);
    var textHtml = document.createTextNode(text);
    tagHtml.appendChild(textHtml);
    document.body.appendChild(tagHtml);
    return tagHtml;
}

function addElementContainer(container, element) {
    container.appendChild(element)
}

function addElement(element) {
    document.body.appendChild(element);
}

let iteradorServicioNecesario = 0
let totalServiciosNecesarios = 0;

function cargarServiciosNecesarios() {
    const contenedorServiciosNecesarios = document.getElementById("contenedorServiciosNecesarios");
    const contenidoServiciosNecesarios = createTag("div");
    const labelServicioNecesario = createTagWithText("label", "Servicio")
    let selectServicioNecesario = createTag('select')
    selectServicioNecesario.setAttribute('name', `servicioNecesario${iteradorServicioNecesario}`)
    selectServicioNecesario.required = 'true';
    
    let option = `<option value = ''>escoja una opcion</option>`

    const archivo = 'servicios.json'
    // const archivo = '../../vista/profesional/servicios.json'

    fetch(archivo)

        .then(resultado => {
            return resultado.json();
        })

        .then(servicios => {
            //    console.log(datos)
            servicios.forEach(servicio => {
                // console.log(servicio.nombre);
                // arregloServicios.push(servicio.nombre)
                option += `<option value = '${servicio.identificador}'>${servicio.nombre}</option>`
                selectServicioNecesario.innerHTML = option;
                // console.log(option)
            });
            // console.log(selectServicioNecesario)
        })

        addElementContainer(contenedorServiciosNecesarios, labelServicioNecesario);
        addElementContainer(contenidoServiciosNecesarios, selectServicioNecesario)
        addElementContainer(contenedorServiciosNecesarios, contenidoServiciosNecesarios);

}


const btnAgregarServiciosNecesarios = document.getElementById('agregarServiciosNecesarios');

if (btnAgregarServiciosNecesarios) {
    iteradorServicioNecesario = 2
    btnAgregarServiciosNecesarios.addEventListener('click', (e) =>{
        e.preventDefault();
        cargarServiciosNecesarios();

        iteradorServicioNecesario++;


    })
}

const btnCancelarDiagnostico = document.getElementById('cancelarDiagnostico');
if (btnCancelarDiagnostico) {
    btnCancelarDiagnostico.addEventListener("click", ()=>{
        window.location.href = "../../vista/profesional/diagnostico.php";
    })
}

const btnRegistrarDiagnostico = document.getElementById('registrarDiagnostico')
if (btnRegistrarDiagnostico) {
    btnRegistrarDiagnostico.addEventListener('click', ()=>{

        totalServiciosNecesarios = iteradorServicioNecesario

        let inputTotalServiciosNecesarios = document.getElementById('totalServiciosNecesarios');
        inputTotalServiciosNecesarios.value = totalServiciosNecesarios

    })
}