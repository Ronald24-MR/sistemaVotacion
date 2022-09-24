<?php
   session_start();
   if(!isset($_SESSION['rol'])){
        header("location: ../index.php");
   }
   else{
        if($_SESSION['rol'] != 2){
            header("location: ../index.php");
        }
   }
?>

<?php
    if(isset($_POST['cedula']))
    {
        $cedula=$_POST['cedula'];
    

        $sql="update registrar_votaciones set numero_votos=numero_votos+1  where numero_documento=$cedula";
        if(include('../conectar.php'))
        {
            if(mysqli_query($conectar,$sql))
            {
                
                $sql="update usuario set estado=1  where usuario=$usuario";
                mysqli_query($conectar,$sql);
                header("Location: ../index.php?votar=1");
                
            }
            else
            {
                print("<script>Swal.fire('Error al guardar el voto.')</script>");
            }
        }
    else
    {
        print("error al conectar");
    }
    }

    
?>