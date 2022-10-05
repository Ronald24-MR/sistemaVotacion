<?php 
    include("../../conectar.php");
    

$id=$_GET['id'];

$sql="SELECT gestionar_votantes.numero_documento, tipo_documento.nombre, gestionar_votantes.nombres, gestionar_votantes.apellidos, formacion.nombre, sede.nombre FROM tipo_documento,sede,formacion,gestionar_votantes WHERE gestionar_votantes.cod_tipo_documento=tipo_documento.codigo and gestionar_votantes.cod_formacion=formacion.codigo and gestionar_votantes.cod_sede=sede.codigo and gestionar_votantes.numero_documento=$id";
// print($sql);
$query=mysqli_query($conectar,$sql);

$row=mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <title>Actualizar</title>
        <link rel="stylesheet" href="css/styleCandidatos.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        
    </head>
    <body>
    <div class="container contenedor">
    <form action="update.php" method="post">
        <h2>Actualizar votantes</h2>
        <div class="row">
            <div class="col">
            <select name="td" id="td" class="form-control" >
                   
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
                <input type="number" class="form-control" value="<?php echo $row['numero_documento'] ?>" name="nd" placeholder="Numero de documento"  readonly>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <input type="text" class="form-control" value="<?php echo $row['nombres'] ?>" name="nombres" placeholder="Nombres" >
            </div>
            <div class="col">
                <input type="text" class="form-control" value="<?php echo $row['apellidos'] ?>" name="apellidos" placeholder="Apellidos" >
            </div>
        </div>

        <div class="row">
            <div class="col">
                <select name="formacion" id="formacion" class="form-control" >
                
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
                <select name="sede" id="sede" class="form-control" >
                
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
                
                    <br>
                <div class="col button"><button class="btn btn-primary" type="submit" name="boton" style="background-color: #212529; border:none;">Actualizar</button></div>
             
            </div>
            
    </form>
</div>
    </body>
</html>