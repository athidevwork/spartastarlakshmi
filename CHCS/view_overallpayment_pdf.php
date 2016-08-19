<?php
include("config.php");
$id = $_REQUEST['cid'];
$query1 ="SELECT a.*,b.customer,b.billing_address,sum(c.amount_pay) as total,c.v_num,c.c_num,c.pay_type,c.c_bank FROM `invoice`as a inner join add_customer as b on a.custref=b.customer_ref inner join payment_history as c on a.invoice_no=c.invoice_no where a.status=1 and c.c_status=1 and c.invoice_no='$id'";
$res1 = mysql_query($query1);
while($rs = mysql_fetch_array($res1)){
	$invoice_no =  $rs['invoice_no'];
	$customer =  $rs['customer'];
	$cusrefno =  $rs['custref'];
	$payment_status =  $rs['payment_status'];
	$invoice_date =  $rs['invoice_date'];
	$due_date =  $rs['due_date'];
	$customer_name =  $rs['customer_name'];
	$billing_add =  $rs['billing_address'];
	$tot_amt =  $rs['tot_amt'];
	$adjst =  $rs['adjustment'];
	$amt_paid =  $rs['total'];
	$vouno =  $rs['v_num'];
	$cheno =  $rs['c_num'];
	$taxa= $rs['taxa'];
	$bank =  $rs['c_bank'];
	//$dt1 = $tot_amt-$taxa;
	$pay_type = $rs['pay_type'];
	$amto_pay=$tot_amt-$adjst;
}
$sql="SELECT a.* FROM `invoice_product`as a inner join  payment_history as b on a.invoice_no=b.invoice_no where a.status=1 and b.c_status=1 and b.invoice_no='$id'";
require('fpdf/fpdf.php');
class PDF extends FPDF {
	function Header() {
	    $this->SetFont('Times','',12);
	    $this->SetY(0.25);
		$this->Image("images/news.png", 1, .25, 4, .75);
	    $this->SetY(1);
		$this->Line(20,45,210-20,45);
	}
	function Footer() {
	    $this->Image("images/newadd1.png", 0.85, 10.7, 6.45, 0.7);
	}
}
$pdf=new PDF("P","in","A4");
$pdf->SetMargins(1,1,1);
$pdf->AddPage();
$pdf->Image('images/try.png', 0, 0, $pdf->w, $pdf->h);
$pdf->SetFont('Times','',12);
$msg = 'Date                : '.date('d-M-Y').PHP_EOL.'Invoice No.     : '.$invoice_no . PHP_EOL.'Cust. Ref. No. : '.$cusrefno;
$pdf->SetXY(5 ,1.5, 3.5);
$pdf->MultiCell(2.3, 0.25, $msg, '1', "L");

$pdf->SetFillColor(240, 240, 240);
$pdf->SetFont('Times','B',14);
//$pdf->Cell(2, .30, "Customer :", 1, 1, "L", 1);
$pdf->SetFont('Times','B',12);
$pdf->Cell(3, 0.25, $customer, '0','0', "L");	$pdf->Ln();
$pdf->SetFont('Times','',12);
$pdf->MultiCell(3, 0.25, $billing_add, '0', "L");

