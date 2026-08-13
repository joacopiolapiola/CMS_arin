    let categorias = [
    {id:"1", nombre:"RAIZ",link:"raiz_cms.php"},
    {id:"2", nombre:"TOPICOS",link:"tecnologias_cms.php"},
    {id:"3", nombre:"SECCIONES",link:"secciones_cms.php"},
    {id:"4", nombre:"USUARIOS",link:"usuarios_cms.php"}
         ];
  let secciones = [         ];
  let miscs = [];
  let raiz = [];
  let menu = [];
  let i_slider=-1;
  let Max_miscs=0;
  let tecnos = [         ];

  function getEl(id) {
    return document.getElementById(id);
  }

  function safeSetHtml(id, html) {
    const el = getEl(id);
    if (el) {
      el.innerHTML = html ?? '';
    }
  }

  function safeSetText(id, text) {
    const el = getEl(id);
    if (el) {
      el.textContent = text ?? '';
    }
  }

 
 
         function poner_colores(div,color,bkg_color)
         {
           if (!div) return;
           $(div).css('color', color);
           $(div).css('background-color',bkg_color);
         }

       function cargar(div,desde)
        {
        $(div).load(desde);
        } 

        function preparar(div,desde,id_hdr,id_hdr_txt)
        {
          $(id_hdr).text(id_hdr_txt);
          $(div).load(desde);
          $('#Contenido').load('blanco.php');
        }
        function cargar_cms(div,desde,div_hdr,titulo)
        {
        $(div_hdr).text(titulo);
        $(div).load(desde);
        $('#Contenido').load('blanco.php');
        } 

        function poner_nombre(div,nombre)
        {
        $(div).text(nombre);
        } 
  
        function poner_imagen(div,imagen)
        {
       
       alert(imagen);
        $(div).attr("src",imagen); 
        } 
     
        function poner_menu(div,nombre)
        {
        let enlace;
        let ix=div.slice(-1);
       
        //$(div).text(nombre);
        enlace='<a href="#" class="menu-link" data-link="'+categorias[ix-1].link+'" data-title="'+categorias[ix-1].nombre+'">'+categorias[ix-1].nombre+'</a>';
        ix=div.slice(1);
        //alert(ix+": "+enlace);
        
        document.getElementById(ix).innerHTML=enlace;
        //$(div).attr.bk_color(categorias[ix-1].bk_color);
        //document.getElementById(div).style.backgroundColor =categorias[ix-1].bk_color;
     
        } 
     
        function poner_cat(div)
        {
        let ix=div.slice(1);
        
        let nombre=document.getElementById(div).innerHTML;
        document.getElementById("id_cat").innerHTML=categorias[ix-1].ID_tecnologia;
        
        //document.getElementById("Hdr_Contenido").innerHTML='<H4>'+categorias[ix-1].nombre+'</H4>';
        poner_secciones();
        if(categorias[ix-1].nombre=='SECCIONES')
          toggleVis('submenu','visible');
        else
          toggleVis('submenu','hidden');
        } 
     
              
        
        

        function poner_secciones()
        {
         const catEl = getEl("id_cat");
         if (!catEl) return;
         let enlace; 
         let id;
         let tecno = (catEl.innerText ?? catEl.textContent ?? '').trim() || '1';
         let pos='1';
         let id_s;
         let n=0;
         let idx;
         const ordenEl = getEl("orden");
         if (ordenEl) {
           pos = (ordenEl.innerText ?? ordenEl.textContent ?? '').trim() || '1';
         }
          
         for(i=0;i<secciones.length;i++){ 
         idx="S"+(i+1);
         const hiddenEl = getEl(idx);
         if (hiddenEl) {
           hiddenEl.style.visibility='hidden';
         }
          if(secciones[i].id_tecnologia==tecno){

            id="S"+(n+1);
            const itemEl = getEl(id);
            if (!itemEl) continue;
           
            enlace='<div class="seccion-link" data-link="'+secciones[i].enlace+'?str_b='+tecno+'">'+secciones[i].nombre+'</div>';
           
            //$(id).text(secciones[i].nombre);
            //document.getElementById(id).innerHTML=secciones[i].nombre;
            if(tecno!='0')
                itemEl.innerHTML=enlace;
            else
                itemEl.innerHTML=secciones[i].nombre;

                id_s="#"+id;
            itemEl.style.visibility='visible';    
            if(tecno!='0') {
              const categoria = categorias[Number(pos)-1] || null;
              if (categoria) {
                poner_colores(id_s,categoria.color,categoria.bkg_color);
              }
            } else {
              const base = raiz && raiz[0] ? raiz[0] : {};
              poner_colores(id_s,base.color || '',base.bkg_color || '');
            }
            n++;
            }
         
            }
        
        
        } 
     
         function toggleVis(div,visi) {
             const elemento = document.getElementById(div);
             if (elemento) {
               elemento.style.visibility = visi;
             }
             //if (elemento.style.visibility === 'hidden') {
             //    elemento.style.visibility = 'visible';
             //} else {
             //    elemento.style.visibility = 'hidden';
          }
         
    
          function poner_submenu()
          {
           let enlace; 
           let idx;
           
                       
           for(i=0;i<secciones.length;i++){ 
           idx="S"+(i+1);
           const itemEl = getEl(idx);
           if (!itemEl) continue;
           enlace='<div class="submenu-link" data-link="'+secciones[i].enlace_cms+'" data-title="'+secciones[i].nombre+'">'+secciones[i].nombre+'</div>';
           itemEl.innerHTML=enlace;
  
                         
              }
          
          
          } 

    function upload_image(){//Funcion encargada de enviar el archivo via AJAX
    var msg=".upload-msg";
    var dest="fileToUpload";
    $(msg).text('Cargando...');
    var inputFileImage = document.getElementById(dest);
    var file = inputFileImage.files[0];
    var data = new FormData();
    data.append(dest,file);
    
              
    $.ajax({
      url: "subir_img.php",        // Url to which the request is send
      type: "POST",             // Type of request to be send, called as method
      data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
      contentType: false,       // The content type used when sending data to the server.
      cache: false,             // To unable request pages to be cached
      processData:false,        // To send DOMDocument or non processed data file it is set to false
      success: function(data)   // A function to be called if request succeeds
      {
        $(msg).html(data);
        window.setTimeout(function() {
        $(".alert-dismissible").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
        });	}, 5000);
      }
    });
    
  }

  function PonerNombreArchivo(){
  var f="txtImg";
	var dest="fileToUpload";
    var x = document.getElementById(dest);
    
    var txt = "";
    var file = x.files[0];
                
    txt = file.name ;
           
    document.getElementById(f).value = txt;
}

        

