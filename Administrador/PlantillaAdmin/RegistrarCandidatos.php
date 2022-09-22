<?php include("menu.php") ?>

<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link rel="stylesheet" href="css/styleCandidatos.css">

<div class="container contenedor">
<form action="RegistrarCandidatos.php" method="post" enctype="multipart/form-data">
        <h2>Registro de candidatos</h2>
        <div class="row">
            <div class="col">
                <select name="td" id="td" class="form-control" required>
                    <option value="0" disabled selected hidden >Tipo de documento</option>
                    <?php
                        if(include('../../conectar.php'))
                        {
                            $sql="select * from tipo_documento";
                            $tabla=mysqli_query($conectar,$sql);
                            while($fila=mysqli_fetch_array($tabla))
                            {
                                print("<option value='$fila[0]'>");
                                print($fila[1]);
                                print("</option>");
                            }
                        }
                        else
                        {
                            print("error al conectarse a la base de datos");
                        }
                    ?>
                </select>
            </div>
            <div class="col">
                <input type="number" class="form-control" name="nd" id="nd" placeholder="Numero de documento" required>
            </div>
            <div class="col">
                <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Nombres" required>
            </div >
        </div>

        <div class="row">
            <div class="col">
                <input type="text" class="form-control" name="apellidos" id placeholder="Apellidos" required>
            </div>
            <div class="col">
                <select name="formacion" id="formacion" class="form-control" required>
                    <option value="0" disabled selected hidden>Formacion</option>
                    <?php
                        if(include('../../conectar.php'))
                        {
                            $sql="select * from formacion";
                            $tabla=mysqli_query($conectar,$sql);
                            while($fila=mysqli_fetch_array($tabla))
                            {
                                print("<option value='$fila[0]'>");
                                print($fila[1]);
                                print("</option>");
                            }
                        }
                        else
                        {
                            print("error al conectarse a la base de datos");
                        }
                    ?>
                </select>
            </div>
            <div class="col">
                <select name="sede" id="sede" class="form-control" required>
                    <option value="0" disabled selected hidden>Sede</option>
                    <?php
                        if(include('../../conectar.php'))
                        {
                            $sql="select * from sede";
                            $tabla=mysqli_query($conectar,$sql);
                            while($fila=mysqli_fetch_array($tabla))
                            {
                                print("<option value='$fila[0]'>");
                                print($fila[1]);
                                print("</option>");
                            }
                        }
                        else
                        {
                            print("error al conectarse a la base de datos");
                        }
                    ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <input type="file" class="form-control" name="fotografia" placeholder="fotografia" required>
            </div>
            
            
        </div>

        <div class="row">
        <div class="col">
                <textarea name="pc" id="pc" cols="40" rows="5" placeholder="Escriba propuesta (maximo 300 caracteres)" class="form-control" required></textarea>
            </div>
        </div>
        <div class="row">
                
                    <br>
                <div class="col button"><button class="btn btn-primary" type="submit" name="boton" style="background-color: #212529; border:none;">Guardar</button></div>
         
            </div>
   
    </form>
    </div>
   
    <?php
    if(isset($_POST['boton']))
    {
        $td=$_POST['td'];
        $nd=$_POST['nd'];
        $nombres=$_POST['nombres'];
        $apellidos=$_POST['apellidos'];
        $formacion=$_POST['formacion'];
        $sede=$_POST['sede'];
        $nombrefoto=$_FILES['fotografia']['name'];
        $tipofile=$_FILES['fotografia']['type'];
        $pc=$_POST['pc'];
        
        $sql="insert into registrar_votaciones value($nd, $td, '$nombres', '$apellidos', $formacion, $sede,0,'$nombrefoto', '$pc', '$nd')";

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
                    $sql="insert into usuario value($nd,'$nd','$nombres $apellidos',2,0)";
                    mysqli_query($conectar,$sql);
                    if (move_uploaded_file($_FILES['fotografia']['tmp_name'],$ruta))
                    {
                        print("<script>Swal.fire('Registro guardado correctamente')</script>");
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
    }
?>