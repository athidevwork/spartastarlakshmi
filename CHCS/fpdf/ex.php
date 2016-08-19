<?php
require('wordwrap.php');

$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$text='this is a word wrap test ';
$pdf->WordWrap($text,10);
$pdf->Write(5,"This paragraph has $nb lines:\n\n");
$pdf->Write(5,$text);
$pdf->Output();
?>
