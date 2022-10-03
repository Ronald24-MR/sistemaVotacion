<?php 
    include("../../conectar.php");
    

$id=$_GET['id'];

$sql="SELECT registrar_votaciones.numero_documento, tipo_documento.nombre, registrar_votaciones.nombres, registrar_votaciones.apellidos, formacion.nombre, sede.nombre, registrar_votaciones.fotografia, registrar_votaciones.propuesta_campana FROM tipo_documento,sede,formacion,registrar_votaciones WHERE registrar_votaciones.cod_tipo_documento=tipo_documento.codigo and registrar_votaciones.cod_formacion=formacion.codigo and registrar_votaciones.cod_sede=sede.codigo and registrar_votaciones.numero_documento=$id";
// print($sql);
$query=mysqli_query($conectar,$sql);

$row=mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar</title>
    <link rel="stylesheet" href="css/styleCandidatos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
<div class="container contenedor">
<form action="update2.php" method="post" enctype="multipart/form-data">
        <h2>Actualizar candidatos</h2>
        <div class="row">
            <div class="col">
                <select name="td" id="td" class="form-control" required>
        
                    <?php
                        if(include('../../conectar.php'))
                        {
                            $sql="select * from tipo_documento";
                            $tabla=mysqli_query($conectar,$sql);
                            while($fila=mysqli_fetch_array($tabla))
                            {
                                if($fila[0]==$row[1]){
                                    print("<option selected value='$fila[0]'>");
                                    print($fila[1]);
                                    print("</option>");
                                    }
                                    else{
                                    print("<option value='$fila[0]'>");
                                    print($fila[1]);
                                    print("</option>");
                                    }
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
                <input type="number" class="form-control" name="nd" id="nd" placeholder="Numero de documento" value="<?php echo $row[0] ?>" readonly>
            </div>
            <div class="col">
                <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Nombres" value="<?php echo $row[2] ?>">
            </div >
        </div>

        <div class="row">
            <div class="col">
                <input type="text" class="form-control" name="apellidos" id placeholder="Apellidos" value="<?php echo $row[3] ?>">
            </div>
            <div class="col">
                <select name="formacion" id="formacion" class="form-control" required>
          
                    <?php
                        if(include('../../conectar.php'))
                        {
                            $sql="select * from formacion";
                            $tabla=mysqli_query($conectar,$sql);
                            while($fila=mysqli_fetch_array($tabla))
                            {
                                if($fila[0]==$row[4]){
                                    print("<option selected value='$fila[0]'>");
                                    print($fila[1]);
                                    print("</option>");
                                    }
                                    else{
                                    print("<option value='$fila[0]'>");
                                    print($fila[1]);
                                    print("</option>");
                                    }
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
             
                    <?php
                        if(include('../../conectar.php'))
                        {
                            $sql="select * from sede";
                            $tabla=mysqli_query($conectar,$sql);
                            while($fila=mysqli_fetch_array($tabla))
                            {
                                if($fila[0]==$row[5]){
                                    print("<option selected value='$fila[0]'>");
                                    print($fila[1]);
                                    print("</option>");
                                    }
                                    else{
                                    print("<option value='$fila[0]'>");
                                    print($fila[1]);
                                    print("</option>");
                                    }
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
                <input type="file" class="form-control" name="fotografia" placeholder="fotografia" value="<?php echo $row[6] ?>">
            </div>
            
            
        </div>

        <div class="row">
        <div class="col">
                <textarea name="pc" id="pc" cols="40" rows="5" placeholder="Escriba propuesta (maximo 300 caracteres)" class="form-control"><?php echo $row[7] ?></textarea>
            </div>
        </div>
        <div class="row">
                
                    <br>
                <div class="col button">
                    <button class="btn btn-primary" type="submit" name="boton" style="background-color: #212529; border:none;">Actualizar</button>

                    
                </div>
            
            </div>
           
            
    </form>
    </div>
</body>
</html>