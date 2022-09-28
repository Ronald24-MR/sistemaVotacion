<?php 
$cedula = $_POST['cedula'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];



?>

<form action="" method="post">
        <h2>Registro de votantes</h2>
        <div class="row">
            <div class="col">
            <select name="td" id="td" class="form-control" required>
                    <option value="0" disabled selected hidden>Tipo de documento</option>
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
                <input type="number" class="form-control" name="nd" placeholder="Numero de documento" value="<?php print($cedula) ?>" requerid>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <input type="text" class="form-control" name="nombres" placeholder="Nombres" required value="<?php print($nombres) ?>">
            </div>
            <div class="col">
                <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" required value="<?php print($apellidos) ?>">
            </div>
        </div>

        <div class="row">
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
                
                    <br>
                <div class="col button"><button class="btn btn-primary" type="submit" name="boton" style="background-color: #212529; border:none;">Guardar</button></div>
             
            </div>
            <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fas fa-file-excel"></i>Importar desde excel
            </a>

            <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Elija el archivo excel</h5>
        
      </div>
      <div class="modal-body">
      <input type="file" id="txt_archivo" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button class="btn btn-success" onclick="cargarExcel()">Importar</button>
      </div>
    </div>
  </div>
</div>
    </form>


    