<?php

include("../../conectar.php");

        $td=$_POST['td'];
        $nd=$_POST['nd'];
        $nombres=$_POST['nombres'];
        $apellidos=$_POST['apellidos'];
        $formacion=$_POST['formacion'];
        $sede=$_POST['sede'];
        $nombrefoto=$_FILES['fotografia']['name'];
        $tipofile=$_FILES['fotografia']['type'];
        $pc=$_POST['pc'];
        $encriptar = password_hash($nd, PASSWORD_DEFAULT,['cost' => 15]);
        
        $sql="UPDATE `registrar_votaciones` SET `numero_documento`=$nd,`cod_tipo_documento`=$td,`nombres`='$nombres',`apellidos`='$apellidos',`cod_formacion`='$formacion',`cod_sede`='$sede',`fotografia`='$nombrefoto',`propuesta_campana`='$pc' WHERE numero_documento=$nd ";
    
        $query=mysqli_query($conectar,$sql);


        if(!(strpos($tipofile,"jpg") || strpos($tipofile,"png") || strpos($tipofile,"jpeg")))
        {
            print("<script>Swal.fire('Tipo de archivo no valido')</script>");
        }
        else
        {
            if(include('../../conectar.php'))
            {
                if(mysqli_query($conectar,$sql))
                {
                    
                    $ruta="fotos/".$nombrefoto;
                    $sql="insert into usuario value($nd,'$encriptar','$nombres $apellidos',2,0)";
                    mysqli_query($conectar,$sql);
                    if (move_uploaded_file($_FILES['fotografia']['tmp_name'],$ruta))
                    {
                        Header("Location: reporteCandidatos.php?actualizado=1");
                    }
                    else
                    {
                        print("<script>Swal.fire('Ocurrio algun error al subir el fichero. No pudo guardarse.')</script>");
                    }
                }
                else
                {
                    print("<script>Swal.fire('Error al guardar los datos')</script>");
                }
            }
        else
        {
            print("error al conectar");
        }
        }
           
        
    
?>