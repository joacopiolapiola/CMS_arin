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

 
 
         function poner_colores(div,color,bkg_color)
         {
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
        enlace='<a href="#" onclick="preparar(\'#hdr_menu\',\''+categorias[ix-1].link +'\',\'#id_hdr\',\''+categorias[ix-1].nombre+'\');">'+categorias[ix-1].nombre+'</a>';
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
         let enlace; 
         let id;
         let tecno='1';
         let pos='1';
         let id_s;
         let n=0;
         let idx;
         
         tecno=document.getElementById("id_cat").innerText;
         pos=document.getElementById("orden").innerText;
          
         for(i=0;i<secciones.length;i++){ 
         idx="S"+(i+1);
         document.getElementById(idx).style.visibility='hidden';
          if(secciones[i].id_tecnologia==tecno){

            id="S"+(n+1);
           
            enlace='<div onclick="cargar(\'#Contenido\',\''+secciones[i].enlace +'?str_b='+tecno+'\');">'+secciones[i].nombre+'</div>';
           
            //$(id).text(secciones[i].nombre);
            //document.getElementById(id).innerHTML=secciones[i].nombre;
            if(tecno!='0')
                document.getElementById(id).innerHTML=enlace;
            else
                document.getElementById(id).innerHTML=secciones[i].nombre;

                id_s="#"+id;
            document.getElementById(id).style.visibility='visible';    
            if(tecno!='0')
              poner_colores(id_s,categorias[pos-1].color,categorias[pos-1].bkg_color);
            else
              poner_colores(id_s,raiz[0].color,raiz[0].bkg_color);
            n++;
            }
         
            }
        
        
        } 
     
         function toggleVis(div,visi) {
             const elemento = document.getElementById(div);
             elemento.style.visibility = visi;
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
           
           enlace='<div onclick="cargar_cms(\'#hdr_menu\',\''+secciones[i].enlace_cms +'\',\'#id_hdr\',\''+secciones[i].nombre+'\');">'+secciones[i].nombre+'</div>';
           document.getElementById(idx).innerHTML=enlace;
  
                         
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
           let enlace=''; 
                       
           for(i=0;i<tecnos.length;i++)
              enlace=enlace+tecnos[i].ID_tecnologia +'-'+tecnos[i].nombre+' | ';

           document.getElementById('hdr_tecs').innerHTML=enlace;
  
          
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
                document.getElementById('DataErrorr').textContent += 'El número de teléfono debe tener 10 dígitos.';
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
                alert('Formulario enviado exitosamente.');
                // Aquí es donde normalmente se enviaría el formulario a un servidor
                // Ejemplo: this.submit();
            }
        });
      }