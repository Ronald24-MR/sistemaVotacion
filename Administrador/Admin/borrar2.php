<?php
$codigo = $_POST['codigo'];

$sql = "DELETE FROM `registrar_votaciones` WHERE `registrar_votaciones`.`numero_documento` = $codigo";

if(include("../../conectar.php")){
    if(mysqli_query($conectar,$sql)){
        
        header("Location: reporteCandidatos.php?eliminado=1");
    }
    else{
        print("<script>Swal.fire('Error al eliminar registro')</script>");
    }
}

?>