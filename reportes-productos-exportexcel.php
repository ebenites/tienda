<?php
require_once './autoload.php';
require_once './includes/security.php';

$productos = ProductoDAO::listar();

/** Include path **/
ini_set('include_path', ini_get('include_path').';libs/PHPExcel/');

require_once 'PHPExcel.php';
require_once 'PHPExcel/Writer/Excel2007.php';

$excel = new PHPExcel();

//Propiedades
$excel->getProperties()->setCreator('Erick Benites');
$excel->getProperties()->setCompany('Tecsup');
$excel->getProperties()->setLastModifiedBy("Jaime Farfan");
$excel->getProperties()->setTitle("Lista de Productos");
$excel->getProperties()->setSubject("Lista de productos por categorias de Enero");
$excel->getProperties()->setDescription("Ejemplo desarrollado con PHPExcel.");

// Selecionamos la hoja 0
$excel->setActiveSheetIndex(0);

$sheet = $excel->getActiveSheet();
$sheet->setTitle('Productos');

// Llenamos datos sobre la hoja 0
$sheet->setCellValueByColumnAndRow(0, 1, 'ID'); // A1
$sheet->setCellValueByColumnAndRow(1, 1, 'CATEGORÍA'); // B1
$sheet->setCellValueByColumnAndRow(2, 1, 'MODELO'); // C1
$sheet->setCellValueByColumnAndRow(3, 1, 'PRECIO'); // D1
$sheet->setCellValueByColumnAndRow(4, 1, 'STOCK'); // E1
$sheet->setCellValueByColumnAndRow(5, 1, 'ESTADO'); // F1

foreach ($productos as $index => $producto) {
    $sheet->setCellValueByColumnAndRow(0, $index+2, $producto->id);
    $sheet->setCellValueByColumnAndRow(1, $index+2, $producto->categorias_nombre);
    $sheet->setCellValueByColumnAndRow(2, $index+2, $producto->nombre);
    $sheet->setCellValueByColumnAndRow(3, $index+2, $producto->getPrecio2String());
    $sheet->setCellValueByColumnAndRow(4, $index+2, $producto->stock);
    $sheet->setCellValueByColumnAndRow(5, $index+2, $producto->getEstado2String());
}

$sheet->setCellValueByColumnAndRow(4, $index+3, '=SUM(E2:E'.($index+2).')');

// Ancho de columnas
$sheet->getColumnDimension('A')->setWidth(10);
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);
$sheet->getColumnDimension('E')->setAutoSize(true);
$sheet->getColumnDimension('F')->setAutoSize(true);

// Estilos de celdas
$headStyle = $sheet->getStyle('A1:F1');
$headStyle->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$headStyle->getFill()->getStartColor()->setRGB('FF0000');
$headStyle->getFont()->getColor()->setRGB('FFFFFF');
$headStyle->getFont()->setBold(TRUE);

$dataStyle = $sheet->getStyle("A2:F" . ($index+2));
$dataStyle->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

// Insertando Imagen
$image = new PHPExcel_Worksheet_Drawing();
$image->setName('Logo');
$image->setPath('img/logo2.png');
$image->setHeight(80);
$image->setWorksheet($sheet);
$image->setCoordinates('A'.($index+4));

// Creando una hoja nueva
$newSheet = $excel->createSheet();
$newSheet->setTitle('HojaNueva');
//$newSheet->...

// Crear el writer y generar el archivo excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporte-productos.xlsx"');
header('Cache-Control: max-age=0');

$writer = new PHPExcel_Writer_Excel2007($excel);
$writer->save('php://output');