<?php
require 'vendor/autoload.php';
$conectar=mysqli_connect("localhost","root","","sistemavotaciones");
class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter {

    public function readCell($columnAddress, $row, $worksheetName = '') {
        // Read title row and rows 20 - 30
        if ($row>1) {
            return true;
        }
        return false;
    }
}


$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
$inputFileName = $_FILES['excel']['tmp_name'];

$inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);

$reader->setReadFilter( new MyReadFilter() );

$spredsheet = $reader->load($inputFileName);
$cantidad = $spredsheet->getActiveSheet()->toArray();

$table = "<table >";

foreach($cantidad as $row){
    if($row[0] != ''){
        $consulta = "INSERT INTO gestionar_votantes (numero_documento, cod_tipo_documento, nombres, apellidos, cod_formacion, cod_sede) VALUES ('$row[0]','$row[1]','$row[2]','$row[3]','$row[4]','$row[5]')";
        if($result = $conectar->query($consulta)){
           $table =  $table.'<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td><td>correcto</td></tr>';
        }
        else{
            $table =  $table.'<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td><td>correcto</td></tr>';

        }

        
    }
    

}
$table = $table."</table>";
print($table);
?>
