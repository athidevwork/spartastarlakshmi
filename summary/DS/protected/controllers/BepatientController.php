<?php
/**
 * Backend Object Controller.
 * 
 
 * @package backend.controllers
 *
 */
class BepatientController extends BeController
{
        public function __construct($id,$module=null)
	{
		 parent::__construct($id,$module);
                 $this->menu=array(
                        
            array('label'=>t('New Summary'), 'url'=>array('create'),'linkOptions'=>array('class'=>'btn btn-mini')),
						array('label'=>t('List Summaries'), 'url'=>array('admin'),'linkOptions'=>array('class'=>'btn btn-mini')),
                );
		 
	}
        
        /**
	 * The function that do Create new Object
	 * 
	 */
	public function actionCreate()
	{                
		$this->render('patient_create');
	}
	
	
	public function actionAdmitted()
	{                
		$this->render('patient_admitted');
	}
	
	public function actionAdmit()
	{   
	
	 $id=isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;
			  
		$this->menu=array_merge($this->menu,                       
                        array(
                            array('label'=>t('View the Patient Info'), 'url'=>array('view','id'=>$id),'linkOptions'=>array('class'=>'btn btn-mini'))
                            
                        )
                    );
					
					
		$this->render('patient_admit');
	}
	
	public function actionDischarge()
	{   
		$id = isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;
	
		//echo $id;
		
		$this->render('patient_discharge');
	}
	
public function actionDisch()
	{   
	$id=isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;
	$this->menu=array_merge($this->menu,                       
                        array(
                            array('label'=>t('View the Patient Info'), 'url'=>array('view','id'=>$id),'linkOptions'=>array('class'=>'btn btn-mini'))
                            
                        )
                    );
		$this->render('patient_disch');
	}
	
	public function actionDischedit()
	{   
	$id=isset($_GET['id']) ? (int) ($_GET['id']) : 0;
	$this->menu=array_merge($this->menu,                       
                        array(
                            array('label'=>t('View the Patient Info'), 'url'=>array('view','id'=>$id),'linkOptions'=>array('class'=>'btn btn-mini'))
                            
                        )
                    );
		$this->render('patient_dischedit');
	}
	
	public function actionPrint_summary()
	{   
	$id=isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;
	$this->menu=array_merge($this->menu,                       
                        array(
                            array('label'=>t('View the Patient Info'), 'url'=>array('view','id'=>$id),'linkOptions'=>array('class'=>'btn btn-mini'))
                            
                        )
                    );
		$this->render('patient_print_summary');
	}
        
         /**
         * The function that do Update Object
         * 
         */
	public function actionUpdate()
	{            
              $id=isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;
          
              
              $this->render('patient_update');
	}
	
	/**
	
	print
	
	**/
	
	public function actionPrint()
	{         
        $id=isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;
		
		$pat = Patient::model()->findByPk($id);
			  
		$pdf = Yii::createComponent('cms.extensions.tcpdf.ETcPdf', 'P', 'cm', 'A4', true, 'UTF-8');
		
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('MohanRau Memorial Hospital');
		$pdf->SetTitle('Patient Information : ');
		$pdf->SetSubject('MohanRau Memorial Hospital');
		$pdf->SetKeywords('MohanRau Memorial Hospital');

		$pdf->SetHeaderData(CMS_FOLDER.'\assets\backend\images\header.jpg', 180, PDF_HEADER_TITLE.' 036', PDF_HEADER_STRING);
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);


		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		

		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

      	$pdf->SetAutoPageBreak(True, PDF_MARGIN_FOOTER);


		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		
		$pdf->AddPage();
		$pdf->SetFont('times','BI',15);
		
