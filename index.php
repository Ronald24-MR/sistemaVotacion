<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css"
  rel="stylesheet"
/>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <form method="POST">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
      
              <div class="mb-md-5 mt-md-4 pb-5">
      
                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                <p class="text-white-50 mb-5">Ingrese su usuario y contraseña</p>
      
                <div class="form-outline form-white mb-4">
                  <input type="number" id="typeEmailX" class="form-control form-control-lg" name="usuario" required />
                  <label class="form-label" for="typeEmailX">Usuario</label>
                </div>
      
                <div class="form-outline form-white mb-4">
                  <input type="password" id="typePasswordX" class="form-control form-control-lg" name="clave" required />
                  <label class="form-label" for="typePasswordX">Contraseña</label>
                </div>
      
               
      
                <button class="btn btn-outline-light btn-lg px-5" type="submit" name="boton">Iniciar Sesion</button>
      
      
              </div>
      
              
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>

<script type="text/javascript">
    function preventBack(){window.history.forward()};
    setTimeout("preventBack()",0);
    window.onunload = function(){null}
</script>


<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"
></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>

<?php
    if(isset($_POST['boton']))
    {
        // recoger los datos
        $usuario=$_POST['usuario'];
        $clave=$_POST['clave'];
        $sql="select * from usuario where usuario=$usuario and clave='$clave'";
        if(include('conectar.php'))
        {
            $tabla=mysqli_query($conectar,$sql);
            $fila=mysqli_fetch_array($tabla);
            if($tabla->num_rows==1)
            {
                // crear una session
                session_start();
                $_SESSION['usuario']=$usuario;
                $_SESSION['cod_id']=$usuario;
                if($fila['cod_id']==1)
                {
                  header("Location: Administrador/Admin/index.php");
                }
                elseif ($fila['cod_id']==2) 
                {
                  include('principal/mostrarFecha.php');
                }
            }
            else
            {
                print("<script> Swal.fire({
                    icon: 'error',
                    title: 'Usuario no registrado',
                    text: 'usuario o clave incorrectos.',})
                    </script>");
            }
        }
        else
        {
            print("error al conectar");
        }
    }
?>
<?php
  if (isset($_GET['votar']) && !isset($_POST['boton'])){
    
    print("<script>Swal.fire('Voto registrado correctamente.')</script>");

  }
    
?>