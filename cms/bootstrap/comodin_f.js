$(document).ready(function(){
    var consulta;
    //hacemos focus al campo de búsqueda
    console.log(document.getElementById('Contenido'));
    console.log(document.getElementById('btn_b_comodin'));
    console.log(document.getElementById('txt_b_comodin'));
    $("#txt_b_comodin").focus();

      
      $("#btn_b_comodin").click(function(e){
                                  
          //obtenemos el texto introducido en el campo de búsqueda
          consulta = $("#txt_b_comodin").val();
          //alert (consulta);
          //hace la búsqueda                                                                                  
          $.ajax({
                type: "POST",
                url: "comodin_busqueda_cms.php",
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
    $("#txt_b_comodin").keyup(function(e){
      if (e.which != 13
                    )return;           
          //obtenemos el texto introducido en el campo de búsqueda
          consulta = $("#txt_b_comodin").val();
          //hace la búsqueda                                                                                  
          $.ajax({
                type: "POST",
                url: "comodin_busqueda_cms.php",
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
    url: "comodin_edit.php",
    data: {operacion: 'edicion', id_comodin: id}
}).done(function (html) {
    $('#Contenido').html(html);
});
}

function borrar(id) {
//alert('BORRAR '+id);
    
$.ajax({
    type: "POST",
    url: "comodin_edit.php",
    data: {operacion: 'baja', id_comodin: id}
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

function PonerCodigoTec() {
    // Obtén el elemento <select> y la opción seleccionada
    const select = document.getElementById("nombre");
    const selectedOption = select.options[select.selectedIndex];

    // Obtén el código del atributo data-codigo y asignarlo al campo de código
    const codigo = selectedOption.getAttribute("data-codigo");
    document.getElementById("txtId_tecnologia").value = codigo ? codigo : "";
}