
<?php
    date_default_timezone_set('America/Bogota');
    $fecha=date('Y-m-d');
    $hora=date('h:i');
    $sql="SELECT * FROM agendar_votaciones WHERE '$fecha'>=fecha_inicio and '$fecha'<= fecha_final and '$hora' >= hora_inicio and '$hora' <= hora_final and estado=1";

    if($conectar=mysqli_connect("localhost","root","","sistemavotaciones"))
        {
            $tabla=mysqli_query($conectar,$sql);
            if($tabla->num_rows==1)
            {
                if($fila['estado']==0)
                  {
                  header("Location: principal/index.php");
                  }
                  else
                  {
                    print("<script>Swal.fire('Ya usted voto.')</script>");
                  }

            }
            else
            {
                print("<script>Swal.fire('No hay elecciones en estos momentos.')</script>");
            }
        }
        else
    {
        print("error al conectar");
    }
?>