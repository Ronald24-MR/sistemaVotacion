<?php

include("../../conectar.php");


$nd=$_POST['nd'];
$td=$_POST['td'];
$nombres=$_POST['nombres'];
$apellidos=$_POST['apellidos'];
$formacion=$_POST['formacion'];
$sede=$_POST['sede'];

$sql="UPDATE `gestionar_votantes` SET `numero_documento`=$nd,`cod_tipo_documento`=$td,`nombres`='$nombres',`apellidos`='$apellidos',`cod_formacion`='$formacion',`cod_sede`='$sede' WHERE numero_documento = $nd";
// print($sql);
$sql2="UPDATE `usuario` SET `nombre_apellido`='$nombres $apellidos' WHERE usuario=$nd";
$query=mysqli_query($conectar,$sql);
$query2=mysqli_query($conectar,$sql2);



        
        Header("Location: reporteVotantes.php?actualizado=1");

           
        
    
?>