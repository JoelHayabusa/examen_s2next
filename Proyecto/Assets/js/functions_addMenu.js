var tableMenu;

window.addEventListener('load',function(){
    setTimeout(function(){ 
                            fntDelMenu();
                            fntEditMenu();
                            console.log("Se ejecutó"); 
                }, 1000);
    
}, false);
document.addEventListener('DOMContentLoaded', function(){
    tableMenu =  $('#menuList').DataTable({
        "aProcessing": true,
        "aServerSide":true,
        "language":{
            "url":"//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
            "dataSrc":""
        },
        "ajax":{
            "url": getAbsolutePath()+"/home/listar_menus",
            "dataSrc":""
        },
        "columns": [
            { "data": "id" },
            { "data": "nombre" },
            { "data": "descripcion" },
            { "data": "nombrePadre" },
            { "data": "fch_modificacion" },
            { "data": "opciones" }
        ],
        "responsive":"true",
        "bDestroy":true,
        "iDisplayLength":10,
        "order": [[0,"desc"]]
    });
    //Nuevo Menu
    let formMenu = document.querySelector("#formAddMenu");
    formMenu.onsubmit= function(e){
        e.preventDefault();
        let strNombre = document.querySelector("#formAddMenuNombre").value;
        let strDescripcion = document.querySelector("#formAddMenuDescripcion").value;
        let idPadre = document.querySelector("#cbbNombrePadre").value;
        let idMenu = document.querySelector("#idMenu").value;
       
        if(strNombre==''||strDescripcion==''){
            alert("Todos los caompos son obligatorios");
            return false;
        }
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl= getAbsolutePath()+'Home/setMenu';
        console.log(ajaxUrl);
        let formData = new FormData();
        formData.append("strNombre", strNombre);
        formData.append("strDescripcion", strDescripcion);
        formData.append("idPadre", idPadre);
        formData.append("idMenu", idMenu);
        console.log(formData);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function (){
            if(request.readyState == 4 && request.status == 200){
                var objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    $('#modalAddMenu').modal("hide");
                    formMenu.reset();
                    tableMenu.ajax.reload(function(){
                        fntDelMenu();
                        fntEditMenu();
                    });

                }else{
                    alert("Error al intentar guardar");
                }
            }
           
        }
    }
});

const openAddMenuModal = async () => {
    llenarComboPadres();
    document.querySelector('#exampleModalLongTitle').innerHTML = "Nuevo Menu ";
    document.querySelector('#btnFormAction').innerHTML = "Guardar";
    document.querySelector('#idMenu').value=-1;
    document.querySelector("#formAddMenuNombre").value="";
    document.querySelector("#formAddMenuDescripcion").value="";
    document.querySelector("#cbbNombrePadre").value=0;
    $('#modalAddMenu').modal('show');
}
const  openUpdateMenuModal = () => {
    document.querySelector('#exampleModalLongTitle').innerHTML = "Actualizar Menu ";
    document.querySelector('#btnFormAction').innerHTML = "Actualizar";
    
    $('#modalAddMenu').modal('show');
}
const  closeAddMenuModal = () => {
    $('#modalAddMenu').modal('hide');
}
const fntDelMenu = () => {
    let btnDelMenu = document.querySelectorAll(".btnDelMenu");
    //console.log(btnDelMenu);
    btnDelMenu.forEach(function(btnDelMenu){
        //console.log("uno");
        btnDelMenu.addEventListener('click', function(){
            let idMenu = this.getAttribute("rl");
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl= getAbsolutePath()+'Home/delMenu';
            console.log(ajaxUrl);
            let formData = new FormData();
            formData.append("idMenu", idMenu);
            console.log(formData);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function (){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        tableMenu.ajax.reload(function(){
                            fntDelMenu();
                            fntEditMenu();
                        });
    
                    }else{
                        alert("Error al intentar eliminar");
                    }
                }
               
            }
        });
    });
}
const fntEditMenu = ()=> {
    
    let fntEditMenu = document.querySelectorAll(".btnEditMenu");
    console.log(fntEditMenu);
    fntEditMenu.forEach(function(fntEditMenu){
        //console.log("uno");
        fntEditMenu.addEventListener('click', function(){
            let idMenu = this.getAttribute("rl");
            document.querySelector('#idMenu').value=idMenu;
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl= getAbsolutePath()+'home/get_menu/'+idMenu;
            console.log(ajaxUrl);
            request.open("GET", ajaxUrl, true);
            request.send();
            request.onreadystatechange = async function (){
                if(request.readyState == 4 && request.status == 200){
                    console.log(request.responseText)
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        await llenarComboPadres();
                        document.querySelector("#formAddMenuNombre").value=objData.data[0].nombre;
                        document.querySelector("#formAddMenuDescripcion").value=objData.data[0].descripcion;
                        document.querySelector("#cbbNombrePadre").value=objData.data[0].id_menu_padre;
                        $( "#cbbNombrePadre" ).val(objData.data[0].id_menu_padre);
                        openUpdateMenuModal();
                    }else{
                        alert("No se pudieron recuperar los datos");
                    }
                }
               
            }
           
        });
    });
}
async function llenarComboPadres(){
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl= getAbsolutePath()+'home/listar_padres';
    console.log(ajaxUrl);
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function (){
        if(request.readyState == 4 && request.status == 200){
            console.log(request.responseText)
            let objData = JSON.parse(request.responseText);

            let code ='<option selected value="0">Seleccionar</option>';
                for (let index = 0; index < objData.length; index++) {
                   code+='<option  value="'+objData[index].id+'">'+objData[index].nombre+'</option>'
                }
                $( "#cbbNombrePadre" ).empty()
                $( "#cbbNombrePadre" ).append(code);
        }
       
    }
}