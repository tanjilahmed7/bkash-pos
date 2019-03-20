<?php 
$name = "Md. Shafayet Kabir";
$gate  = 16;
// $ticket_count   = 10001;
$reg_id    = 1234565466789;
require_once('TCPDF/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// // set margins
// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
// $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
// set a barcode on the page footer
$pdf->setBarcode(date('Y-m-d H:i:s'));

// set font
$pdf->SetFont('helvetica', '', 11);

// add a page
$pdf->AddPage();




// Header Title





/*
  |---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  |   LOGO (Activated)
  |---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  |
  |
  |
  |---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 */

$pdf->SetXY(150, 200);
$pdf->Image('image/ticket-logo.png', 10, 18, 102, 62, '', '', 'N', false, 300, '', false, false, 0, false, false, false);


$pdf->SetTextColor(0, 0, 0);



// $pdf->Text(50, 80, 'VENUE : Army Museum');
// $pdf->Text(50, 85, 'Dhaka, Bangladesh');

$pdf->SetFont('helvetica', '', 9);
$pdf->Text(113, 54, '25 Oct - 27 Oct 2018');
$pdf->Text(113, 59, 'Gates will open at 11:00 AM');



$pdf->SetFont('helvetica', '', 9);
$pdf->Text(160, 54, 'Army Stadium');
$pdf->Text(160, 59, 'Dhaka, Bangladesh');



// $pdf->Text(50, 65, 'DATE : 15 - 17 January');
// $pdf->Text(50, 70, 'TIME : Gates open at 30 minutes');
// $name = "Md Shafayet Kabir";
$pdf->SetFont('helvetica', 'B', 13);
$pdf->Text(117, 45, $name);

// $gate = 16;
$pdf->SetFont('helvetica', 'B', 20);
$pdf->Text(117, 68, 'Gate - ' . $gate);


$pdf->SetFont('helvetica', 'B', 20);
$pdf->Text(156, 68, 'FREE PASS');


// Left
$style_line01 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218, 218, 218));
$pdf->Line(10, 18, 10, 80, $style_line01);
// Top
$style_line02 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218, 218, 218));
$pdf->Line(10, 18, 200, 18, $style_line02);
// Right
$style_line03 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218, 218, 218));
$pdf->Line(200, 18, 200, 80, $style_line03);
// Bottom
$style_line04 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218, 218, 218));
$pdf->Line(10, 80, 200, 80, $style_line04);

// -------------------------------------------------------------------------------------------------------------------

// V: 02
$style_line05 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218, 218, 218));
$pdf->Line(112, 18, 112, 80, $style_line05);
// V: 03
// Left Ticket count
$style_line06 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218, 218, 218));
$pdf->Line(155, 52, 155, 80, $style_line06);
// H: 01
$style_line07 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218, 218, 218));
$pdf->Line(112, 43, 200, 43, $style_line07);
// H: 02
$style_line08 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218, 218, 218));
$pdf->Line(112, 52, 200, 52, $style_line08);
// H: 03
$style_line09 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218, 218, 218));
$pdf->Line(112, 66, 200, 66, $style_line09);
// -----------------------------------------------------------------------------

$pdf->SetFont('helvetica', '', 7);
$pdf->Text(148, 81, 'Helpline : +88 01844 050 730 (10 AM - 08 PM)');


// H: 
$style_line10 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218, 218, 218));
$pdf->Line(10, 88, 200, 88, $style_line10);
$pdf->Line(10, 125, 200, 125, $style_line10);
// V
$style_line11 = array('width' => 1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218, 218, 218));
$pdf->Line(10, 88, 10, 125, $style_line11);
$pdf->Line(73, 88, 73, 125, $style_line11);
$pdf->Line(136, 88, 136, 125, $style_line11);
$pdf->Line(200, 88, 200, 125, $style_line11);




// ------------------------
// $style3 = array('width' => 1, 'cap' => 'round', 'join' => 'round', 'dash' => '2,10', 'color' => array(35, 31, 30));


// Rectangle
$pdf->Rect(10.5, 88.5, 62, 12, 'F', array(), array(35, 31, 30));
$pdf->Rect(73.5, 88.5, 62, 12, 'F', array(), array(35, 31, 30));
$pdf->Rect(136.5, 88.5, 63, 12, 'F', array(), array(35, 31, 30));

// day
$pdf->SetTextColor(248, 127, 34);
$pdf->SetFont('helvetica', 'B', 20);
$pdf->Text(29, 90, 'DAY 1');
$pdf->Text(93, 90, 'DAY 2');
$pdf->Text(155, 90, 'DAY 3');

$pdf->SetTextColor(0, 0, 0);

$pdf->SetFont('helvetica', '', 9);
$pdf->Text(26, 105, 'INAUGURATION');
$pdf->Text(15, 109, 'PRODUCER AWARD CEREMONY');
$pdf->Text(12, 113, 'WITH SPECIAL LIVE PERFORMANCES');


$pdf->Text(83, 105, 'AARONG FASHION SHOW');
$pdf->Text(75, 109, 'WITH SPECIAL LIVE PERFORMANCES');



$pdf->Text(153, 105, 'CONCERT WITH');
$pdf->Text(140, 109, 'NAGAR BAUL JAMES, JOLER GAAN');
$pdf->Text(149, 113, 'NEMESIS AND MINAR ');



