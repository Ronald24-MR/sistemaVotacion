<?php
$codigo = $_POST['codigo'];

$sql = "DELETE FROM `gestionar_votantes` WHERE `gestionar_votantes`.`numero_documento` = $codigo";

if(include("../../conectar.php")){
    if(mysqli_query($conectar,$sql)){
        
        header("Location: reporteVotantes.php?eliminado=1");
    }
    else{
        print("<script>Swal.fire('Error al eliminar registro')</script>");
    }
}



?>

