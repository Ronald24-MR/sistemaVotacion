
     
            <?php include("menu.php");  ?>
            <?php include("../../conectar.php"); ?>
            
    
            

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Reportes de Votantes</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php" style="text-decoration: none;">Welcome</a></li>
                            <li class="breadcrumb-item active">Tabla</li>
                        </ol>
                        
                        <a href="RegistrarVotantes.php" class="btn btn-primary mb-3">Nuevo Registro</a>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabla Votantes
                            </div>
                            <div class="card-body">

                                <table id="datatablesSimple"  class="table-light">
                                    <thead>
                                        <tr>
                                            <th>Numero Documento</th>
                                            <th>Tipo de documento</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Formacion</th>
                                            <th>Sede</th>
                                            <th>Estado</th>
                                            <th style="width: 100px; height: 30px;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $sql="select gestionar_votantes.numero_documento,tipo_documento.nombre,gestionar_votantes.nombres,gestionar_votantes.apellidos,
                                    formacion.nombre,sede.nombre, usuario.estado from gestionar_votantes,tipo_documento,formacion,sede, usuario
                                    where gestionar_votantes.cod_tipo_documento=tipo_documento.codigo and gestionar_votantes.cod_formacion=formacion.codigo 
                                    and gestionar_votantes.cod_sede=sede.codigo and gestionar_votantes.numero_documento=usuario.usuario order by usuario.estado";

                                    if($conectar=mysqli_connect("localhost","root","","sistemavotaciones")){
                                        $tabla=mysqli_query($conectar,$sql);
                                        while($fila=mysqli_fetch_array($tabla)){
                                            print("<tr >");
                                            print("<td style='text-align:center;'>$fila[0]</td>");
                                            print("<td style='text-align:center;'>$fila[1]</td>");
                                            print("<td style='text-align:center;'>$fila[2]</td>");
                                            print("<td style='text-align:center;'>$fila[3]</td>");
                                            print("<td style='text-align:center;'>$fila[4]</td>");
                                            print("<td style='text-align:center;'>$fila[5]</td>");
                                            
                                            if($fila[6]==1){
                                                print("<td>Ya voto</td>");
                                            }
                                            else{
                                                print("<td>No ha votado</td>");
                                            }
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

                                <a href="../reportes/votantesPDF.php" target="_blank" class="btn btn-danger">
                                <i class='fas fa-file-pdf'></i>Ver PDF</a>
                                <a href="../libreria/excel/exportarExcel.php" class="btn btn-success">
                                     <i class="fas fa-file-excel"></i>Ver EXCEL
                                </a>


                            </div>
                        </div>
                    </div>
                </main>
                
            </div>
        </div>
