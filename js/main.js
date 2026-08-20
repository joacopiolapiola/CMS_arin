  let categorias = [         ];
  let secciones = [         ];
  //let miscs = [];
  let raiz = [];
  let i_slider=-1;
  //let Max_miscs=0;

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
      const value = text === undefined || text === null || text === 'undefined' || text === 'null' ? '' : String(text);
      el.textContent = value;
    }
  }

  function safeValue(obj, keys, fallback = '') {
    if (!obj || typeof obj !== 'object') {
      return fallback;
    }

    for (const key of keys) {
      const value = obj[key] ?? obj[key.toLowerCase()] ?? obj[key.toUpperCase()];
      if (value !== undefined && value !== null && value !== 'undefined' && value !== 'null' && value !== '') {
        return value;
      }
    }

    return fallback;
  }

  function safeGetText(id, fallback = '0') {
    const el = getEl(id);
    if (!el) return fallback;
    const value = (el.innerText ?? el.textContent ?? '').trim();
    return value === '' ? fallback : value;
  }

 
        function poner_logo(div,imagen){
          const div_l = document.getElementById(div);
          if (!div_l) {
            return;
          }

          const valor = (typeof imagen === 'string') ? imagen.trim() : '';
          if (valor === '' || valor === 'undefined' || valor === 'null') {
            div_l.innerHTML = '';
            return;
          }

          const url = /^(https?:)?\/\//i.test(valor) ? valor : 'images/' + valor;
          const img = new Image();
          img.alt = 'Logo';
          img.style.width = '80px';
          img.style.height = '80px';
          img.style.objectFit = 'contain';
          img.onload = function () {
            div_l.innerHTML = '';
            div_l.appendChild(img);
          };
          img.onerror = function () {
            div_l.innerHTML = '';
          };
          img.src = url;
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
        $(div).load(desde, function () {
          sincronizarSesion();
        });
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
        if (!div) return;
        const item = getEl(div);
        if (!item) return;
        let ix = Number(String(div).replace(/^M/, ''));
        if (!Number.isFinite(ix) || ix < 1 || !categorias[ix - 1]) return;

        const categoria = categorias[ix - 1] || {};
        const nombre = safeValue(categoria, ['nombre'], '');
        const abreviatura = safeValue(categoria, ['abreviatura'], '');
        const resumen = safeValue(categoria, ['resumen'], '');
        const definicion = safeValue(categoria, ['definicion'], '');
        const color = safeValue(categoria, ['color'], '');
        const bkgColor = safeValue(categoria, ['bkg_color'], '');
        const logo = safeValue(categoria, ['logo'], '');
        const idTecnologia = safeValue(categoria, ['id_tecnologia', 'ID_tecnologia', 'id'], 0);

        safeSetHtml("hdr_cat", '<H4>' + nombre + '</H4>');
        safeSetHtml("abreviatura", '<H4>' + abreviatura + '</H4>');
        safeSetHtml("resumen", '<H5>' + resumen + '</H5>');
        safeSetText("id_cat", idTecnologia || 0);
        safeSetText("orden", safeValue(categoria, ['orden'], 0));
        poner_colores("#hdr_cat", color, bkgColor);
        poner_colores("#abreviatura", color, bkgColor);
        poner_colores("#resumen", color, bkgColor);
        safeSetHtml("Contenido", '<H4>' + nombre + '</H4>' + '<H5>' + definicion + '</H5>');
        poner_logo("logo", logo);
        poner_secciones();
        } 
     
        function poner_p40()
        {
          const raizData = Array.isArray(raiz) ? (raiz[0] || {}) : (raiz || {});
          const nombreRaiz = safeValue(raizData, ['nombre'], 'Plataforma');
          const nombreSitio = safeValue(raizData, ['nombre_sitio'], 'Plataforma 4.0');
          const nombreInstitucion = safeValue(raizData, ['nombre_institucion'], '');
          const abreviatura = safeValue(raizData, ['abreviatura'], '');
          const resumen = safeValue(raizData, ['resumen'], '');
          const definicion = safeValue(raizData, ['definicion'], '');
          const logo = safeValue(raizData, ['logo'], '');
          const fuente = safeValue(raizData, ['fuente'], '');
          const colorGral = safeValue(raizData, ['color_gral'], '');
          const bkgGral = safeValue(raizData, ['bkg_color_gral'], '');
          const color = safeValue(raizData, ['color'], '');
          const bkgColor = safeValue(raizData, ['bkg_color'], '');

          document.body.style.fontFamily = fuente;
          document.body.style.color = colorGral;
          document.body.style.backgroundColor = bkgGral;
          const usuarioEl = getEl("usuario");
          if (usuarioEl) {
            usuarioEl.style.backgroundColor = bkgGral;
          }

          safeSetHtml("hdr_cat", '<H3>' + nombreRaiz + '</H3>');
          const hdrSitio = getEl("hdr_sitio");
          if (hdrSitio) hdrSitio.innerHTML = '<H2>' + nombreSitio + '</H2>';
          const hdrInstitucion = getEl("hdr_institucion");
          if (hdrInstitucion) hdrInstitucion.innerHTML = '<H5>' + nombreInstitucion + '</H5>';
          safeSetHtml("abreviatura", '<H4>' + abreviatura + '</H4>');
          safeSetHtml("resumen", '<H5>' + resumen + '</H5>');
          safeSetText("id_cat", 0);
          poner_colores("#hdr_cat", color, bkgColor);
          poner_colores("#abreviatura", color, bkgColor);
          poner_colores("#resumen", color, bkgColor);
          safeSetHtml("Contenido", '<H4>' + nombreRaiz + '</H4>' + '<H5>' + definicion + '</H5>');
          poner_logo("logo", logo);
          poner_secciones();
          i_slider=-1;
          const contenidoEl = getEl('Contenido');
          if (contenidoEl) {
            cargar('#Contenido','fondo.php');
          }
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
         const catEl = getEl("id_cat");
         const ordenEl = getEl("orden");
         if (!catEl || !ordenEl) {
           return;
         }

         let enlace; 
         let id;
         let tecno = (catEl.innerText ?? catEl.textContent ?? '').trim() || '1';
         let pos = (ordenEl.innerText ?? ordenEl.textContent ?? '').trim() || '1';
         let id_s;
         let n=0;
         let idx;
         
         for(i=0;i<secciones.length;i++){ 
         idx="S"+(i+1);
         const el = getEl(idx);
         if (el) {
           el.style.visibility='hidden';
         }
          if(secciones[i].id_tecnologia==tecno){

            id="S"+(n+1);
            const elId = getEl(id);
            if (!elId) continue;
           if(secciones[i].enlace!="comodin.php")
             enlace='<div onclick="cargar(\'#Contenido\',\''+secciones[i].enlace +'?str_b='+tecno+'\');">'+secciones[i].nombre+'</div>';
           if(secciones[i].enlace=="comodin.php")
             enlace='<div onclick="cargar(\'#Contenido\',\''+secciones[i].enlace +'?str_b='+tecno+'&str_secc='+secciones[i].nombre+'\');">'+secciones[i].nombre+'</div>';
           
            //$(id).text(secciones[i].nombre);
            //document.getElementById(id).innerHTML=secciones[i].nombre;
            //if(tecno!='0')
            //    document.getElementById(id).innerHTML=enlace;
            //else
                elId.innerHTML=enlace;
                //document.getElementById(id).innerHTML=secciones[i].nombre;

            id_s="#"+id;
            elId.style.visibility='visible';    
            if(tecno!='0') {
              const categoria = categorias[Number(pos)-1] || null;
              if (categoria) {
                poner_colores(id_s, categoria.color, categoria.bkg_color);
              }
            } else {
              poner_colores(id_s,raiz && raiz['color'] ? raiz['color'] : '',raiz && raiz['bkg_color'] ? raiz['bkg_color'] : '');
            }
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
          
             safeSetText('usuario', nombre || '');
             safeSetText('rol_user', rol || '');
             safeSetHtml('entrar', '<a href="session_out.php">Cerrar sesion</a>');
             const registro = getEl('registro');
             if (registro) registro.style.display = 'none';
           
        }

     function aplicarEstadoSesion(estado)
     {
      if (estado && estado.activa) {
       safeSetText('usuario', estado.nombre || '');
       safeSetText('rol_user', estado.rol || '');
       poner_opcion_logout();
       if (estado.puede_cms) {
        poner_opcion_cms();
       } else {
        sacar_opcion_cms();
       }
       return;
      }

      poner_opcion_login();
      sacar_opcion_cms();
     }

     function sincronizarSesion()
     {
      if (typeof window.fetch !== 'function') return;

      window.fetch('session_estado.php', {
       cache: 'no-store',
       credentials: 'same-origin'
      })
       .then(function (response) { return response.ok ? response.json() : { activa: false }; })
       .then(aplicarEstadoSesion)
       .catch(function () {});
     }
    
     function poner_opcion_logout()
     {
      safeSetHtml('entrar', '<a href="session_out.php">Cerrar sesion</a>');
      const registro = getEl('registro');
      if (registro) registro.style.display = 'none';
     }

     function poner_opcion_login()
     {
      safeSetHtml('entrar', '<a href="#" onclick="cargar(\'#Contenido\',\'login.html\')">Ingreso</a>');
      safeSetText('rol_user', '');
      safeSetText('usuario', '');
      const registro = getEl('registro');
      if (registro) registro.style.display = '';
    }

     function poner_opcion_cms()
     {
      safeSetHtml('cms_in', '<a href="./cms/cms_p40.php" target="_blank">Cms</a>');
     }

     function sacar_opcion_cms()
     {
      safeSetHtml('cms_in', '');
     }

     if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', sincronizarSesion);
     } else {
      sincronizarSesion();
     }



