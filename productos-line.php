<?php
require_once './autoload.php';
require_once './libs/jpgraph/jpgraph.php';
require_once './libs/jpgraph/jpgraph_line.php';

$categorias_id = $_GET['categorias_id'];

$lista  = ProductoDAO::listarStockPorcategoria($categorias_id);
//var_dump($lista);

$data = array();
$labels = array();
foreach ($lista as $producto){
    $data[] = $producto->stock;
    $labels[] = $producto->nombre;
}

$graph = new Graph(800, 600);
$graph->SetScale('textlin', 0, 50);
$graph->title->Set('Reporte de Stock');
$graph->subsubtitle->Set('Categorias '. 3);
$graph->xaxis->title->Set('Productos');
$graph->yaxis->title->Set('Stock');

$graph->xaxis->SetTickLabels($labels);
$graph->xaxis->SetLabelAngle(90);

$line = new LinePlot($data);
$line->SetColor('blue');
$line->value->Show();
$line->SetLegend('Stock');
$graph->Add($line);

$graph->Stroke();
