<?php
require_once './autoload.php';
require_once './includes/security.php';

if($_FILES['archivo']['error'] != 0)
    die('Error al cargar archivo');

/** Include path **/
ini_set('include_path', ini_get('include_path').';libs/PHPExcel/');

require_once 'PHPExcel.php';

$reader = new PHPExcel_Reader_Excel2007();
$reader->setReadDataOnly(true);
$excel = $reader->load($_FILES['archivo']['tmp_name']);

//Activamos la hoja 0
$excel->setActiveSheetIndex(0);
//Recuperamos la referencia a la hoja activada
$sheet = $excel->getActiveSheet();

$highestRow = $sheet->getHighestRow(); // Ultima fila

for ($row = 2; $row <= $highestRow; $row++) {
//    try{

    // Recuperar valores y validarlos
    $username = $sheet->getCellByColumnAndRow(0, $row)->getValue();
    $password = $sheet->getCellByColumnAndRow(1, $row)->getValue();
    $nombres = $sheet->getCellByColumnAndRow(2, $row)->getValue();
    $roles_id = $sheet->getCellByColumnAndRow(3, $row)->getValue();
    $email = $sheet->getCellByColumnAndRow(4, $row)->getValue();
    
    // Encapsular y registrar
    $usuario = new Usuario();
    $usuario->username = $username;
    $usuario->password = $password;
    $usuario->nombres = utf8_decode($nombres);
    $usuario->roles_id = $roles_id;
    $usuario->email = $email;
    
    UsuarioDAO::registrar($usuario);    
    
//    }catch(Exception $e){
//        echo 'No se grabó este registro';
//    }
    
}

Flash::success('Importación de usuarios satisfactoria');

header('location: reportes-inicio.php');