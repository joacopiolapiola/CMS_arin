<?php require_once "mainfile/header.php"; ?>
    <div style="text-align: right; margin: 20px 0px 10px;">
        <a id="btnAddAction" href="index.php?action=seccion-add"><img src="mainfile/image/icon-add.png" />Agregar Seccion</a>
    </div>
    <div id="toys-grid">
        <table cellpadding="10" cellspacing="1">
            <thead>
                <tr>
                    <th><strong>Nombre Seccion</strong></th>
                    <th><strong>Id Tecnologia</strong></th>
                    <th><strong>Orden</strong></th>
                    <th><strong>Enlace</strong></th>
                    <th><strong>Activo</strong></th>

                </tr>
            </thead>
            <tbody>
                    <?php
                    if (! empty($result)) {
                        foreach ($result as $k => $v) {
                            ?>
          <tr>
                    <td><?php echo $result[$k]["nombre"]; ?></td>
                    <td><?php echo $result[$k]["id_tecnologia"]; ?></td>
                    <td><?php echo $result[$k]["orden"]; ?></td>
                    <td><?php echo $result[$k]["enlace"]; ?></td>
                    <td><?php echo $result[$k]["Activo"]; ?></td>
                    <td><a class="btnEditAction"
                        href="index.php?action=seccion-edit&id=<?php echo $result[$k]["id_seccion"]; ?>">
                        <img src="mainfile/image/icon-edit.png" />
                        </a>
                        <a onclick="return confirm('Confirma Eliminar Registro?');" class="btnDeleteAction" 
                        href="index.php?action=seccion-delete&id=<?php echo $result[$k]["id_seccion"]; ?>">
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