
<img src="" alt="">
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Votaciones - SENA</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="css/index.css">
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
            <div class="container px-5">
                <a class="navbar-brand" href="index.php">Votaciones</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="https://www.sena.edu.co/es-co/Paginas/default.aspx" target="_blank">SENA</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="masthead text-center text-white">
            <div class="masthead-content">
                <div class="container px-5">
                    <h1 class="masthead-heading mb-0">Bienvenido</h1>
                    <h2 class="masthead-subheading mb-0"></h2>
                    
                </div>
            </div>
            <div class="bg-circle-1 bg-circle"></div>
            <div class="bg-circle-2 bg-circle"></div>
            <div class="bg-circle-3 bg-circle"></div>
            <div class="bg-circle-4 bg-circle"></div>
        </header>
        <!-- Content section 1-->
        
        <section id="scroll" >
            <?php
                if(include(    $conectar=mysqli_connect("localhost","root","","sistemavotaciones"))){
                    $sql="select registrar_votaciones.numero_documento,tipo_documento.nombre,registrar_votaciones.nombres,registrar_votaciones.apellidos,formacion.nombre,sede.nombre,registrar_votaciones.fotografia,registrar_votaciones.propuesta_campaña 
                    from tipo_documento,sede,formacion,registrar_votaciones
                    where registrar_votaciones.cod_tipo_documento=tipo_documento.codigo and registrar_votaciones.cod_formacion=formacion.codigo 
                    and registrar_votaciones.cod_sede=sede.codigo ";
                    $tabla=mysqli_query($conectar,$sql);
                    while($fila=mysqli_fetch_array($tabla)){
                        ?>
                        <form action="guardado.php" method="post">
                            <div class="container px-5" style="box-shadow: 0 0 3px 0 rgba(0, 0, 0, 0.5); margin-top:20px;" >
                                <div class="row gx-5 align-items-center">
                                    <div class="col-lg-6 order-lg-2">
                                        <div class="p-5"><img class="img-fluid rounded-circle" src="../Administrador/Admin/img/<?php print($fila[6]); ?>" alt="foto del candidato" style="width:100%; height:480px;"/></div>
                                        </div>
                                        <div class="col-lg-6 order-lg-1">
                                            <div class="p-5">
                                            
                                                <h2 class="display-4"><?php print($fila[2]." ".$fila[3]); ?></h2>
                                                <p><?php print($fila[0]." - ".$fila[1]); ?></p>
                                                <div class="propuestas">
                                                <h2 style="font-size: 22px;">Propuestas</h2>
                                                <span class="texto">
                                                    <h2>Propuestas</h2>
                                                    <p><?php print($fila[7]); ?></p>
                                                </span>
                                            </div>
                                                <input type="hidden" name="cedula" value="<?php echo $fila[0]; ?>">
                                        
                                                <p><?php print($fila[4]); ?></p>
                                                <p><?php print($fila[5]); ?></p>
                                                <button class="btn btn-primary" type="submit" name="boton" style="background-color: #212529; border:none;">Votar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </form>
                        <?php
                            }
                        }
                        else
                        {
                            print("error al conectarse a la base de datos");
                        }
                    ?>     
        </section>
        
        <!-- Footer-->
        <footer class="py-5 bg-black" style="margin-top: 20px;">
            <div class="container px-5"><p class="m-0 text-center text-white small">Copyright &copy; SENA 2022</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>
