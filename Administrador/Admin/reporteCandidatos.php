
     
            <?php include("menu.php"); ?>
            <?php include("../../conectar.php"); ?>
            <?php  if (isset($_GET['eliminado'])){
    
                    print("<script>Swal.fire('Registro eliminado correctamente')</script>");

            } ?>

<?php 
            if (isset($_GET['actualizado'])){
    
                print("<script>Swal.fire('Registro actualizado correctamente')</script>");

            }
            ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Reporte de Candidatos</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php" style="text-decoration: none;">Welcome</a></li>
                            <li class="breadcrumb-item active">Tabla</li>
                        </ol>
                        
                        <a href="RegistrarCandidatos.php" class="btn btn-primary mb-3">Nuevo Registro</a>

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
                                            print("<td ><img src='fotos/$fila[0]' style='border-radius:50%; width: 100px; height: 90px'></td>");
                                            print("<td style='text-align:center;'>$fila[1]</td>");
                                            print("<td style='text-align:center;'>$fila[2]</td>");
                                            print("<td style='text-align:center;'>$fila[3]</td>");
                                            print("<td style='text-align:center;'>$fila[4]</td>");
                                            print("<td style='text-align:center;'>$fila[5]</td>");
                                            print("<td style='text-align:center;'>$fila[6]</td>");
                                            print("<td style='text-align:center;'>$fila[7]</td>");
                                            print("<td>
                                            <a href='actualizar2.php?id=$fila[2]' class='btn btn-info'>Editar</a>

                                            <form method='post' action='borrar2.php'>
                                            <input type='hidden' name='codigo' value='$fila[2]'>
                                            <input type='submit' name='accion'  value='Borrar' class='btn btn-danger' onclick='return Confirmar();'>
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
                                
                                <a href="../reportes/candidatosPDF.php" target="_blank" class="btn btn-danger">
                                <i class='fas fa-file-pdf'></i>Ver PDF</a>
                                <a href="../libreria/excel/exportarExcel2.php" class="btn btn-success">
                                     <i class="fas fa-file-excel"></i>Ver EXCEL
                                </a>

                            </div>
                        </div>
                    </div>
                </main>
                
            </div>
        </div>

        <script>
           function Confirmar(){
            let respuesta = confirm("Estas seguro que deseas borrar el registro?")

            if(respuesta == true){
                return true;
            }
            else{
                return false;
            }
           }
           
        </script>

  
      