<?php
require_once './autoload.php';

require_once './libs/jpgraph/jpgraph.php';
require_once './libs/jpgraph/jpgraph_pie.php';

$categorias_id = $_GET['categorias_id'];

$lista  = ProductoDAO::listarStockPorcategoria($categorias_id);
//var_dump($lista);


$data = array();
$labels = array();
foreach ($lista as $producto){
    $data[] = $producto->stock;
    $labels[] = $producto->nombre;
}

$graph = new PieGraph(800, 600);
$graph->title->Set('Reporte de Stock');

$p1 = new PiePlot($data);
$p1->SetLegends($labels);
$p1->SetLabelPos(0.6);
$graph->Add($p1);

$graph->Stroke();