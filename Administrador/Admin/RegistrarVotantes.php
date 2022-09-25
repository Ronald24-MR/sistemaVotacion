<?php include("menu.php") ?>

<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link rel="stylesheet" href="css/styleCandidatos.css">

<div class="container contenedor">
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
                <input type="number" class="form-control" name="nd" placeholder="Numero de documento" requerid>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <input type="text" class="form-control" name="nombres" placeholder="Nombres" required>
            </div>
            <div class="col">
                <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" required>
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
</div>

<script>
    document.getElementById("txt_archivo").addEventListener("change",()=>{
        let fileName = document.getElementById("txt_archivo").value;
        let idxDot = fileName.lastIndexOf(".") + 1;
        let extFile = fileName.substr(idxDot,fileName.length).toLowerCase();
        
        if(extFile=="xlsx" || extFile=="xlsb" || extFile=="xlsm"){

        }
        else{
            Swal.fire("!Tipo de archivo no valido¡");
            document.getElementById("txt_archivo").value="";
        }
    });

    function cargarExcel(){
        let archivo = document.getElementById("txt_archivo").value;
        if(archivo.length==0){
            return Swal.fire("Seleccione un archivo");
        }

        let formData = new FormData();
        let excel = $("#txt_archivo")[0].files[0];
        formData.append('excel',excel)
        $.ajax({
            url: '../libreria/excel/leerVotantes.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success:function(resp){
                document.write(resp);
            }
        })
        return false;
    }
</script>


<?php
    if(isset($_POST['boton']))
    {
        $nd=$_POST['nd'];
        $td=$_POST['td'];
        $nombres=$_POST['nombres'];
        $apellidos=$_POST['apellidos'];
        $formacion=$_POST['formacion'];
        $sede=$_POST['sede'];
        
        $sql="insert into usuario value($nd,'$nd','$nombres $apellidos',2,0)";
        
        if(include('../../conectar.php'))
        {
            if(mysqli_query($conectar,$sql))
            {
                $sql="insert into gestionar_votantes value($nd,$td,'$nombres','$apellidos',$formacion,$sede)";
                mysqli_query($conectar,$sql);
                print("<script>Swal.fire('Registro guardado correctamente')</script>");
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