function poner_tecnos()
          {
           const hdr = getEl('hdr_tecs');
           if (!hdr) return;
           let enlace=''; 
                       
           for(i=0;i<tecnos.length;i++)
              enlace=enlace+tecnos[i].ID_tecnologia +'-'+tecnos[i].nombre+' | ';

           hdr.innerHTML=enlace;
          } 



        function insertarTextoEnCursor(div,etiq) {
            // Referencia al TextArea
            const textArea = document.getElementById(div);

            // Texto que queremos insertar
            const texto = etiq;

            // Obtener la posición del cursor
            const start = textArea.selectionStart;
            const end = textArea.selectionEnd;

            // Obtener el texto antes y después del cursor
            const textoAntes = textArea.value.substring(0, start);
            const textoDespues = textArea.value.substring(end);

            // Insertar el texto en la posición del cursor
            textArea.value = textoAntes + texto + textoDespues;

            // Colocar el cursor justo después del texto insertado
            textArea.selectionStart = textArea.selectionEnd = start + texto.length;

            // Dar foco de nuevo al TextArea
            textArea.focus();
        }
  

      function VerificarCampos(){
        document.getElementById('FormUser').addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar el envío del formulario

            // Obtener valores de los campos
            const email = document.getElementById('txtEmail').value;
            const password = document.getElementById('txtPassword').value;
            const repeatPassword = document.getElementById('txtPasswordRepetir').value;
            const username = document.getElementById('txtNombre').value;
            const phone = document.getElementById('TxtTelefono').value;
            const school = document.getElementById('txtInstitucion').value;
            const permissions = document.getElementById('txtPermisos').value;
            //const permissions = document.querySelectorAll('input[name="permissions"]:checked');
            
            // Inicializar errores
            let hasErrors = false;
            document.getElementById('DataError').textContent = '';

            // Validar Correo Electrónico
            let patern= /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email.trim() === '') {
                document.getElementById('DataError').textContent = 'El correo electrónico es obligatorio.';
                hasErrors = true;
            } else if (!patern.test(email)) {
                document.getElementById('DataError').textContent = 'El correo electrónico no es válido.';
                hasErrors = true;
            } else {
                //document.getElementById('DataError').textContent = '';
            }

            // Validar Contraseña
            if (password.trim() === '') {
                document.getElementById('DataError').textContent += 'La contraseña es obligatoria.';
                hasErrors = true;
            } else {
                //document.getElementById('DataError').textContent = '';
            }

            // Validar Repetir Contraseña
            if (repeatPassword.trim() === '') {
                document.getElementById('DataError').textContent += 'Debe repetir la contraseña.';
                hasErrors = true;
            } else if (password !== repeatPassword) {
                document.getElementById('DataError').textContent += 'Las contraseñas no coinciden.';
                hasErrors = true;
            } else {
                //document.getElementById('DataError').textContent = '';
            }

            // Validar Nombre de Usuario
            if (username.trim() === '') {
                document.getElementById('DataError').textContent += 'El nombre de usuario es obligatorio.';
                hasErrors = true;
            } else {
                //document.getElementById('DataError').textContent = '';
            }

            // Validar Número de Teléfono
            if (phone.trim() === '') {
                document.getElementById('DataError').textContent += 'El número de teléfono es obligatorio.';
                hasErrors = true;
            } else if (!/^[0-9]{10}$/.test(phone)) {
                document.getElementById('DataError').textContent += 'El número de teléfono debe tener 10 dígitos.';
                hasErrors = true;
            } else {
                //document.getElementById('DataError').textContent = '';
            }
