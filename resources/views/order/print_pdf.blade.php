<?php

require_once  base_path(). '/vendor/autoload.php';
ob_end_clean();
$mpdf = new mPDF();
$mpdf->WriteHTML('<h1>Hello จุฑากรณ์worldsdfsd!</h1>');
$mpdf->Output();