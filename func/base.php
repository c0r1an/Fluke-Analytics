<?php
include 'class/DataSource.php';
function scan() 
{
    $files = array();
    foreach (glob("csv/*.csv") as $file) {
        $files[] = $file;
    }
    return $files;
}

function getHeader() 
{
    $html = '<title>Kronocharts Example</title>
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        
        <link rel="shortcut icon" href="static/img/fluke.ico" />
        
        <link rel="stylesheet" href="static/css/bootstrap.min.css">
        <link rel="stylesheet" href="static/css/styles.css">
        <link rel="stylesheet" href="static/css/font-awesome.min.css">
        
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript" src="static/highcharts-4.0.4/js/highcharts.js"></script>
        <script type="text/javascript" src="static/highcharts-4.0.4/js/modules/exporting.js"></script>';

    return $html;
}

function replace($text) {
    $searchReplaceArray = array(
        ';' => ',',
        'OL' => '0',
    );
    
    $result = str_replace(
            array_keys($searchReplaceArray), 
            array_values($searchReplaceArray),  
            str_replace(',', '.', $text));
    return $result;
 }
 
 function getData($data)
 {
    $files = $data;
    $html = '';
    foreach ($files as $file => $value) {
        $csv = new File_CSV_DataSource();
 
        // tell the object to parse a specific file
        if ($csv->load($value)) {
             $csv->getHeaders();
             $html .= "{
            type: 'area',
            name: '".str_replace('csv/', '', $value)."',
            data: [".  replace(implode(';', $csv->getColumn('Max ')))."]
        },";
        }
    }
    return $html;
 }