//$pdf->Cell(3, 0.25, $billing_add, '0','0', "L");	$pdf->Ln();$pdf->Ln();
$pdf->SetFont('Times','B',12);
$pdf->MultiCell(6.5, 0.55, "CASH MEMO / BILL / TAX INVOICE", '0', "C");
$pdf->SetFont('Times','B',12);
$pdf->Cell(0.8, 0.25, "S. No", '1','0', "C");
$pdf->Cell(2.5, 0.25, "DESCRIPTION", '1','0', "C");
$pdf->Cell(0.8, 0.25, "Qty.", '1','0', "C");
$pdf->Cell(0.8, 0.25, "Price", '1','0', "C");
if($taxa != 0)
$pdf->Cell(0.8, 0.25, "Tax", '1','0', "C");
if($taxa != 0){
$pdf->Cell(0.8, 0.25, "Amount", '1','0', "C");
}else{
$pdf->Cell(1.6, 0.25, "Amount", '1','0', "C");
}
$pdf->Ln();
$pdf->SetFont('Times','',12);
$query1 = "SELECT a.* FROM `invoice_product`as a where a.status=1  and a.invoice_no='$id'";
$res1 = mysql_query($query1);
$i = 1;
while($rs = mysql_fetch_array($res1)){
	$x = $pdf->GetX();
	$y = $pdf->GetY();
	$pdf->SetXY($x + 0.8, $y);
	$pdf->MultiCell(2.5, 0.25, $rs['product_id'], '1', "L");				
	$multiCellHeight = $pdf->y - $y;

	$pdf->SetXY($x, $y);
	$pdf->MultiCell(0.8, $multiCellHeight, $i++, '1', "C");

	$pdf->SetXY($x + 3.3, $y);	
	$pdf->MultiCell(0.8, $multiCellHeight, $rs['qty'], '1', "C");
	
	$pdf->SetXY($x + 4.1, $y);
	$pdf->MultiCell(0.8, $multiCellHeight, $rs['rate'], '1', "C");
	if($taxa != 0){
		$pdf->SetXY($x + 4.9, $y);
		$pdf->MultiCell(0.8, $multiCellHeight, $rs['tax'].'%', '1', "C");
		$pdf->SetXY($x + 5.7, $y);
		$pdf->MultiCell(0.8, $multiCellHeight, $rs['total'], '1', "R");
	}
	else
	{
	$pdf->SetXY($x + 4.9, $y);
		$pdf->MultiCell(1.6, $multiCellHeight, $rs['total'], '1', "C");
		}
		
		
	
}
$pdf->Ln(.25);

$pdf->Cell(4, 0.25, "", '0','0', "C");
$pdf->Cell(2.5, 0.25, "Total Amount  : ". $tot_amt . '.00'.' INR', 'RTL','0', "L");$pdf->Ln();

	$pdf->Cell(4, 0.25, "", '0','0', "C");
	$pdf->Cell(2.5, 0.25, "Tax                  : ". $taxa .' INR', 'LR','0', "L");$pdf->Ln();
	
	
	$pdf->Cell(4, 0.25, "", '0','0', "C");
	$pdf->Cell(2.5, 0.25, "Grand Total     : ".$amto_pay.' INR', 'RBL','0', "L");
	
$pdf->Ln();$pdf->Ln();
$obj = new Integer();
$pdf->MultiCell(6.5, 0.25, "Amount (in words) : ".$obj->toText($amto_pay), '0', "L");
$pdf->Ln();
$pdf->SetFillColor(240, 240, 240);
$pdf->SetFont('Times','B',12);
$pdf->Cell(3.0, .30, "Payment Details", 1, 2, "C", 1);
$pdf->SetFont('Times','',12);
if($pay_type == 'Cash'){ $lbl = "Voucher"; 
}
else{ $lbl = "Cheque"; 
$ba='Bank Name           : '; 
}
$payment = $pay_type." Amount          : ". $amt_paid . PHP_EOL . $lbl.' No            : ' . $cheno . $vouno . PHP_EOL 
 .$ba. '' .$bank.''   ;
$pdf->MultiCell(3.0, 0.25, $payment, '1', "L");
$pdf->Ln();
$pdf->SetFillColor(240, 240, 240);
$pdf->SetFont('Times','B',12);
$pdf->Cell(6.5, .30, "TERMS AND CONDITIONS", 1, 2, "C", 1);
$terms = "1. Bill once signed cannot be retrieved.".PHP_EOL.
	"2. All transactions subject to Chennai Jurisdiction.".PHP_EOL.
	"3. This bill is applicable for implementing the product at the initial stage only.".PHP_EOL.
	"* Additional Coding/Scripts will be charged extra.";
$pdf->SetFont('Times','',12);
$pdf->MultiCell(6.5, 0.25, $terms, '1', "L");
$pdf->Ln();

$pdf->Cell(3.5, 0.25, "For Sparta Software Solutions,", '0','0', "L");
$pdf->Cell(3, 0.25, "Customer’s Signature,", '0','0', "R");
$pdf->Cell(.5, 0.25, "", '0','0', "C");
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(.5, 0.25, "", '0','0', "C");
$pdf->Cell(2.5, 0.25, "(Mobeen.N)", '0','0', "L");
$pdf->Cell(3.5, 0.25, "  (                              )   ", '0','0', "R");

