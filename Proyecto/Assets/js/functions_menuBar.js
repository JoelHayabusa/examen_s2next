let originMenuDataObject = {};
let modelJerarquicoMenuBar = {};
document.addEventListener("DOMContentLoaded", async function(){
    console.log("Se ejecutó despues de cargar todo el dom");
    getItemsMenuBar();
    // make it as accordion for smaller screens
    if (window.innerWidth < 992) {
    
      // close all inner dropdowns when parent is closed
      document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){
        everydropdown.addEventListener('hidden.bs.dropdown', function () {
          // after dropdown is hidden, then find all submenus
            this.querySelectorAll('.submenu').forEach(function(everysubmenu){
              // hide every submenu as well
              everysubmenu.style.display = 'none';
            });
        })
      });
    
      document.querySelectorAll('.dropdown-menu a').forEach(function(element){
        element.addEventListener('click', function (e) {
            let nextEl = this.nextElementSibling;
            if(nextEl && nextEl.classList.contains('submenu')) {	
              // prevent opening link if link needs to open dropdown
              e.preventDefault();
              if(nextEl.style.display == 'block'){
                nextEl.style.display = 'none';
              } else {
                nextEl.style.display = 'block';
              }
    
            }
        });
      })
    }
    // end if innerWidth
    }); 
    // DOMContentLoaded  end

const getItemsMenuBar = async () =>
{
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl= getAbsolutePath()+'../home/listar_menus';
    console.log( getAbsolutePath());
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = async function (){
        if(request.readyState == 4 && request.status == 200){
            console.log(request.responseText)
            originMenuDataObject = JSON.parse(request.responseText);
            await constructMebuBar ();
        }
       
    }
} 

const constructMebuBar = async () => {
    await trasformModel ();
    //Este codigo solo es capaz de representar el menu hasta un segundo nivel, pero no se especificó.
    //Si se desea tener un multinivel es necesario ajustar este algoritmo a uno recursivo
    for (let index = 0; index < modelJerarquicoMenuBar.length; index++) {
        const element = modelJerarquicoMenuBar[index];
        let code="";
        if(element.id_menu_padre === null){
            if(element.child===undefined){
                code +='<li class="nav-item" id="li_'+element.id+'"> <a class="nav-link" id="a_'+element.id+'" onclick="abrirVistaMenu(\''+element.id+'\')">'+element.nombre+' </a> </li>';
            }else{
                code += '<li class="nav-item dropdown" id="dropdown_'+element.id+'">';
                code += '<a class="nav-link dropdown-toggle"  data-bs-toggle="dropdown">'+element.nombre+'</a>';
                code += '<ul class="dropdown-menu" id="listChild_'+element.id+'">';
                code += '</ul>';
            }
        }else{
            console.log("tiene papa "+element.nombrePadre); 
            let codeChild="";
            codeChild +='<li class="dropdown-item" id="li_'+element.id+'" onclick="abrirVistaMenu(\''+element.id+'\')">'+element.nombre+' </li>';
            $( "#listChild_"+element.id_menu_padre).append(codeChild);
        }
        $( "#mainMenu" ).append(code);
    }

}
const trasformModel = async () => {
    modelJerarquicoMenuBar = originMenuDataObject;
    for (let index = 0; index < originMenuDataObject.length; index++) {
        const element = originMenuDataObject[index];
        //console.log("element.id_menu_padre "+element.id_menu_padre);
        if(element.id_menu_padre !== undefined && element.id_menu_padre !== null){
            
            let indexArrJ = modelJerarquicoMenuBar.findIndex(x => x.id == element.id_menu_padre);
            //console.log("indexArrJ "+indexArrJ);
            let arrChild=[];
            if(modelJerarquicoMenuBar[indexArrJ].child !== undefined){
                arrChild = modelJerarquicoMenuBar[indexArrJ].child;
            }
            arrChild.push(element.id);
            modelJerarquicoMenuBar[indexArrJ].child = arrChild;
        }
    }
    console.log(modelJerarquicoMenuBar);
}
const abrirVistaMenu = (idMenu) =>{
    //alert(idMenu);
    let indexArrJ = modelJerarquicoMenuBar.findIndex(x => x.id == idMenu);
    let element = modelJerarquicoMenuBar[indexArrJ];

    let code ='<div class="mt-5">';
        code +='<h2 id="vistaMenuTitle">'+element.nombre+'</h2>';
        code +='<p id="vistaMenuDesc" >'+element.descripcion+'</p>';
        code +='</div>';
        $( "#vistaMenu" ).empty();
        $( "#vistaMenu" ).append(code);
}