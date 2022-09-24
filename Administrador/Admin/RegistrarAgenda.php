<?php include("menu.php") ?>

<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link rel="stylesheet" href="css/styleCandidatos.css">

<div class="container contenedor">
    <form action="" method="post">
        <h2>Registrar agenda de votacion</h2>
        <br>
        <div class="row">
            <div class="col">
                <label for="" class="form-label">Fecha de inicio de la votacion</label>
                <input type="date" class="form-control" name="fi" required>
            </div>
            <div class="col">
                <label for="" class="form-label">Fecha final de la votacion</label>
                <input type="date" class="form-control" name="ff" required>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="" class="form-label">Hora de inicio de la votacion</label>
                <input type="time" class="form-control" name="hi" required>
            </div>
            <div class="col">
                <label for="" class="form-label">Hora final de la votacion</label>
                <input type="time" class="form-control" name="hf" required>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <textarea name="descripcion" id="descripcion" cols="30" rows="10" class="form-control" placeholder="Descripcion de la votacion" style="height:100px;" required></textarea>
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
        $descripcion=$_POST['descripcion'];
        $fi=$_POST['fi'];
        $ff=$_POST['ff'];
        $hi=$_POST['hi'];
        $hf=$_POST['hf'];

        $sql="insert into agendar_votaciones (descripcion_votacion,fecha_inicio,fecha_final,hora_inicio,hora_final,estado) value('$descripcion','$fi','$ff','$hi','$hf',1)";
        if(include('../../conectar.php'))
        {
            if(mysqli_query($conectar,$sql))
            {
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