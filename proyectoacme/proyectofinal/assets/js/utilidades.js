
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

function scrollNav() {
    const enlaces = document.querySelectorAll(".navegacion-principal a")

    enlaces.forEach(enlace => {

        enlace.addEventListener('click', function (e) {

            // cancelar el evento que tiene por defecto
            e.preventDefault()

            // el target nos trae el elemento al cual le dimos click
            const seccionScroll = e.target.attributes.href.value;

            const seccion = document.querySelector(seccionScroll);

            // esta funcion nos manda a la seccion a la cual le hayamos puesto la direccion
            seccion.scrollIntoView({ behavior: "smooth" })
        });

    });

}


//ADMIN

let agregarExperticias = document.getElementById("agregarExperticias");
let iteradorExperticia = 0;


if (agregarExperticias) {
    iteradorExperticia = 2
    agregarExperticias.addEventListener("click", e => {

        e.preventDefault();
        const contenedorExperticias = document.getElementById("contenedorExperticias");

        const contenidoExperticia = createTag("div");
        const labelContenidoExperticia = createTagWithText("label", "Experticia")
        const inputExperticia = createTag("input")

        contenedorExperticias.classList.add("form-group")
        inputExperticia.classList.add("w-100")
        inputExperticia.classList.add("form-control");
        inputExperticia.setAttribute('name', `experticia${iteradorExperticia}`)

        addElementContainer(contenidoExperticia, labelContenidoExperticia);
        addElementContainer(contenidoExperticia, inputExperticia);
        addElementContainer(contenedorExperticias, contenidoExperticia);

        iteradorExperticia++

    });

}

let agregarEstudios = document.getElementById("agregarEstudios");
let iteradorEstudio = 0

if (agregarEstudios) {
    iteradorEstudio = 2
    agregarEstudios.addEventListener("click", e => {

        e.preventDefault();
        const contenedorEstudios = document.getElementById("contenedorEstudios");

        const contenidoEstudios = createTag("div");
        const labelContenidoEstuio = createTagWithText("label", "Estudios")
        const inputEstudios = createTag("input")

        contenedorEstudios.classList.add("form-group")
        inputEstudios.classList.add("w-100")
        inputEstudios.classList.add("form-control");
        inputEstudios.setAttribute('name', `estudio${iteradorEstudio}`)

        addElementContainer(contenidoEstudios, labelContenidoEstuio);
        addElementContainer(contenidoEstudios, inputEstudios);
        addElementContainer(contenedorEstudios, contenidoEstudios);

        iteradorEstudio++

    });

}
let totalEstudios = 0;
let totalExperticia = 0;
const btnRegistrarProfesional = document.getElementById('registrarProfesional');

if (btnRegistrarProfesional) {
    btnRegistrarProfesional.addEventListener("click", ()=>{

        totalEstudios = iteradorEstudio 
        totalExperticia = iteradorExperticia

        let inputTotalEstudios = document.getElementById('totalEstudios')
        inputTotalEstudios.value = totalEstudios

        let inputTotalExperticia = document.getElementById('totalExperticias')
        inputTotalExperticia.value = totalExperticia

        iteradorEstudio = 0
        iteradorExperticia = 0

    })
}

const btnCancelarRegistroProfesional = document.getElementById('cancelarRegistroProfesional')
if(btnCancelarRegistroProfesional){
    btnCancelarRegistroProfesional.addEventListener("click", ()=>{
        window.location.href = "../../vista/admin/crearProfesionales.php";
    })
}

const btnCancelarRegistroCliente = document.getElementById('cancelarRegistroCliente');
if (btnCancelarRegistroCliente) {
    btnCancelarRegistroCliente.addEventListener("click", ()=>{
        window.location.href = "../../vista/secretaria/registrarusuario.php";
    })
}



//DIAGNOSTICO - REACTIVOS NECESARIOS
let iteradorReactivosNecesarios = 0;
let totalReactivosNecesarios = 0;

function cargarReactivosNecesarios() {
    const contenedorReactivosNecesarios = document.getElementById("contenedorElementosNecesariosClon");
    const contenidoReactivosNecesarios = createTag("div");
    const labelReactivosNecesarios = createTagWithText("label", "Reactivo")
    let selectReactivosNecesarios = createTag('select')
    selectReactivosNecesarios.setAttribute('name', `reactivoNecesario${iteradorReactivosNecesarios}`)
    selectReactivosNecesarios.required = 'true';
    
    let option = `<option value = ''>escoja una opcion</option>`

    const archivo = 'reactivos.json'
    // const archivo = '../../vista/profesional/servicios.json'

    fetch(archivo)

        .then(resultado => {
            return resultado.json();
        })

        .then(reactivos => {
            //    console.log(datos)
            reactivos.forEach(reactivo => {
                option += `<option value = '${reactivo.identificador}'>${reactivo.nombre}</option>`
                selectReactivosNecesarios.innerHTML = option;
            });
        })

        addElementContainer(contenedorReactivosNecesarios, labelReactivosNecesarios);
        addElementContainer(contenidoReactivosNecesarios, selectReactivosNecesarios)
        addElementContainer(contenedorReactivosNecesarios, contenidoReactivosNecesarios);

}

let agregarReactivosNecesarios = document.getElementById("agregarReactivosNecesarios");
if (agregarReactivosNecesarios) {
    iteradorReactivosNecesarios = 2
    agregarReactivosNecesarios.addEventListener("click", e => {
        e.preventDefault();
        cargarReactivosNecesarios()
        iteradorReactivosNecesarios++
    });

}

