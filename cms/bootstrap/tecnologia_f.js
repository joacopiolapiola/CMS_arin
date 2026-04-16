$(document).ready(function(){
    var consulta;
    //hacemos focus al campo de búsqueda
    console.log(document.getElementById('Contenido'));
    console.log(document.getElementById('btn_b_tecnologia'));
    console.log(document.getElementById('txt_b_tecnologia'));
    $("#txt_b_tecnologia").focus();

      
      $("#btn_b_tecnologia").click(function(e){
                                  
          //obtenemos el texto introducido en el campo de búsqueda
          consulta = $("#txt_b_tecnologia").val();
          //alert (consulta);
          //hace la búsqueda                                                                                  
          $.ajax({
                type: "POST",
                url: "tecnologias_busqueda_cms.php",
                data: "b="+consulta,
                dataType: "html",
                beforeSend: function(){
                //imagen de carga
                $("#Contenido").html("<p align='center'><img src='images/ajax-loader.gif' /></p>");
                },
                error: function(){
                alert("error petición ajax");
                },
                success: function(data){                                                    
                $("#Contenido").empty();
                $("#Contenido").append(data);                                                             
                }
          });                                                                         
    });                                                     

    
    //comprobamos si se pulsa una tecla
    $("#txt_b_tecnologia").keyup(function(e){
      if (e.which != 13
                    )return;           
          //obtenemos el texto introducido en el campo de búsqueda
          consulta = $("#txt_b_tecnologia").val();
          //hace la búsqueda                                                                                  
          $.ajax({
                type: "POST",
                url: "tecnologias_busqueda_cms.php",
                data: "b="+consulta,
                dataType: "html",
                beforeSend: function(){
                //imagen de carga
                $("#Contenido").html("<p align='center'><img src='images/ajax-loader.gif' /></p>");
                },
                error: function(){
                alert("error petición ajax");
                },
                success: function(data){                                                    
                $("#Contenido").empty();
                $("#Contenido").append(data);                                                             
                }
          });                                                                         
    });                                                     

    
      
    });             


function poner_nombre(){
var opt=$("#sel_nombre option:selected").text();
//alert (opt);
$("#tit_nombre").val(opt);        
}  

function editar(id) {
//alert('EDITAR '+id);
    
$.ajax({
    type: "POST",
    url: "tecnologia_edit.php",
    data: {operacion: 'edicion', id_tecnologia: id}
}).done(function (html) {
    $('#Contenido').html(html);
});
}

function borrar(id) {
//alert('BORRAR '+id);
    
$.ajax({
    type: "POST",
    url: "tecnologia_edit.php",
    data: {operacion: 'baja', id_tecnologia: id}
}).done(function (html) {
    $('#Contenido').html(html);
});
}

function no_grabar(id) {
//alert('GRABAR '+id);
    
$.ajax({
    type: "POST",
    url: "edit_p.php",
    data: {operacion: 'actualizar', id_pers: id}
}).done(function (html) {
    $('#Contenido').html(html);
}).false(function () {
    alert('Error al cargar modulo');
});
}

function PonerColor() {
    const colorPicker = document.getElementById("color");
    const colorSeleccionado =colorPicker.value;
    document.getElementById("txtColor").value=colorSeleccionado;
    }

    function PonerBkgColor() {
        const colorPicker = document.getElementById("bkgcolor");
        const colorSeleccionado =colorPicker.value;
        document.getElementById("txtBkgColor").value=colorSeleccionado;
        }