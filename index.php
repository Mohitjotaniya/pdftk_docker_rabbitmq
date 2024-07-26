<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';

use mikehaertl\pdftk\Pdf;

try {

    $pdf = new Pdf();
    
    $pdf->addFile(__DIR__ . '/Standard_Prior_Authorization_Form_TX.pdf', 'C', 'secret*password');

    // $pdf->addFile('Standard_Prior_Authorization_Form_TX.pdf', 'C', 'secret*password');
    // echo "<pre>";
    // print_r($pdf);
    // exit;

    $pdf->fillForm([
        'Issuer Name' => 'value1',
        'name' => 'value2',
        // Add more fields as needed
    ]);

    $outputPdfPath = __DIR__ . '/filled_template.pdf';

    $result = $pdf->saveAs($outputPdfPath);


    // $result = $pdf->saveAs(__DIR__ . '/filled_template.pdf');
    //   echo "<pre>";
    // print_r($result);
    // exit;

    if ($result === false) {
        throw new Exception($pdf->getError());
    }

    echo "PDF created successfully.";
} catch (Exception $e) {
    echo 'An error occurred: ' . $e->getMessage();
}