//DIAGNOSTICO - MAQUINA NECESARIA
let iteradorMaquinasNecesarias = 0;
let totalMaquinasNecesarias = 0;

function cargarMaquinasNecesarias() {
    const contenedorMaquinasNecesarias = document.getElementById("contenedorMaquinasNecesariasClon");
    const contenidoMaquinasNecesarias = createTag("div");
    const labelMaquinasNecesarios = createTagWithText("label", "Maquina")
    let selectMaquinasNecesarias = createTag('select')
    selectMaquinasNecesarias.setAttribute('name', `maquinaNecesaria${iteradorMaquinasNecesarias}`)
    selectMaquinasNecesarias.required = 'true';
    
    let option = `<option value = ''>escoja una opcion</option>`

    const archivo = 'maquinas.json'
    // const archivo = '../../vista/profesional/servicios.json'

    fetch(archivo)

        .then(resultado => {
            return resultado.json();
        })

        .then(maquinas => {
            //    console.log(datos)
            maquinas.forEach(maquina => {
                option += `<option value = '${maquina.identificador}'>${maquina.nombre}</option>`
                selectMaquinasNecesarias.innerHTML = option;
            });
        })

        addElementContainer(contenedorMaquinasNecesarias, labelMaquinasNecesarios);
        addElementContainer(contenidoMaquinasNecesarias, selectMaquinasNecesarias)
        addElementContainer(contenedorMaquinasNecesarias, contenidoMaquinasNecesarias);

}

let agregarMaquinaNecesarias = document.getElementById("agregarMaquinaNecesarias");
if (agregarMaquinaNecesarias) {
    iteradorMaquinasNecesarias = 2
    agregarMaquinaNecesarias.addEventListener("click", e => {

        e.preventDefault();
        cargarMaquinasNecesarias();
        iteradorMaquinasNecesarias++;
    });

} 

//DIAGNOSTICO - MATERIA PRIMA NECESARIA
let iteradorMateriasPrimasNecesarias = 0;
let totalMateriasPrimasNecesarias = 0;

function cargarMateriasPrimasNecesarias() {
    const contenedorMateriasPrimasNecesarias = document.getElementById("contenedorMateriasPrimasNecesarias");
    const contenidoMateriasPrimasNecesarias = createTag("div");
    const labelMateriasPrimasNecesarias = createTagWithText("label", "Materia Prima")
    let selectMateriasPrimasNecesarias = createTag('select')
    selectMateriasPrimasNecesarias.setAttribute('name', `materiaPrimaNecesaria${iteradorMateriasPrimasNecesarias}`)
    selectMateriasPrimasNecesarias.required = 'true';
    
    let option = `<option value = ''>escoja una opcion</option>`

    const archivo = 'materiasPrimas.json'

    fetch(archivo)

        .then(resultado => {
            return resultado.json();
        })

        .then(maquinas => {
            //    console.log(datos)
            maquinas.forEach(maquina => {
                option += `<option value = '${maquina.identificador}'>${maquina.nombre}</option>`
                selectMateriasPrimasNecesarias.innerHTML = option;
            });
        })

        addElementContainer(contenedorMateriasPrimasNecesarias, labelMateriasPrimasNecesarias);
        addElementContainer(contenidoMateriasPrimasNecesarias, selectMateriasPrimasNecesarias)
        addElementContainer(contenedorMateriasPrimasNecesarias, contenidoMateriasPrimasNecesarias);

}

let agregarMateriasPrimasNecesarias = document.getElementById('agregarMateriasPrimasNecesarias');

if (agregarMateriasPrimasNecesarias) {
    iteradorMateriasPrimasNecesarias = 2
    agregarMateriasPrimasNecesarias.addEventListener('click', e =>{
        e.preventDefault();
        cargarMateriasPrimasNecesarias();
        iteradorMateriasPrimasNecesarias++;
    })
}

//CANCELAR CREACION DEL SERVICIO

let cancelarRegistroServicio = document.getElementById('cancelarRegistroServicio');
if (cancelarRegistroServicio) {
    cancelarRegistroServicio.addEventListener('click', ()=>{
        window.location.href = "../../vista/admin/crearServicios.php";
    } )
}

//CREAR SERVICIO

let registrarServicio = document.getElementById('registrarServicio');

if (registrarServicio) {
    registrarServicio.addEventListener('click', ()=>{
        totalReactivosNecesarios = iteradorReactivosNecesarios
        totalMaquinasNecesarias = iteradorMaquinasNecesarias
        totalMateriasPrimasNecesarias = iteradorMateriasPrimasNecesarias
    
        let inputTotalServiciosNecesarios = document.getElementById('totalReactivosNecesarios');
        inputTotalServiciosNecesarios.value = totalReactivosNecesarios
    
        let inputTotalMaquinasNecesarias = document.getElementById('totalMaquinasNecesarias');
        inputTotalMaquinasNecesarias.value = totalMaquinasNecesarias
        
        let inputTotalMateriasPrimasNecesarias = document.getElementById('totalMateriasPrimasNecesarias');
        inputTotalMateriasPrimasNecesarias.value = totalMateriasPrimasNecesarias
    })

}


// Toggle the side navigation
const sidebarToggle = document.body.querySelector('#sidebarToggle');
if (sidebarToggle) {
    // Uncomment Below to persist sidebar toggle between refreshes
    // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
    //     document.body.classList.toggle('sb-sidenav-toggled');
    // }
    sidebarToggle.addEventListener('click', event => {
        event.preventDefault();
        document.body.classList.toggle('sb-sidenav-toggled');
        localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
    });
}