/*
            // Validar Escuela
            if (school.trim() === '') {
                document.getElementById('DataError').textContent = 'La escuela es obligatoria.';
                hasErrors = true;
            } else {
                document.getElementById('DataError').textContent = '';
            }
*/
            // Validar Permisos
            if (permissions.length === 0) {
                document.getElementById('DataError').textContent += 'Debe seleccionar al menos un permiso.';
                hasErrors = true;
            } else {
                //document.getElementById('DataError').textContent = '';
            }

            // Si no hay errores, enviar el formulario
            if (!hasErrors) {
                this.submit();
            }
        });
      }

// Delegated click handlers for menu, seccion and submenu links
(function(){
  document.addEventListener('click', function(e){
    const actionable = e.target && e.target.closest ? e.target.closest('.menu-link, .seccion-link, .submenu-link') : null;
    if (!actionable) return;
    e.preventDefault();
    if (actionable.classList.contains('menu-link')) {
      const link = actionable.getAttribute('data-link');
      const title = actionable.getAttribute('data-title');
      preparar('#hdr_menu', link, '#id_hdr', title);
      return;
    }
    if (actionable.classList.contains('seccion-link')) {
      const link = actionable.getAttribute('data-link');
      cargar('#Contenido', link);
      return;
    }
    if (actionable.classList.contains('submenu-link')) {
      const link = actionable.getAttribute('data-link');
      const title = actionable.getAttribute('data-title');
      cargar_cms('#hdr_menu', link, '#id_hdr', title);
      return;
    }
  });
})();