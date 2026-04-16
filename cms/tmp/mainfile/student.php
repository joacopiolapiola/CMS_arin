<?php require_once "mainfile/header.php"; ?>
    <div style="text-align: right; margin: 20px 0px 10px;">
        <a id="btnAddAction" href="index.php?action=student-add"><img src="mainfile/image/icon-add.png" />Agregar Estudiante</a>
    </div>
    <div id="toys-grid">
        <table cellpadding="10" cellspacing="1">
            <thead>
                <tr>
                    <th><strong>Nombre Estudiante</strong></th>
                    <th><strong>Numero Rol</strong></th>
                    <th><strong>F. Nacimiento</strong></th>
                    <th><strong>Clase</strong></th>
                    <th><strong>Accion</strong></th>

                </tr>
            </thead>
            <tbody>
                    <?php
                    if (! empty($result)) {
                        foreach ($result as $k => $v) {
                            ?>
          <tr>
                    <td><?php echo $result[$k]["nombres"]; ?></td>
                    <td><?php echo $result[$k]["rol_numero"]; ?></td>
                    <td><?php echo $result[$k]["fecha_estudiante"]; ?></td>
                    <td><?php echo $result[$k]["clase"]; ?></td>
                    <td><a class="btnEditAction"
                        href="index.php?action=student-edit&id=<?php echo $result[$k]["id"]; ?>">
                        <img src="mainfile/image/icon-edit.png" />
                        </a>
                        <a onclick="return confirm('Confirma Eliminar Registro?');" class="btnDeleteAction" 
                        href="index.php?action=student-delete&id=<?php echo $result[$k]["id"]; ?>">
                        <img src="mainfile/image/icon-delete.png" />
                        </a>
                    </td>
                </tr>
                    <?php
                        }
                    }
                    ?>
                
            
            
            <tbody>
        
        </table>
    </div>
</body>
</html>