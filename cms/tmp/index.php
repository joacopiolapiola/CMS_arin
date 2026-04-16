<?php
//require_once "clases/DBController.php";
require_once "clases/Student.php";
require_once "../clases/secciones.php";

$db_handle = new DBController();

// $action = "";
if (!empty($_GET["action"])) {
    $action = $_GET["action"];
}else{$action = "peru";
}
switch ($action) {

    case "seccion-add":
        if (isset($_POST['add'])) {
            $nombre = $_POST['nombre'];
            $orden = $_POST['orden'];
            $id_tecnologia = $_POST['id_tecnologia'];
            $enlace = $_POST['enlace'];
            $activo = $_POST['activo'];

            $seccion = new Seccion();
            $seccion->$nombre=$nombre;
            $seccion->$orden=$orden;
            $seccion->$id_tecnologia=$id_tecnologia;
            $seccion->$enlace=$enlace;
            $seccion->$activo=$activo;

            $seccion->guardar();
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problema al agregar un nuevo registro",
                    "type" => "error"
                );
            } else {
                header("Location: index.php");
            }
        }
        require_once "mainfile/seccion-add.php";
        break;

        case "seccion-edit":
            $seccion_id = $_GET["id"];
            $seccion = new Seccion();
            
            if (isset($_POST['add'])) {
                $seccion = new Seccion();
                $seccion->$nombre = $_POST['nombre'];
                $seccion->$orden = $_POST['orden'];
                $seccion->$id_tecnologia = $_POST['id_tecnologia'];
                $seccion->$enlace = $_POST['enlace'];
                $seccion->$activo = $_POST['activo'];
                
                //$seccion->actualizar($seccion_id);
                
                header("Location: index.php");
            }
            
            //$result = $student->getStudentById($student_id);
            $result = $seccion->traer_datos($seccion_id);
            require_once "mainfile/seccion-edit.php";
            break;    
            case "seccion-delete":
                $seccion_id = $_GET["id"];
                $seccion = new Seccion();
                
                $seccion->borrar($seccion_id);
                
                $result = $seccion->listar();
                require_once "mainfile/seccion.php";
                break;
            case "seccion":
                $seccion = new Seccion();
                $result = $seccion->listar();
                require_once "mainfile/seccion.php";
                break;

    case "student-add":
        if (isset($_POST['add'])) {
            $name = $_POST['name'];
            $roll_number = $_POST['roll_number'];
            $dob = "";
            if ($_POST["dob"]) {
                $dob_timestamp = strtotime($_POST["dob"]);
                $dob = date("Y-m-d", $dob_timestamp);
            }
            $class = $_POST['class'];
            
            $student = new Student();
            $insertId = $student->addStudent($name, $roll_number, $dob, $class);
            if (empty($insertId)) {
                $response = array(
                    "message" => "Problema al agregar un nuevo registro",
                    "type" => "error"
                );
            } else {
                header("Location: index.php");
            }
        }
        require_once "mainfile/student-add.php";
        break;
    
    case "student-edit":
        $student_id = $_GET["id"];
        $student = new Student();
        
        if (isset($_POST['add'])) {
            $name = $_POST['name'];
            $roll_number = $_POST['roll_number'];
            $dob = "";
            if ($_POST["dob"]) {
                $dob_timestamp = strtotime($_POST["dob"]);
                $dob = date("Y-m-d", $dob_timestamp);
            }
            $class = $_POST['class'];
            
            $student->editStudent($name, $roll_number, $dob, $class, $student_id);
            
            header("Location: index.php");
        }
        
        $result = $student->getStudentById($student_id);
        require_once "mainfile/student-edit.php";
        break;
    
    case "student-delete":
        $student_id = $_GET["id"];
        $student = new Student();
        
        $student->deleteStudent($student_id);
        
        $result = $student->getAllStudent();
        require_once "mainfile/student.php";
        break;
    case "student":
        $student = new Student();
        $result = $student->getAllStudent();
        require_once "mainfile/student.php";
        break;
    default:
        $student = new Student();
        $result = $student->getAllStudent();
        require_once "mainfile/student.php";
        break;
}
