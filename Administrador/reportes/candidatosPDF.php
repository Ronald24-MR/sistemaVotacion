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
    <title>Document</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> 
</head>
<body>

    <?php include("../../conectar.php"); ?>
    <h2 style="text-align: center; font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">Reporte de Candidatos</h2>
    <table id="datatablesSimple" class="table table-light">
        <thead>
            <tr>
                <th style='text-align:center;'>Fotografia</th>
                <th style='text-align:center;'>Tipo de documento</th>
                <th style='text-align:center;'>Numero de Documento</th>
                <th style='text-align:center;'>Nombres</th>
                <th style='text-align:center;'>Apellidos</th>
                <th style='text-align:center;'>Formacion</th>
                <th style='text-align:center;'>Sede</th>
                <th style='text-align:center;'>Numero de Votos</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "select registrar_votaciones.fotografia,tipo_documento.nombre,registrar_votaciones.numero_documento,registrar_votaciones.nombres,registrar_votaciones.apellidos,formacion.nombre,sede.nombre,registrar_votaciones.numero_votos
                from registrar_votaciones,tipo_documento,formacion,sede where registrar_votaciones.cod_tipo_documento=tipo_documento.codigo and registrar_votaciones.cod_formacion=formacion.codigo and registrar_votaciones.cod_sede=sede.codigo";
                if($conectar=mysqli_connect("localhost","root","","sistemavotaciones")){
                    $tabla=mysqli_query($conectar,$sql);
                    while($fila=mysqli_fetch_array($tabla)){
                        ?>
                        <tr>
                            <td>
                                <img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/sistemaVotacion/Administrador/Admin/img/<?php echo $fila[0]; ?>" alt="foto del candidato" style='border-radius:50%; width: 100px; height: 90px'>
                            </td>
                            <td style='text-align:center;'><?php echo $fila[1]; ?></td>
                            <td style='text-align:center;'><?php echo $fila[2]; ?></td>
                            <td style='text-align:center;'><?php echo $fila[3]; ?></td>
                            <td style='text-align:center;'><?php echo $fila[4]; ?></td>
                            <td style='text-align:center;'><?php echo $fila[5]; ?></td>
                            <td style='text-align:center;'><?php echo $fila[6]; ?></td>
                            <td style='text-align:center;'><?php echo $fila[7]; ?></td>
                        </tr>
                    <?php 
                    }
                }else{
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
    $dompdf->stream("candidatos.pdf", array("Attachment" => false)); // para descargar enseguida se usa true en vez de false

?>