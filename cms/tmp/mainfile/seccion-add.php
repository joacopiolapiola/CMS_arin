<?php require_once "mainfile/header.php"; ?>

<form name="frmAdd" method="post" action="" id="frmAdd"
    onSubmit="return validate();">
    <div id="mail-status"></div>
    <div>
        <label style="padding-top: 20px;">Nombre</label> <span
            id="nombre-info" class="info"></span> <input type="text"
            name="nombre" id="nombre" class="demoInputBox">
    </div>
    <div>
        <label>Orden</label> <span id="orden-info"
            class="info"></span> <input type="text"
            name="orden" id="orden" class="demoInputBox">
    </div>
    <div>
        <label>Id. Tecnologia</label> <span id="id_tec-info" class="info"></span>
        <input type=ext" name="id_tecnologia" id="id_tecnologia" class="demoInputBox">
    </div>
    <div>
        <label>Enlace</label> <span id="enlace-info" class="info"></span>
        <input type="text" name="enlace" id="enlace" class="demoInputBox">
    </div>
    <div>
    <div>
        <label>Activo</label> <span id="activo-info" class="info"></span>
        <input type="text" name="activo" id="activo" class="demoInputBox">
    </div>
        <input type="submit" name="add" id="btnSubmit" value="Agregar" />
    </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"
    type="text/javascript"></script>
<script>
function validate() {
    var valid = true;   
    $(".demoInputBox").css('background-color','');
    $(".info").html('');
    
    if(!$("#nombre").val()) {
        $("#nombre-info").html("(required)");
        $("#nombre").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#orden").val()) {
        $("#orden-info").html("(required)");
        $("#orden").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#id_tecnologia").val()) {
        $("#id_tec-info").html("(required)");
        $("#id_tecnologia").css('background-color','#FFFFDF');
        valid = false;
    }
       
    return valid;
}
</script>
</body>
</html>