$pdf->Output();
?>


<?php
class ArrayIndexOutOfBoundsException extends Exception {
    function __construct($message, $code = 0) {
        parent::__construct($message, $code);
    }
}
 
class Integer {
    public function toText($amt) {
        if (is_numeric($amt)) {
			$amta = explode(".",$amt);
			if( count($amta) == 1 )
				return $this->toCrore(abs($amta[0])) . ' Only.';
			else{
				if(strlen($amta[1]) > 2)
					$amta[1] = substr($amta[1],0,2);
					if($amta[1] > 0)
						return $this->toCrore(abs($amta[0])) . ' and ' . $this->toTens(abs($amta[1])) . ' Paise Only.';
					else
						return $this->toCrore(abs($amta[0])) . ' Only.';
			}
        } else {
            throw new Exception('Only numeric values are allowed.');
        }
    }
    private function toOnes($amt) {
        $words = array(
            0 => 'Zero',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine'
        );
        if ($amt >= 0 && $amt < 10)
            return $words[$amt];
        else
            throw new ArrayIndexOutOfBoundsException('Array Index not defined');
    }
 
    private function toTens($amt) { // handles 10 - 99
        $firstDigit = intval($amt / 10);
        $remainder = $amt % 10;
 
        if ($firstDigit == 1) {
            $words = array(
                0 => 'Ten',
                1 => 'Eleven',
                2 => 'Twelve',
                3 => 'Thirteen',
                4 => 'Fourteen',
                5 => 'Fifteen',
                6 => 'Sixteen',
                7 => 'Seventeen',
                8 => 'Eighteen',
                9 => 'Nineteen'
            );
 
            return $words[$remainder];
        } else if ($firstDigit >= 2 && $firstDigit <= 9) {
            $words = array(
                2 => 'Twenty',
                3 => 'Thirty',
                4 => 'Fourty',
                5 => 'Fifty',
                6 => 'Sixty',
                7 => 'Seventy',
                8 => 'Eighty',
                9 => 'Ninety'
            );
 
            $rest = $remainder == 0 ? '' : $this->toOnes($remainder);
            return $words[$firstDigit] . ' ' . $rest;
        }
        else
            return $this->toOnes($amt);
    }
 
    private function toHundreds($amt) {
        $ones = intval($amt / 100);
        $remainder = $amt % 100;
 
        if ($ones >= 1 && $ones < 10) {
            $rest = $remainder == 0 ? '' : $this->toTens($remainder);
            return $this->toOnes($ones) . ' Hundred ' . $rest;
        }
        else
            return $this->toTens($amt);
    }
 
    private function toThousands($amt) {
        $hundreds = intval($amt / 1000);
        $remainder = $amt % 1000;
 
        if ($hundreds >= 1 && $hundreds < 1000) {
            $rest = $remainder == 0 ? '' : $this->toHundreds($remainder);
            return $this->toHundreds($hundreds) . ' Thousand ' . $rest;
        }
        else
            return $this->toHundreds($amt);
    }
 
    private function toLakhs($amt) {
        $hundreds = intval($amt / pow(10, 5));
        $remainder = $amt % pow(10, 5);
 
        if ($hundreds >= 1 && $hundreds < 100) {
            $rest = $remainder == 0 ? '' : $this->toThousands($remainder);
            return $this->toHundreds($hundreds) . ' Lakhs ' . $rest;
        }
        else
            return $this->toThousands($amt);
    }
 
    private function toCrore($amt) {
        $hundreds = intval($amt / pow(10, 7));
        // Note:taking the modulos results in a negative value, but
        //  this seems to work pretty fine
 
        $remainder = $amt - $hundreds * pow(10, 7);
 
        if ($hundreds >= 1 && $hundreds < 1000) {
            $rest = $remainder == 0 ? '' : $this->toLakhs($remainder);
            return $this->toHundreds($hundreds) . ' Crore ' . $rest;
        }
        else
            return $this->toLakhs($amt);
    }
}
?>