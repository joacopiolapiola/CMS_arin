  let categorias = [         ];
  let secciones = [         ];
  //let miscs = [];
  let raiz = [];
  let i_slider=-1;
  //let Max_miscs=0;

 
        function poner_logo(div,imagen){
          //const myImage = new Image(100, 100);
          //var myImage = document.createElement("img");
          //myImage.src = "images/"+imagen;
          //myImage.alt='';
          //$(div).attr("src",myImage.src);
          //document.getElementById(div).appendChild  =myImage.src;
          const url="images/"+imagen;
          const div_l = document.getElementById(div);
          if(imagen!=''){
            
            div_l.innerHTML = `<img src="${url}" alt="Imagen" style="width:80px; height:80px;">`;
          }
          else{
            div_l.innerHTML = ``;
          }
        }


        function poner_imagen(div,imagen)
        {
        alert(imagen);
        $(div).attr("src",imagen); 
        } 


         function poner_colores(div,color,bkg_color)
         {
           $(div).css('color', color);
           $(div).css('background-color',bkg_color);
         }

       function cargar(div,desde)
        {
        $(div).load(desde);
        } 
 
        function poner_nombre(div,nombre)
        {
        $(div).text(nombre);
        } 
  
        function saludar(){
          
        }
     
        function poner_menu(div,nombre)
        {
        let ix=div.slice(1);
        $(div).text(nombre);
        //$(div).attr.bk_color(categorias[ix-1].bk_color);
        //document.getElementById(div).style.backgroundColor =categorias[ix-1].bk_color;
     
        } 
     
        function poner_cat(div)
        {
        let ix=div.slice(1);
        
        let nombre=document.getElementById(div).innerHTML;
        document.getElementById("hdr_cat").innerHTML='<H4>'+categorias[ix-1].nombre+'</H4>';
        document.getElementById("abreviatura").innerHTML='<H4>'+categorias[ix-1].abreviatura+'</H4>';
        document.getElementById("resumen").innerHTML='<H5>'+categorias[ix-1].resumen+'</H5>';
        document.getElementById("id_cat").innerHTML=categorias[ix-1].ID_tecnologia;
        document.getElementById("orden").innerHTML=categorias[ix-1].orden;
        poner_colores("#hdr_cat",categorias[ix-1].color,categorias[ix-1].bkg_color);
        poner_colores("#abreviatura",categorias[ix-1].color,categorias[ix-1].bkg_color);
        poner_colores("#resumen",categorias[ix-1].color,categorias[ix-1].bkg_color);
        //document.getElementById("Hdr_Contenido").innerHTML='<H4>'+categorias[ix-1].nombre+'</H4>';
        document.getElementById("Contenido").innerHTML='<H4>'+categorias[ix-1].nombre+'</H4>'+'<H5>'+categorias[ix-1].definicion+'</H5>';
        poner_logo("logo",categorias[ix-1].logo);
        poner_secciones();
        } 
     
        function poner_p40()
        {
          document.body.style.fontFamily = raiz['fuente'];
          document.body.style.Color=raiz['color_gral'];
          document.body.style.backgroundColor=raiz['bkg_color_gral'];
          document.getElementById("usuario").backgroundColor=raiz['bkg_color_gral'];
 
          document.getElementById("hdr_cat").innerHTML='<H3>'+raiz['nombre']+'</H3>';
           document.getElementById("hdr_sitio").innerHTML='<H2>'+raiz['nombre_sitio']+'</H2>';
           document.getElementById("hdr_institucion").innerHTML='<H5>'+raiz['nombre_institucion']+'</H5>';
           document.getElementById("abreviatura").innerHTML='<H4>'+raiz['abreviatura']+'</H4>';
           document.getElementById("resumen").innerHTML='<H5>'+raiz['resumen']+'</H5>';
           document.getElementById("id_cat").innerHTML=0;
           poner_colores("#hdr_cat",raiz['color'],raiz['bkg_color']);
           poner_colores("#abreviatura",raiz['color'],raiz['bkg_color']);
           poner_colores("#resumen",raiz['color'],raiz['bkg_color']);
           document.getElementById("Contenido").innerHTML='<H4>'+raiz['nombre']+'</H4>'+'<H5>'+raiz['definicion']+'</H5>';
           poner_logo("logo",raiz['logo']);
           poner_secciones();
           i_slider=-1;
           cargar('#Contenido','fondo.php');
           //poner_miscelaneas();
      
        } 
        /*
        function slideNext(){
          let enlace="";
          if(i_slider < (Max_miscs-1))
            i_slider++;
          enlace=miscs[i_slider].link_local+'?str_b='+miscs[i_slider].ID_misc;
          //alert(enlace);
          cargar("#Contenido",enlace);
          

        }
        function slidePrev(){
          let enlace="";
          if (i_slider > 0)
            i_slider--;
          enlace=miscs[i_slider].link_local+'?str_b='+miscs[i_slider].ID_misc;
          cargar("#Contenido",enlace);
          
        }
        
        function poner_miscelaneas()
          
        {
          let idx,i;
          let enlace;
          let id_tecno='1';

          for(i=0;i<miscs.length;i++){ 
            idx=miscs[i].pos_FC+"";
            id_tecno=miscs[i].ID_misc;
            
            //document.getElementById(idx).innerHTML=miscs[i].nombre;
            //enlace='<a href="'+miscs[i].link_local +'?str_b='+miscs[i].ID_misc+'"  target="_blank">'+miscs[i].nombre+'</a>';
            enlace='<a href="#" onclick="cargar(\'#Contenido\',\''+miscs[i].link_local +'?str_b='+id_tecno+'\');">'+miscs[i].nombre+'</a>';
            //poner_nombre(idx,enlace);
            //alert(enlace);
            document.getElementById(idx).innerHTML=enlace;
            //alert(idx+" - "+miscs[i].nombre)
          }
        }
       */
        function poner_raiz()
          
        {
          
            document.getElementById('RAIZ').innerHTML=raiz['definicion'];
           
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
           if(secciones[i].enlace!="comodin.php")
             enlace='<div onclick="cargar(\'#Contenido\',\''+secciones[i].enlace +'?str_b='+tecno+'\');">'+secciones[i].nombre+'</div>';
           if(secciones[i].enlace=="comodin.php")
             enlace='<div onclick="cargar(\'#Contenido\',\''+secciones[i].enlace +'?str_b='+tecno+'&str_secc='+secciones[i].nombre+'\');">'+secciones[i].nombre+'</div>';
           
            //$(id).text(secciones[i].nombre);
            //document.getElementById(id).innerHTML=secciones[i].nombre;
            //if(tecno!='0')
            //    document.getElementById(id).innerHTML=enlace;
            //else
                document.getElementById(id).innerHTML=enlace;
                //document.getElementById(id).innerHTML=secciones[i].nombre;

            id_s="#"+id;
            document.getElementById(id).style.visibility='visible';    
            if(tecno!='0')
              poner_colores(id_s,categorias[pos-1].color,categorias[pos-1].bkg_color);
            else
              poner_colores(id_s,raiz['color'],raiz['bkg_color']);
            n++;
            }
         
            }
        
        
        } 
     
         function toggleVis(div) {
             const elemento = document.getElementById(div);
             if (elemento.style.visibility === 'hidden') {
                 elemento.style.visibility = 'visible';
             } else {
                 elemento.style.visibility = 'hidden';
             }
         }

         function poner_username(nombre,rol)
          
        {
          
            document.getElementById('usuario').innerHTML=nombre;
            document.getElementById('rol_user').innerHTML=rol;
            document.getElementById('entrar').innerHTML='<a href="#" onclick="cargar(\'#Contenido\',\'logout.html\')">Salir</a>';
           
        }
    
     function poner_opcion_logout()
     {
      document.getElementById('entrar').innerHTML='<a href="#" onclick="cargar("#Contenido","logout.html")">Salir</a>';
     }

     function poner_opcion_login()
     {
      document.getElementById('entrar').innerHTML='<a href="#" onclick="cargar(\'#Contenido\',\'login.html\')">Ingreso</a>';
      document.getElementById('rol_user').innerHTML='';
      document.getElementById('usuario').innerHTML='';
    }

     function poner_opcion_cms()
     {
      document.getElementById('cms_in').innerHTML='<a href="./cms/cms_p40.php" target="_blank">Cms</a>';
     }

     function sacar_opcion_cms()
     {
      document.getElementById('cms_in').innerHTML='';
     }



