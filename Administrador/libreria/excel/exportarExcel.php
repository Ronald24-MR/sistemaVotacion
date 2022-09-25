<?php 
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename= votantes.xls");

?>
<table id="datatablesSimple" class="table-light ">
                                    <table>
                                    <thead>
                                        <tr>
                                            <th>Numero Documento</th>
                                            <th>Tipo de documento</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Formacion</th>
                                            <th>Sede</th>
                                            <th>Estado</th>
                                
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
                                            
                                            print("</tr>");
                                        }
                                    }
                                    else{
                                        print("error al conectar");
                                    }
                                    
                                    ?>
                                    
                                    </tbody>
                                    
                                </table>