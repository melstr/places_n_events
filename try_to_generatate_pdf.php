<?php
require_once("vendor/autoload.php");
$mpdf = new \Mpdf\Mpdf();

$mpdf->Bookmark('Start of the document');
$mpdf->WriteHtml("<style>.test {color:red;}</style>");
$mpdf->WriteHTML("<div class='test' >Русский текст</div>");

$mpdf->Output();
?>