		$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 255, 255)));
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(255,255,255);
		$pdf->Cell(0, 0, '', 1, 1, 'L', 1, 0);
		
		$pdf->SetLineStyle(array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 255, 255)));
		
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('times','',13);
		
		$pdf->MultiCell(28, 4, 'Name', 1, 'L', 1, 0);
		$pdf->MultiCell(5, 4, ':', 1, 'L', 1, 0);
		$pdf->MultiCell(40, 4, $pat->name, '1', 'L', 1, 0);
		$pdf->MultiCell(25, 4, 'Reg No', 1, 'L', 1, 0);
		$pdf->MultiCell(5, 4, ':', 1, 'L', 1, 0);
		$pdf->MultiCell(28, 4, $pat->patient_id, '1', 'L', 1, 0);
		$pdf->MultiCell(15, 4, 'Date', 1, 'L', 1, 0);
		$pdf->MultiCell(5, 4, ':', 1, 'L', 1, 0);
		$pdf->MultiCell(25, 4, date('d/m/Y',$pat->op_date), '1', 'L', 1, 0);
		
		$pdf->Ln();  
		
		$pdf->MultiCell(28, 4, 'Age', 1, 'L', 1, 0);
		$pdf->MultiCell(5, 4, ':', 1, 'L', 1, 0);	
		$ag = 'N/A';	
		if( $pat->age != 0 ) { $ag = $pat->age.' Yrs';  } 			
		elseif( ($pat->dob <= time()) && ($pat->dob != 0) ) { $ag = dateDiff($pat->dob); }
		
		$pdf->MultiCell(50, 4, $ag, '1', 'L', 1, 0);
		$pdf->MultiCell(15, 4, 'Gender', 1, 'L', 1, 0);
		$pdf->MultiCell(5, 4, ':', 1, 'L', 1, 0);
		
		if($pat->gender==1) { $pdf->MultiCell(37, 4, 'Male', '1', 'L', 1, 0); }
		else { $pdf->MultiCell(37, 4, 'Female', '1', 'L', 1, 0); }	
		$pdf->Ln(); 
		
		$pdf->MultiCell(28, 4, 'Height', 1, 'L', 1, 0);
		$pdf->MultiCell(5, 4, ':', 1, 'L', 1, 0);
		$pdf->MultiCell(40, 4, $pat->height.' Cms', '1', 'L', 1, 0);
		
		
		$pdf->MultiCell(25, 4, 'Weight', 1, 'L', 1, 0);
		$pdf->MultiCell(5, 4, ':', 1, 'L', 1, 0);
		$pdf->MultiCell(16, 4, $pat->weight.' Kgs', '1', 'L', 1, 0);
		
		$pdf->MultiCell(27, 4, 'Blood Group', 1, 'L', 1, 0);
		$pdf->MultiCell(5, 4, ':', 1, 'L', 1, 0);
		$pdf->MultiCell(40, 4, $pat->bg, '1', 'L', 1, 0);
		$pdf->Ln(); 
		
		
		$pdf->MultiCell(28, 4, 'Address', 1, 'L', 1, 0);
		$pdf->MultiCell(5, 4, ':', 1, 'L', 1, 0);
		$pdf->MultiCell(70, 4, $pat->address1, '1', 'L', 1, 0);
		$pdf->Ln(); 
		
		$pdf->MultiCell(28, 4, 'City', 1, 'L', 1, 0);
		$pdf->MultiCell(5, 4, ':', 1, 'L', 1, 0);
		$pdf->MultiCell(40, 4, $pat->city, '1', 'L', 1, 0);
		$pdf->Ln(); 
		
		$pdf->MultiCell(28, 4, 'PIN', 1, 'L', 1, 0);
		$pdf->MultiCell(5, 4, ':', 1, 'L', 1, 0);
		$pdf->MultiCell(40, 4, $pat->pin, '1', 'L', 1, 0);
		$pdf->MultiCell(25, 4, 'Contact No.', 1, 'L', 1, 0);
		$pdf->MultiCell(5, 4, ':', 1, 'L', 1, 0);
		$pdf->MultiCell(40, 4, $pat->mobile, '1', 'L', 1, 0);
		$pdf->Ln(); 
		
		$pdf->MultiCell(28, 4, 'Department', 1, 'L', 1, 0);
		$pdf->MultiCell(5, 4, ':', 1, 'L', 1, 0);
		$pdf->MultiCell(80, 4, Dept::GetName($pat->dept), '1', 'L', 1, 0);
		$pdf->Ln(); 
		
		$pdf->MultiCell(28, 4, 'Consultant', 1, 'L', 1, 0);
		$pdf->MultiCell(5, 4, ':', 1, 'L', 1, 0);
		$pdf->MultiCell(80, 4, Doctor::GetName($pat->consultant), '1', 'L', 1, 0);
		$pdf->Ln(); 
		
		$pdf->MultiCell(28, 4, 'Refered By', 1, 'L', 1, 0);
		$pdf->MultiCell(5, 4, ':', 1, 'L', 1, 0);
		$pdf->MultiCell(70, 4, $pat->reference, '1', 'L', 1, 0);
		$pdf->Ln(); 		
		
		$pdf->MultiCell(0, 4, '----------------------------------------------------------------------------------------------', 1, 'C', 1, 0);
		
		
		$pdf->Output($pat->name.'-index.pdf','I');
	}
        
         /**
	 * The function that do View User
	 * 
	 */
	 
	 
	 /*****************************/
	 
	 
	 public function actionAprint()
	{         
        $id=isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;
		
		$dis = Admit::model()->findByPk($id);
		
		$pat = Patient::model()->find(array(
			'condition'=>'patient_id = :PID',
			'params'=>array(':PID'=>$dis->patient_id)
		));
			  
		$pdf = Yii::createComponent('cms.extensions.tcpdf.ETcPdf', 'P', 'cm', 'A4', true, 'UTF-8');
		
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('MohanRau Memorial Hospital');
		$pdf->SetTitle('Patient Information : ');
		$pdf->SetSubject('MohanRau Memorial Hospital');
		$pdf->SetKeywords('MohanRau Memorial Hospital');

// set default header data
		
		$pdf->SetHeaderData(CMS_FOLDER.'\assets\backend\images\header.jpg', 180, PDF_HEADER_TITLE.' 036', PDF_HEADER_STRING);

// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);


		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);


		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		
		$pdf->AddPage();
		$pdf->SetFont('times','BI',15);
		
		$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 255, 255)));
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(255,255,255);
		$pdf->Cell(0, 1, '', 1, 1, 'L', 1, 0);
		
		
		
		
		$pdf->Ln(); $pdf->Ln(); $pdf->Ln(); 
		
		$pdf->Cell(0, 4, $pat->name.'('.$pat->patient_id.')', 1, 1, 'C', 1, 0);
		$pdf->Ln(); $pdf->Ln(); $pdf->Ln();

		$pdf->SetLineStyle(array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 255, 255)));
		
		$pdf->SetFillColor(213,213,214);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('times','',13);
		$pdf->MultiCell(35, 4, 'Admission No :', 1, 'L', 1, 0);
		$pdf->SetFillColor(237,237,238);
		$pdf->SetTextColor(0,0,0);
		$pdf->MultiCell(20, 4, $dis->admit_id, '1', 'L', 1, 0);
		
		$pdf->SetFillColor(213,213,214);
		$pdf->SetTextColor(0,0,0);
		$pdf->MultiCell(24, 4, '', 1, 'L', 1, 0);
		$pdf->SetFillColor(237,237,238);
		$pdf->MultiCell(30, 4, '', '1', 'L', 1, 0);
		$pdf->SetFillColor(213,213,214);
		$pdf->SetTextColor(0,0,0);
		$pdf->MultiCell(40, 4, 'Date of Admit :', 1, 'L', 1, 0);
		$pdf->SetFillColor(237,237,238);
		$pdf->MultiCell(40, 4, ($dis->adate!=0) ? date('d/m/Y',$dis->adate) : '', '1', 'L', 1, 0);
		
		$pdf->Ln(); $pdf->Ln(); 
		$pdf->SetFillColor(213,213,214);
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('times','',13);
		$pdf->MultiCell(28, 4, 'Age :', 1, 'L', 1, 0);
		$pdf->SetFillColor(237,237,238);
		$pdf->SetTextColor(0,0,0);
		
		if( $pat->age != 0 ) 			
			{ 
			
			$pdf->MultiCell(20, 4, $pat->age, '1', 'L', 1, 0);
			 } 
			
		elseif( ($pat->dob <= time()) && ($pat->dob != 0) ) { $pdf->MultiCell(20, 4, dateDiff($pat->dob), '1', 'L', 1, 0); }
		
		
		
		$pdf->SetFillColor(213,213,214);
		$pdf->SetTextColor(0,0,0);
		$pdf->MultiCell(24, 4, 'Gender :', 1, 'L', 1, 0);
		$pdf->SetFillColor(237,237,238);
		$pdf->MultiCell(37, 4, ': '.($pat->gender==1) ? 'Male' : 'Female', '1', 'L', 1, 0);
		$pdf->SetFillColor(213,213,214);
		$pdf->SetTextColor(0,0,0);
		$pdf->MultiCell(40, 4, 'Date of Birth :', 1, 'L', 1, 0);
		$pdf->SetFillColor(237,237,238);
		$pdf->MultiCell(40, 4, ($pat->dob!=0) ? date('d/m/Y',$pat->dob) : '', '1', 'L', 1, 0);
		
		$pdf->Ln(); $pdf->Ln(); 
		$pdf->SetFillColor(213,213,214);
		$pdf->SetTextColor(0,0,0);
		$pdf->MultiCell(28, 4, 'Height :', 1, 'L', 1, 0);
		$pdf->SetFillColor(237,237,238);
		$pdf->MultiCell(20, 4, $pat->height, '1', 'L', 1, 0);
		$pdf->SetFillColor(213,213,214);
		$pdf->SetTextColor(0,0,0);
		$pdf->MultiCell(28, 4, 'Weight :', 1, 'L', 1, 0);
		$pdf->SetFillColor(237,237,238);
		$pdf->MultiCell(33, 4, $pat->weight, '1', 'L', 1, 0);
		$pdf->SetFillColor(213,213,214);
		$pdf->MultiCell(40, 4, 'Blood Group :', 1, 'L', 1, 0);
		
		$pdf->SetFillColor(237,237,238);
		$pdf->SetTextColor(0,0,0);
		$pdf->MultiCell(40, 4, $pat->bg, '1', 'L', 1, 0);
		
		$pdf->Ln(); $pdf->Ln();
		$pdf->SetFillColor(213,213,214);
		$pdf->SetTextColor(0,0,0);
		$pdf->MultiCell(28, 4, 'Address 1 :', 1, 'L', 1, 0);
		$pdf->SetFillColor(237,237,238);
		$pdf->MultiCell(70, 4, $pat->address1, '1', 'L', 1, 0);
		$pdf->Ln(); $pdf->Ln();
		$pdf->SetFillColor(213,213,214);
		$pdf->SetTextColor(0,0,0);
		$pdf->MultiCell(28, 4, 'Address 2 :', 1, 'L', 1, 0);
		$pdf->SetFillColor(237,237,238);
		$pdf->MultiCell(70, 4, $pat->address2, '1', 'L', 1, 0);
		$pdf->Ln(); $pdf->Ln();
		$pdf->SetFillColor(213,213,214);
		$pdf->SetTextColor(0,0,0);
		$pdf->MultiCell(28, 4, 'City :', 1, 'L', 1, 0);
		$pdf->SetFillColor(237,237,238);
		$pdf->MultiCell(40, 4, $pat->city, '1', 'L', 1, 0);
		
		$pdf->Ln(); $pdf->Ln();
		$pdf->SetFillColor(213,213,214);
		$pdf->SetTextColor(0,0,0);
		$pdf->MultiCell(28, 4, 'PIN :', 1, 'L', 1, 0);
		$pdf->SetFillColor(237,237,238);
		$pdf->MultiCell(20, 4, $pat->pin, '1', 'L', 1, 0);
		$pdf->SetFillColor(213,213,214);
		$pdf->SetTextColor(0,0,0);
		$pdf->MultiCell(28, 4, 'Tele :', 1, 'L', 1, 0);
		$pdf->SetFillColor(237,237,238);
		$pdf->MultiCell(34, 4, $pat->tele, '1', 'L', 1, 0);
		$pdf->SetFillColor(213,213,214);
		$pdf->SetTextColor(0,0,0);
		$pdf->MultiCell(40, 4, 'Mobile :', 1, 'L', 1, 0);
		$pdf->SetFillColor(237,237,238);
		$pdf->MultiCell(40, 4, $pat->mobile, '1', 'L', 1, 0);
		
		$pdf->Ln(); $pdf->Ln();
		$pdf->SetFillColor(213,213,214);
		$pdf->SetTextColor(0,0,0);
		$pdf->MultiCell(28, 4, 'email :', 1, 'L', 1, 0);
		$pdf->SetFillColor(237,237,238);
		$pdf->MultiCell(45, 4, $pat->email, '1', 'L', 1, 0);
		
		$pdf->Ln(); $pdf->Ln();
		$pdf->SetFillColor(213,213,214);
		$pdf->SetTextColor(0,0,0);
		$pdf->MultiCell(28, 4, 'Department :', 1, 'L', 1, 0);
		$pdf->SetFillColor(237,237,238);
		$pdf->MultiCell(45, 4, Dept::GetName($pat->dept), '1', 'L', 1, 0);
		$pdf->MultiCell(28, 4, 'Consultant :', 1, 'L', 1, 0);
		$pdf->SetFillColor(237,237,238);
		$pdf->MultiCell(45, 4, Doctor::GetName($pat->consultant), '1', 'L', 1, 0);
		$pdf->MultiCell(28, 4, 'Reffered By :', 1, 'L', 1, 0);
		$pdf->SetFillColor(237,237,238);
		$pdf->MultiCell(45, 4, $pat->reference, '1', 'L', 1, 0);
		
		
		$pdf->Output($pat->name.'-index.pdf','I');
	}
	 
	 
	 /**************************/
	 
	 
	 public function actionDprint()
	{         
        $id=isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;
		
		
		
		$dis = Discharge::model()->findByPk($id);
		
		$pat = Patient::model()->find(array(
			'condition'=>'id = :PID',
			'params'=>array(':PID'=>$dis->pid)
		));
		
		
			  
		$pdf = Yii::createComponent('cms.extensions.tcpdf.ETcPdf', 'P', 'cm', 'A4', true, 'UTF-8');
		
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('MohanRau Memorial Hospital');
		$pdf->SetTitle('Patient Information : ');
		$pdf->SetSubject('MohanRau Memorial Hospital');
		$pdf->SetKeywords('MohanRau Memorial Hospital');


		
		//$pdf->SetHeaderData(CMS_FOLDER.'\assets\backend\images\header.jpg', 180, PDF_HEADER_TITLE.' 036', PDF_HEADER_STRING);



		//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);


		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);

		//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->startPageGroup();
		$pdf->AddPage();
		//$pdf->SetLineStyle(array('width' => 0.25 , 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 255, 255)));	
		
		
		$dis = Discharge::model()->findByPk($id);
		
		$html = '';
		
		
		$html .= '<table  border="0" cellspacing="0" cellpadding="0">';
		$html .='<tr>
    		<td colspan="5" align="center"> </td>
    		
  			</tr>';
		
		if($dis->type==1) { 
		
		$html .='<tr>
    		<td colspan="5" align="center"> <h2>DISCHARGE SUMMARY </h2></td>
    		
  			</tr>';
		} else if($dis->type==2) { $html .='<tr>
    		<td colspan="5" align="center"> <h2>DEATH SUMMARY</h2> </td>
    		
  			</tr>'; } else {  $html .='<tr>
    		<td colspan="5" align="center"> <h2>DISCHARGE SUMMARY (AMA) </h2></td>
    		
  			</tr>'; }
			$html .='<tr>
		 
    		<td colspan="5">  </td>
    		
  			</tr>';
		
		 $html .='<tr>
    		<td colspan="5">&nbsp;&nbsp;&nbsp; <strong>A. General Information</strong> </td>
    		
  			</tr>';
			
		$html .='<tr>
		 
    		<td colspan="5">  </td>
    		
  			</tr>';
		
		
		
		
		$html .='<tr>
    		<td width="100">Patient Name</td>
    		<td width="300">:&nbsp;'.$pat->name.'</td>
		    <td width="45"></td>
			<td width="70"> </td>
			<td width="100"></td>
			</tr>';
			$s = ($pat->gender!=2) ? "Male"	: "Female" ;
			$html .='<tr>
    		<td width="100">Age</td>
    		<td width="300">:&nbsp;'.$pat->age.'</td>
		    <td width="45">Reg No</td>
			<td width="100">:'.$pat->regno.'</td>
			<td width="100"></td>
			</tr>';
			$s = ($pat->gender!=2) ? "Male"	: "Female" ;
			$html .='<tr>
    		<td width="100">Gender</td>
    		<td width="300">:&nbsp;'.$s.'</td>
		    <td width="45">Ward</td>
			<td width="100">:'.$pat->ward.'</td>
			<td width="100"></td>
			</tr>';
			
			
			$html .='<tr>
    		<td width="107">Address&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
    		<td width="280">'.$pat->address.'</td>
			<td width="10">&nbsp;</td>
    		<td width="125">&nbsp;</td>
    		<td width="135">&nbsp;</td>
  			</tr>';
			
			$html .='<tr>
    		<td width="100"> </td>
    		<td width="280">&nbsp;&nbsp;'.$pat->city.'</td>
			<td width="10">&nbsp;</td>
    		<td width="10">&nbsp;</td>
    		<td width="10">&nbsp;</td>
  			</tr>';
			
			$html .='<tr>
    		<td width="100">Mobile </td>
    		<td width="100">:&nbsp;'.$pat->pin.'</td>
			<td width="10">&nbsp;</td>
    		<td width="12">&nbsp;</td>
    		<td width="13">&nbsp;</td>
  			</tr>';
			$html .='<tr>
		 
    		<td colspan="4">  </td>
    		
  			</tr>';
			$html .='<tr>
    		<td width="180">Consultant</td>
    		<td width="180">:&nbsp;&nbsp;'.Doctor::GetName($pat->consultant).'</td>
			<td width="10">&nbsp;</td>
    		<td width="125">&nbsp;</td>
    		<td width="135">&nbsp;</td>
  			</tr>';
			
			$html .='<tr>
    		<td width="180">Date & Time of Admission</td>
    		<td width="300">:&nbsp;&nbsp;'.$pat->admdate.'</td>
			<td width="10">&nbsp;</td>
    		<td width="125">&nbsp;</td>
    		<td width="135">&nbsp;</td>
  			</tr>';
			
			$html .='<tr>
		 
    		<td width="190">Diagnosis&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
    		<td width="300" colspan="4">'.$dis->diagnosis.'</td>
  			</tr>';
			$html .='<tr>
    		<td width="180">Allergies</td>
    		<td width="180">:&nbsp;&nbsp;'.$dis->operation.'</td>
			<td width="10">&nbsp;</td>
    		<td width="125">&nbsp;</td>
    		<td width="135">&nbsp;</td>
  			</tr>';
			$html .='<tr>
    		<td width="180">Date & Time of Surgery</td>
    		<td width="300">:&nbsp;&nbsp;'.$pat->cdate.'</td>
			<td width="10">&nbsp;</td>
    		<td width="125">&nbsp;</td>
    		<td width="135">&nbsp;</td>
  			</tr>';
if($dis->proname!='') {	
		$html .='<tr>
		 
    		<td width="190">Surgery  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
    		<td width="450" colspan="4">'.$dis->proname.'</td>

  			</tr>';
}

			

			if($pat->disdate!=0) { 
			$html .='<tr>
    		<td width="180">Date & Time of Discharge</td>
    		<td width="180">:&nbsp;&nbsp;'.$pat->disdate.'</td>
			<td width="10">&nbsp;</td>
    		<td width="125">&nbsp;</td>
    		<td width="135">&nbsp;</td>
  			</tr>';
			}
			
if($dis->expiry!='') {	
			$html .='<tr>
    		<td width="180">Date & Time of Expiry</td>
    		<td width="250">:&nbsp;&nbsp;'.$dis->expiry.'</td>
			<td width="10">&nbsp;</td>
    		<td width="125">&nbsp;</td>
    		<td width="135">&nbsp;</td>
  			</tr>';
			}
			
			
			

		
			
		
		
		$html .='<tr>
		 
    		<td colspan="4">  </td>
    		
  			</tr>';
		
		 $html .='<tr>
		 
    		<td colspan="4">&nbsp;&nbsp;&nbsp;<strong>B. History Of Present Illness</strong> </td>
    		
  			</tr>';
		 $html .='<tr>
		 
    		<td colspan="4">  </td>
    		
  			</tr>';
			
			 $html .='<tr>
		 
    		<td width="195">Chief Complaints&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
    		<td width="300" colspan="4">'.$dis->history.'</td>
  			</tr>';
			
			
			
			
		
		if($dis->dm!=2) { 
		$html .='<tr>
    		<td width="180">History of Diabetes Mellitus</td>
    		<td width="180">:&nbsp;&nbsp;No</td>
			</tr>';}
			else if($dis->dm!=1) { $html .='<tr>
			<td width="180">History of Diabetes Mellitus</td>
    		<td width="180">:&nbsp;&nbsp;Yes</td>
  			</tr>';
			}
			
			if($dis->hypertension==1) { 
		$html .='<tr>
    		<td width="180">History of Hypertension</td>
    		<td width="180">:&nbsp;&nbsp;No</td>
			</tr>';}
			else if($dis->hypertension==2) { $html .='<tr>
			<td width="180">History of Hypertension</td>
    		<td width="180">:&nbsp;&nbsp;Yes</td>
  			</tr>';
			}
		
		if($dis->cad==1) { 
		$html .='<tr>
    		<td width="180">History of CAD</td>
    		<td width="180">:&nbsp;&nbsp;No</td>
			</tr>';}
			else if($dis->cad==2) { $html .='<tr>
			<td width="180">History of CAD</td>
    		<td width="180">:&nbsp;&nbsp;Yes</td>
  			</tr>';
			}
		
		 if($dis->asthma==1) { 
		$html .='<tr>
    		<td width="180">History of Asthma</td>
    		<td width="180">:&nbsp;&nbsp;No</td>
			</tr>';}
			else if($dis->asthma==2) { $html .='<tr>
			<td width="180">History of Asthma</td>
    		<td width="180">:&nbsp;&nbsp;Yes</td>
  			</tr>';
			}
		if($dis->past_history!='') { 
		$html .='<tr>
    		<td width="180">Past Medical History</td>
    		<td width="300">:&nbsp;&nbsp;'.$dis->past_history.'</td>
			<td width="10">&nbsp;</td>
    		<td width="125">&nbsp;</td>
    		<td width="135">&nbsp;</td>
  			</tr>';
			}
			

$html .='<tr>
		 
    		<td width="190">Past Surgical History&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </td>
    		<td width="300" colspan="4">'.trim($dis->surgical_history).'</td>
  			</tr>';




		
		$html .='<tr>
		 
    		<td width="128">  </td>
    		<td colspan="3"></td>
  			</tr>';
			

		
		 $html .='<tr>
		 
    		<td colspan="4">Social History</td>
    		
  			</tr>';
			
			if($dis->ethanol==1) { 
		$html .='<tr>
    		<td width="100">Ethanol</td>
    		<td width="100">:&nbsp;&nbsp;No</td>
			</tr>';}
			else if($dis->ethanol==2) { $html .='<tr>
			<td width="100">Ethanol</td>
    		<td width="100">:&nbsp;&nbsp;Yes</td>
  			</tr>';
			}
			
			if($dis->smoking==1) { 
		$html .='<tr>
    		<td width="100">Smoking</td>
    		<td width="100">:&nbsp;&nbsp;No</td>
			</tr>';}
			else if($dis->smoking==2) { $html .='<tr>
			<td width="100">Smoking</td>
    		<td width="100">:&nbsp;&nbsp;Yes</td>
  			</tr>';
			}
			
			if($dis->others!='') { 
			$html .='<tr>
    		<td width="100">Others</td>
    		<td width="100">:&nbsp;&nbsp;'.$dis->others.'</td>
			
  			</tr>';
		}
		 $html .='<tr>
		 
    		<td colspan="4">  </td>
    		
  			</tr>';
			 $html .='<tr>
		 
    		<td colspan="4">&nbsp;&nbsp;&nbsp;<strong>C. Clinical Examinations During Admission</strong> </td>
    		
  			</tr>';
			$html .='<tr>
		 
    		<td colspan="4">  </td>
    		
  			</tr>';
			
			
			
			$html .='<tr>
    		<td width="75">Weight(Kgs) :</td>
			<td width="50">'.$dis->weight.'</td>
    		<td width="135">&nbsp;&nbsp;&nbsp;Pallor : '.$dis->palior.'</td>
    		<td width="135">Cyanosis : '.$dis->cyanosis.'</td>
    		<td width="135">Clubbing : '.$dis->clubbing.'</td>
			
  			</tr>';
			
			$html .='<tr>
    		<td width="75">Edema Feet :</td>
			<td width="50">'.$dis->edemafeet.'</td>
    		<td width="135">&nbsp;&nbsp;&nbsp;Oral Cavity : '.$dis->oralcavity.'</td>
    		<td width="135">Icterus : '.$dis->icterus.'</td>
    		<td width="135">Lymph Nodes : '.$dis->lymphnodes.'</td>
			
  			</tr>';
			
			$html .='<tr>
    		<td width="68">Temp</td>
			<td width="50">: '.$dis->temp.' `F </td>
			<td width="135">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pulse : '.$dis->pulse.' Per Min</td>
    		<td width="135">&nbsp;&nbsp;BP : '.$dis->bp.' (mmHg)</td>
    		
    		
			
  			</tr>';
			$html .='<tr>
		 
    		<td colspan="4">  </td>
    		
  			</tr>';
			 
			 $html .='<tr>
    		<td width="160">Head & ENT</td>
    		<td width="150">:&nbsp;&nbsp;'.$dis->head.'</td>
			
  			</tr>';
		
			 $html .='<tr>
    		<td width="160">CVS</td>
    		<td width="280">:&nbsp;&nbsp;'.$dis->cvs.'</td>
			
  			</tr>';
			
			 $html .='<tr>
    		<td width="160">RS</td>
    		<td width="280">:&nbsp;&nbsp;'.$dis->rs.'</td>
			
  			</tr>';
			
			 $html .='<tr>
    		<td width="160">Abdomen</td>
    		<td width="280">:&nbsp;&nbsp;'.$dis->abdomen.'</td>
			
  			</tr>';
			
			 $html .='<tr>
    		<td width="160">CNS</td>
    		<td width="350">:&nbsp;&nbsp;'.$dis->cns.'</td>
			<td width="50">&nbsp;&nbsp;&nbsp;</td>
  			</tr>';
			
			 $html .='<tr>
    		<td width="160">Genitals</td>
    		<td width="350">:&nbsp;&nbsp;'.$dis->genitais.'</td>
			
  			</tr>';
			
			 $html .='<tr>
    		<td width="160">Functional Evaluation</td>
    		<td width="200">:&nbsp;&nbsp;'.$dis->functionalevaluation.'</td>
			
  			</tr>';
			
			 $html .='<tr>
    		<td width="160">Investigations</td>
    		<td width="190">:&nbsp;&nbsp;'.$dis->invest.'</td>
			
  			</tr>';
			$html .='<tr>
		 
    		<td width="168">Consultant Referrals&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </td>
    		<td width="300" colspan="4">'.trim($dis->other_consultant).'</td>
  			</tr>';
			
			
			
			
			$html .='<tr>
		 
    		<td colspan="4">  </td>
    		
  			</tr>';
			 $html .='<tr>
		 
    		<td colspan="4">&nbsp;&nbsp;&nbsp;<strong>D. Course In The Hospital</strong> </td>
    		
  			</tr>';
			
			$html .='<tr>
		 <td width="500"><p style="text-align: justify;">'.$dis->family_history.'</p></td>
  			</tr>';	
			 $html .='<tr>
		 
    		<td colspan="4">  </td>
    		
  			</tr>';
			if($dis->sigmedicine!='') { 
			 $html .='<tr>
    		<td width="180">Significant Medications Given :</td>

    		<td width="360" colspan="4">&nbsp;'.$dis->sigmedicine.'</td>
			
  			</tr>';
}
			
			if($dis->conditionatdischarge==1) { 
		$html .='<tr>
    		<td width="161">Condition At Discharge</td>
    		<td width="180">:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Haemodynamically Stable</td>
			</tr>';}
			else if($dis->conditionatdischarge==2) { $html .='<tr>
			<td width="161">Condition At Discharge</td>
    		<td width="180">:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Haemodynamically Unstable</td>
  			</tr>';
			}
else if($dis->conditionatdischarge==3) { $html .='<tr>
			<td width="161">Condition At Discharge</td>
    		<td width="180">:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; On Ventilator Support</td>
  			</tr>';
			}


			
			
			
			$html .='<tr>
		 
    		<td colspan="4">  </td>
    		
  			</tr>';
if($dis->diet!='') { 
			 $html .='<tr>
		 
    		<td colspan="4">&nbsp;&nbsp;&nbsp;<strong>E. Advice On Discharge</strong> </td>
    		
  			</tr>';
}
			$html .='<tr>
		 
    		<td colspan="4">  </td>
    		
  			</tr>';
if($dis->diet!='') { 
			$html .='<tr>
    		<td width="160">Diet</td>
    		<td width="350">:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$dis->diet.'</td>
			
  			</tr>';
}
if($dis->physicalactivity!='') { 
			
			$html .='<tr>
    		<td width="160">Physical Activity</td>
    		<td width="320">:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$dis->physicalactivity.'</td>
			
  			</tr>';
}
			
			$html .='<tr>
		 
    		<td colspan="4">  </td>
    		
  			</tr>';
			
			
		if($dis->on_examination!='') {	
		 $html .='<tr>
		 
    		
    		
			<td width="580"><u>Diabetic Advice Medicine:</u><p>'.$dis->on_examination.'</p></td>
			</tr>'; 
		
	
	}
			
			$html .='<tr>
		 
    		<td colspan="4"> </td>
    		
  			</tr>';	
			if($dis->investigation!='') {	
			$html .='<tr>
		 
    		
    		<td width="580"><u>Medications:</u><p>'.$dis->investigation.'</p></td>
			</tr>';
			}
			$html .='<tr>
		 
    		<td colspan="4"> </td>
    		
  			</tr>';
if($dis->next_visit=='') {
			 	
			 $html .='<tr>
    		<td width="500"><p style="text-align: right;">Dr. Kalyaan</p></td>
  			</tr>';
}

			if($dis->next_visit!='') {
			
			$html .='<tr>
			<td width="100"><strong>Follow Up</strong> </td>
			
    		<td width="400"><p>'.trim($dis->next_visit).'</p></td>
  			</tr>';
			
			$html .='<tr>
    		<td width="500"><p style="text-align: justify;">Please Call For Emergency 99416 10087, 24769686 If You have Any Of The Following Symptoms: <br></p> <ol> <li>Fever > 101.5 `F. </li> <li>Onset of New Pain or Worsening Of Previous Pain. </li><li>Vomiting.</li><li>Altered Level Of Consiousness.</li> <li>Discharge from the Operative Wound.</li> <li>Worsening Of Any Symptoms.</li><li>Other Significant Concerns.</li></ol><p style="text-align: right;">Dr. Kalyaan</p></td>
  			</tr>';
			
			}
			
		$html .='</table>';
		
		$pdf->writeHTML($html, true, false, true, false, '');
		
		
		//$pdf->writeHTML($html, true, false, true, false, '');
		//$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->Output($pat->name.'discharge-summary.pdf','I');
		
	}
	 
	 /**
	 Discharge Summar Print
	
	 **/
	 
	 
	public function actionView()
	{         
        $id = isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;
		
		$this->menu=array_merge($this->menu,                       
                        array(
                          
                            
                        )
          );
          
		$this->render('patient_view');
	}
        /**
	 * The function that do Manage Object
	 * 
	 */
	public function actionAdmin()
	{                
		$this->render('patient_admin');
	}
        
    
	public function actionDelete($id)
	{                            
            GxcHelpers::deleteModel('Patient', $id);
	}
	
	public function actionDischdelete($id)
	{                            
        $dele = Discharge::model()->findByPk($id);
		$dele->delete();
		//Yii::app()->controller->redirect(array('bepatient','id'=>$model->primaryKey));
		Yii::app()->controller->redirect(array('admin'));
	}
          
        
}