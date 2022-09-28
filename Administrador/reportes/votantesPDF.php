<?php
session_start();
if(isset($_SESSION['usuario']))
 {
     // recuperando la session
     $usuario=$_SESSION['usuario'];
     // print("Bienvenido: ".$usuario[1]." ".$usuario[2]);
 }
 else
 {   
     // redireccionar para el login
     session_destroy();
     header("Location: ../../index.php");
 }
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Votantes</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> 
</head>
<body>
    
<?php include("../../conectar.php"); ?>

<table id="datatable-light" class="table table-light">
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
            print("<td>$fila[0]</td>");
            print("<td>$fila[1]</td>");
            print("<td>$fila[2]</td>");
            print("<td>$fila[3]</td>");
            print("<td>$fila[4]</td>");
            print("<td>$fila[5]</td>");
                                            
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
</body>
</html>

<?php
    $html = ob_get_clean();
    // echo $html;

  
    require_once '../libreria/dompdf/autoload.inc.php';
    use Dompdf\Dompdf;
    $dompdf = new Dompdf();

    $options = $dompdf->getOptions();
    $options->set(array('isRemoteEnabled' => true));
    $dompdf->setOptions($options);

    $dompdf->loadHtml($html);

    // $dompdf->setPaper('letter'); // para el tamaño que sea carta
    $dompdf->setPaper('A4' , 'landscape'); // para el tamaño que sea o.

    $dompdf->render();
    $dompdf->stream("votantes.pdf", array("Attachment" => false)); // para descargar enseguida se usa true en vez de false

?>