$pdf->Line(10, 140.5, 200, 140.5, $style_line11);
$pdf->Line(10, 141, 200, 141, $style_line11);
$pdf->Line(10, 141.5, 200, 141.5, $style_line11);
$pdf->Line(10, 142, 200, 142, $style_line11);
$pdf->Line(10, 142.5, 200, 142.5, $style_line11);
$pdf->Line(10, 143, 200, 143, $style_line11);

$style_line11 = array('width' => .3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(218, 218, 218));
$pdf->Line(10, 140, 10, 220, $style_line11);
$pdf->Line(200, 140, 200, 220, $style_line11);
$pdf->Line(10, 220, 200, 220, $style_line11);

$pdf->SetFont('helvetica', '', 10);

// define barcode style
$style = array(
    'position' => '',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => false,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0, 0, 0),
    'bgcolor' => false, //array(255,255,255),
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 10,
    'stretchtext' => 4
);

$pdf->write1DBarcode($reg_id, 'C39E', 113, 19, 100, 25, 0.32, $style, 'N');



/*
  |---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  |   Terms & Conditions
  |---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  |
  |
  |
  |---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 */
$pdf->SetFont('helvetica', 'B', 18, '', 'false');
$pdf->Text(71, 128, 'Terms and Conditions');
$pdf->Ln(19);



$terms = '

<ol>

  <li>
    There will be an initial screening of the ticket at the main gate, followed by scanning of the ticket at the numbered gates of the stadium.
  </li>

  <li>
    The barcode must be readable by the scanner. Without a readable barcode, entry into the venue will not be allowed
  </li>

  <li>
    A security wristband will be put on each audience member at the gate in case of a re-entry, without which the audience will not be allowed to enter under any circumstance. 
  </li>
  
  <li>
    The security wristband will be considered unacceptable for entry if it appears to be damaged.
  </li>

  <li>
    The organizers also reserve the right to pat down a ticket holder at entry point, if deemed necessary. 
  </li>

  <li>
    Gates will open at 11:00 am.
  </li>

  <li>
    Children below the age of 10 (ten) will be allowed entry without Registration.
  </li>

  <li>
    No outside food or drinks will be allowed. Food will be available at the food at a reasonable price. Water will also be available.
  </li>
    
  <li>
    Any kinds of tobacco, tobacco related products will not be allowed inside the venue premises.
  </li>

  <li>
    Entry is limited and on a first come, first served basis.
  </li>

  <li>
    The organizers reserve the right to close entry at any moment if the capacity is full.
  </li>

  <li>
    The organizers reserve the right to refuse entry or to remove from the premises, people or persons deemed as a security threat or an element of disturbance.
  </li>

  <li>
    The organizers reserve the right to conduct security searches from time to time and also reserve the right to confiscate any item which may cause danger or disruption to other members of the audience and if deemed as a security threat. 
  </li>

  <li>
    CCTV and film cameras will be present at the venue. Attending the event signifies the ticket holders consent to the filming and sound recording of themselves as members of the audience with no obligations of any kind on the organizers part.
  </li>

  <li>
    The organizers will not take any responsibility for loss or theft of any personal belongings or any loss, injury and damage to the holder of this ticket. 
  </li>

  <li>
    Cameras of any kind whatsoever (other than those in mobile phones) are totally / strictly prohibited. The organizers reserve the right to confiscate such items.
  </li>

  <li>
    Phones must be kept on silent mode during all performances.
  </li>

  <li>
    Any kind of electrical devices such as mobile phone chargers, headphones, power banks and such will not be allowed inside the venue for security purposes and measures. 
  </li>

  <li>
    Any kind of bags will not be allowed inside the venue, people carrying bag/bags will be asked to leave the premises immediately. (There will be no facilities for keeping bags at the venue)
  </li>

  <li>
    Women are specifically requested to not bring purses larger that 10 inches by 6 inches, where they can bring their phones, keys and money. Any bag larger than this will not be allowed inside. 
  </li>

  <li>
    NO parking facilities will be allowed.
  </li>

  <li>
    BRAC & Aarong employees will have to show ID card at the information booth to collect their entry passes.
  </li>

  <li>
    Gold & Platinum Loyalty card holders of Aarong will have to show card at the information booth to collect their entry passes.
  </li>

  <li>
    Foreign nationals are requested to bring their respective Photo IDs (National ID, Passport, and Driving License) to the venue.
  </li>

</ol>  
';

$pdf->SetFont('helvetica', '', 6, '', 'false');
$pdf->writeHTML($terms, true, false, true, false, '');


// $pdf->SetXY(150, 200);
// TCPDF::Image($file,$x = '',$y = '',$w = 0,$h = 0,$type = '',$link = '',$align = '',$resize = false,$dpi = 300,$palign = '',$ismask = false,$imgmask = false,$border = 0,$fitbox = false,$hidden = false,$fitonpage = false,$alt = false,$altimgs = array())




$pdf->Image('image/footer.jpg', 10, 228, 190, 44, '', '', '', false, 300);
$pdf->setPrintFooter(false);
$pdf->SetFooterMargin(0);
$pdf->SetAutoPageBreak(TRUE, 0);

// ---------------------------------------------------------
//Close and output PDF document

$pdf_content = $pdf->Output('Free Pass Aarong Festival 2018.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>