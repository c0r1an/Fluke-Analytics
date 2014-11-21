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
 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_FILES['file']['name']) {
             
            $name     = $_FILES['file']['name'];
            $tmpName  = $_FILES['file']['tmp_name'];
            $error    = $_FILES['file']['error'];
            $size     = $_FILES['file']['size'];
            $ext      = strtolower(pathinfo($name, PATHINFO_EXTENSION));
           
            switch ($error) {
                case UPLOAD_ERR_OK:
                    $valid = true;
                    //validate file extensions
                    if ( !in_array($ext, array('csv')) ) {
                        $valid = false;
                        $response = 'Invalid file extension.';
                    }
                    //validate file size
                    if ( $size/1024/1024 > 2 ) {
                        $valid = false;
                        $response = 'File size is exceeding maximum allowed size.';
                    }
                    //upload file
                    if ($valid) {
                        $targetPath =  '../csv/'.$name;
                        move_uploaded_file($tmpName,$targetPath);
                        session_start();
                        $_SESSION['output-true'] = 'Success';
                        $host  = $_SERVER['HTTP_HOST'];
                        header("Location: http://$host");
                        exit;
                    }
                    break;
                case UPLOAD_ERR_INI_SIZE:
                    $response = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $response = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $response = 'The uploaded file was only partially uploaded.';
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $response = 'No file was uploaded.';
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $response = 'Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.';
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $response = 'Failed to write file to disk. Introduced in PHP 5.1.0.';
                    break;
                case UPLOAD_ERR_EXTENSION:
                    $response = 'File upload stopped by extension. Introduced in PHP 5.2.0.';
                    break;
                default:
                    $response = 'Unknown error';
                break;
            }
 
            session_start();
            $_SESSION['output-false'] = $response;
            $host  = $_SERVER['HTTP_HOST'];
                        header("Location: http://$host");
                        exit;
        }