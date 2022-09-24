
     
            <?php include("menu.php");  ?>
            <?php include("../../conectar.php"); ?>
          
            

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Reporte de Candidatos</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php" style="text-decoration: none;">Welcome</a></li>
                            <li class="breadcrumb-item active">Tabla</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla Candidatos
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table-light">
                                    <thead>
                                        <tr>
                                            <th>Fotografia</th>
                                            <th>Tipo de documento</th>
                                            <th>Numero de Documento</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Formacion</th>
                                            <th>Sede</th>
                                            <th>Numero de Votos</th>
                                            <th style="width: 100px; height: 30px;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $sql = "select registrar_votaciones.fotografia,tipo_documento.nombre,registrar_votaciones.numero_documento,registrar_votaciones.nombres,registrar_votaciones.apellidos,formacion.nombre,sede.nombre,registrar_votaciones.numero_votos
                                    from registrar_votaciones,tipo_documento,formacion,sede where registrar_votaciones.cod_tipo_documento=tipo_documento.codigo and registrar_votaciones.cod_formacion=formacion.codigo and registrar_votaciones.cod_sede=sede.codigo";

                                    if($conectar=mysqli_connect("localhost","root","","sistemavotaciones")){
                                        $tabla=mysqli_query($conectar,$sql);
                                        while($fila=mysqli_fetch_array($tabla)){
                                            print("<tr >");
                                            print("<td ><img src='img/$fila[0]' style='border-radius:50%; width: 100px; height: 90px'></td>");
                                            print("<td style='text-align:center;'>$fila[1]</td>");
                                            print("<td style='text-align:center;'>$fila[2]</td>");
                                            print("<td style='text-align:center;'>$fila[3]</td>");
                                            print("<td style='text-align:center;'>$fila[4]</td>");
                                            print("<td style='text-align:center;'>$fila[5]</td>");
                                            print("<td style='text-align:center;'>$fila[6]</td>");
                                            print("<td style='text-align:center;'>$fila[7]</td>");
                                            print("<td>
                                            <form method=post'>
                                                

                                                <input type='submit' name='accion' id='actualizar' value='Seleccionar' class='btn btn-primary'>

                                                <input type='submit' name='accion'  value='Borrar' class='btn btn-danger'>

                                            </form>
                                            </td>");
                                            print("</tr>");
                                        }
                                    }
                                    else{
                                        print("error al conectar");
                                    }
                                    
                                    ?>
                                    
                                    </tbody>
                                </table>

                                <a href="../reportes/candidatosPDF.php" class="btn btn-danger">Ver PDF</a>


                            </div>
                        </div>
                    </div>
                </main>
                
            </div>
        </div>
 
      